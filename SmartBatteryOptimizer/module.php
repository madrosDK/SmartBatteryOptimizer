<?php

class SmartBatteryOptimizer extends IPSModule
{
    private const ARCHIVE_GUID = '{43192F0B-135B-4CE7-A0A7-1475603F3060}';

    public function Create()
    {
        parent::Create();

        $this->RegisterPropertyFloat('Latitude', 46.62);
        $this->RegisterPropertyFloat('Longitude', 14.31);
        $this->RegisterPropertyFloat('GlobalPVFactor', 1.0);
        $this->RegisterPropertyFloat('SystemEfficiency', 0.86);
        $this->RegisterPropertyInteger('PVCalibrationDays', 14);
        $this->RegisterPropertyInteger('UnknownOrientationLearningDays', 30);
        $this->RegisterPropertyInteger('PVCalibrationMinExpectedW', 300);
        $this->RegisterPropertyFloat('PVCalibrationMinFactor', 0.50);
        $this->RegisterPropertyFloat('PVCalibrationMaxFactor', 1.50);
        $this->RegisterPropertyString('PVSurfaces', json_encode([
            ['Active' => true, 'Name' => 'Süd', 'KWp' => 10.0, 'OrientationKnown' => true, 'Azimuth' => 0, 'Tilt' => 25, 'Factor' => 1.0, 'AutoCalibrate' => true, 'PVVariable1' => 0, 'PVVariable2' => 0, 'PVVariable3' => 0]
        ]));

        $this->RegisterPropertyInteger('SOCVariable', 0);
        $this->RegisterPropertyFloat('BatteryCapacityKWh', 10.0);
        $this->RegisterPropertyFloat('MinimumSOC', 15.0);
        $this->RegisterPropertyInteger('MaxDischargePowerW', 5000);
        $this->RegisterPropertyInteger('FeedInEnableVariable', 0);
        $this->RegisterPropertyInteger('DischargePowerVariable', 0);
        $this->RegisterPropertyBoolean('InvertPowerSetpoint', false);

        $this->RegisterPropertyInteger('HousePowerVariable', 0);
        $this->RegisterPropertyInteger('PVActualPowerVariable', 0);
        $this->RegisterPropertyInteger('LearningDays', 30);
        $this->RegisterPropertyFloat('FallbackNightConsumptionKWh', 4.0);
        $this->RegisterPropertyInteger('MinimumValidNights', 3);
        $this->RegisterPropertyInteger('NightStartHour', 18);
        $this->RegisterPropertyInteger('FallbackMorningHour', 8);
        $this->RegisterPropertyInteger('MorningPVThresholdW', 300);
        $this->RegisterPropertyFloat('SafetyReservePct', 10.0);
        $this->RegisterPropertyFloat('OutlierPct', 70.0);

        $this->RegisterPropertyInteger('PriceSource', 0);
        $this->RegisterPropertyInteger('FeedInTariffProvider', 0);
        $this->RegisterPropertyInteger('PriceJSONVariable', 0);
        $this->RegisterPropertyFloat('PositivePriceFactor', 1.0);
        $this->RegisterPropertyFloat('NegativePriceFactor', 1.0);
        $this->RegisterPropertyFloat('PriceAdjustmentCt', 0.0);
        $this->RegisterPropertyFloat('MinimumFeedInPriceCt', 0.0);
        $this->RegisterPropertyFloat('MinimumTomorrowPVKWh', 8.0);
        $this->RegisterPropertyFloat('PoorForecastExtraReservePct', 40.0);
        $this->RegisterPropertyBoolean('DisableFeedInOnVeryPoorForecast', false);
        $this->RegisterPropertyFloat('VeryPoorForecastKWh', 2.0);

        $this->RegisterPropertyBoolean('AutomaticEnabled', false);
        $this->RegisterPropertyInteger('RefreshMinutes', 30);

        $this->RegisterVariableFloat('PVForecastTomorrow', 'PV Prognose morgen', '~Electricity', 10);
        $this->RegisterVariableString('PVCalibrationStatus', 'PV Kalibrierung', '', 11);
        $this->RegisterVariableString('AutomaticReleaseStatus', 'Automatikfreigabe', '', 12);
        $this->RegisterVariableFloat('NightConsumptionForecast', 'Prognose Nachtverbrauch', '~Electricity', 20);
        $this->RegisterVariableString('NightConsumptionSource', 'Quelle Nachtverbrauch', '', 21);
        $this->RegisterVariableInteger('ValidNightSamples', 'Gültige Nächte', '', 22);
        $this->RegisterVariableFloat('AvailableFeedInEnergy', 'Für Einspeisung verfügbar', '~Electricity', 30);
        $this->RegisterVariableFloat('CurrentPrice', 'Aktueller Einspeisepreis', '', 40);
        $this->RegisterVariableFloat('HighestPrice', 'Höchster geplanter Einspeisepreis', '', 50);
        $this->RegisterVariableBoolean('FeedInActive', 'Einspeisung aktiv', '~Switch', 60);
        $this->RegisterVariableFloat('PlannedPower', 'Geplante Einspeiseleistung', '~Watt', 70);
        $this->RegisterVariableString('NextFeedInWindow', 'Nächstes Einspeisefenster', '', 80);
        $this->RegisterVariableFloat('ExpectedRevenue', 'Erwarteter Erlös', '', 90);
        $this->RegisterVariableString('LastUpdate', 'Letzte Aktualisierung', '', 100);
        $this->RegisterVariableString('StatusText', 'Optimierungsstatus', '', 110);
        $this->RegisterVariableString('OverviewHTML', 'Übersicht', '~HTMLBox', 120);
        $this->RegisterVariableString('PriceChartHTML', 'Börsenpreis Diagramm', '~HTMLBox', 121);
        $this->RegisterVariableString('PlanHTML', 'Einspeiseplan', '~HTMLBox', 122);

        $this->RegisterAttributeString('ForecastJSON', '{}');
        $this->RegisterAttributeString('PVCalibrationJSON', '{}');
        $this->RegisterAttributeString('PricesJSON', '[]');
        $this->RegisterAttributeString('PlanJSON', '[]');
        $this->RegisterAttributeFloat('LearnedNightKWh', 0.0);
        $this->RegisterAttributeString('NightLearningSource', 'Fallback');
        $this->RegisterAttributeInteger('NightSampleCount', 0);

        $this->RegisterTimer('RefreshTimer', 0, 'SBO_Recalculate($_IPS[\'TARGET\']);');
        $this->RegisterTimer('ControlTimer', 0, 'SBO_Control($_IPS[\'TARGET\']);');
    }

    public function ApplyChanges()
    {
        parent::ApplyChanges();
        $refresh = max(5, $this->ReadPropertyInteger('RefreshMinutes'));
        $this->SetTimerInterval('RefreshTimer', $refresh * 60 * 1000);
        $this->SetTimerInterval('ControlTimer', 60 * 1000);

        if ($this->ReadPropertyInteger('SOCVariable') <= 0 || $this->ReadPropertyInteger('HousePowerVariable') <= 0) {
            $this->SetStatus(200);
        } else {
            $gate = $this->GetAutomaticLearningGateStatus();
            $this->SetStatus(($this->ReadPropertyBoolean('AutomaticEnabled') && !$gate['ready']) ? 202 : 102);
            SetValue($this->GetIDForIdent('AutomaticReleaseStatus'), $gate['text']);
        }

        if (!$this->ReadPropertyBoolean('AutomaticEnabled')) {
            $this->StopFeedIn();
        }
    }

    public function Recalculate()
    {
        try {
            $night = $this->LearnNightConsumptionInternal();
            $forecast = $this->FetchPVForecast();
            SetValue($this->GetIDForIdent('PVCalibrationStatus'), $this->BuildPVCalibrationStatus($forecast));
            $gate = $this->GetAutomaticLearningGateStatus();
            SetValue($this->GetIDForIdent('AutomaticReleaseStatus'), $gate['text']);
            $prices = $this->FetchPrices();
            $plan = $this->BuildPlan($forecast, $prices, $night);

            $this->WriteAttributeString('ForecastJSON', json_encode($forecast));
            $this->WriteAttributeString('PricesJSON', json_encode($prices));
            $this->WriteAttributeString('PlanJSON', json_encode($plan));

            SetValue($this->GetIDForIdent('PVForecastTomorrow'), round($forecast['tomorrowKWh'], 3));
            SetValue($this->GetIDForIdent('NightConsumptionForecast'), round($night, 3));
            SetValue($this->GetIDForIdent('NightConsumptionSource'), $this->ReadAttributeString('NightLearningSource'));
            SetValue($this->GetIDForIdent('ValidNightSamples'), $this->ReadAttributeInteger('NightSampleCount'));
            SetValue($this->GetIDForIdent('AvailableFeedInEnergy'), round($plan['availableKWh'], 3));
            SetValue($this->GetIDForIdent('HighestPrice'), round($plan['highestPriceCt'], 3));
            SetValue($this->GetIDForIdent('ExpectedRevenue'), round($plan['expectedRevenueEUR'], 3));
            SetValue($this->GetIDForIdent('NextFeedInWindow'), $plan['nextWindow']);
            SetValue($this->GetIDForIdent('StatusText'), $plan['status']);
            SetValue($this->GetIDForIdent('LastUpdate'), date('d.m.Y H:i:s'));
            SetValue($this->GetIDForIdent('OverviewHTML'), $this->RenderOverviewHTML($forecast, $plan, $night));
            SetValue($this->GetIDForIdent('PriceChartHTML'), $this->RenderPriceChartHTML($forecast, $prices, $plan));
            SetValue($this->GetIDForIdent('PlanHTML'), $this->RenderPlanHTML($forecast, $prices, $plan));
            $this->SetStatus(($this->ReadPropertyBoolean('AutomaticEnabled') && !$gate['ready']) ? 202 : 102);
            $this->Control();
        } catch (Throwable $e) {
            $this->SendDebug('Recalculate', $e->getMessage(), 0);
            SetValue($this->GetIDForIdent('StatusText'), 'Fehler: ' . $e->getMessage());
            $this->SetStatus(201);
            $this->StopFeedIn();
        }
    }

    public function LearnNightConsumption()
    {
        try {
            $value = $this->LearnNightConsumptionInternal();
            SetValue($this->GetIDForIdent('NightConsumptionForecast'), round($value, 3));
            SetValue($this->GetIDForIdent('NightConsumptionSource'), $this->ReadAttributeString('NightLearningSource'));
            SetValue($this->GetIDForIdent('ValidNightSamples'), $this->ReadAttributeInteger('NightSampleCount'));
            SetValue($this->GetIDForIdent('StatusText'), 'Nachtverbrauch: ' . number_format($value, 2, ',', '.') . ' kWh (' . $this->ReadAttributeString('NightLearningSource') . ')');
        } catch (Throwable $e) {
            SetValue($this->GetIDForIdent('StatusText'), 'Lernen fehlgeschlagen: ' . $e->getMessage());
        }
    }

    public function Control()
    {
        if (!$this->ReadPropertyBoolean('AutomaticEnabled')) {
            $this->StopFeedIn();
            return;
        }

        $gate = $this->GetAutomaticLearningGateStatus();
        SetValue($this->GetIDForIdent('AutomaticReleaseStatus'), $gate['text']);
        if (!$gate['ready']) {
            $this->SetStatus(202);
            SetValue($this->GetIDForIdent('StatusText'), 'Automatik gesperrt: ' . $gate['text']);
            $this->StopFeedIn();
            return;
        }

        $this->SetStatus(102);
        $raw = json_decode($this->ReadAttributeString('PlanJSON'), true);
        if (!is_array($raw) || !isset($raw['slots'])) {
            $this->StopFeedIn();
            return;
        }

        $now = time();
        $active = null;
        foreach ($raw['slots'] as $slot) {
            if ($now >= (int)$slot['start'] && $now < (int)$slot['end'] && (float)$slot['powerW'] > 0) {
                $active = $slot;
                break;
            }
        }

        $price = $this->FindCurrentPrice(json_decode($this->ReadAttributeString('PricesJSON'), true));
        SetValue($this->GetIDForIdent('CurrentPrice'), round($price, 3));

        if ($active === null) {
            $this->StopFeedIn();
            return;
        }

        $this->SetFeedIn(true, (float)$active['powerW']);
    }

    public function StopFeedIn()
    {
        $this->SetFeedIn(false, 0.0);
    }

    private function FetchPVForecast(): array
    {
        $lat = $this->ReadPropertyFloat('Latitude');
        $lon = $this->ReadPropertyFloat('Longitude');
        $surfaces = json_decode($this->ReadPropertyString('PVSurfaces'), true);
        if (!is_array($surfaces) || count($surfaces) === 0) {
            throw new Exception('Keine PV-Flächen konfiguriert.');
        }

        $calibration = json_decode($this->ReadAttributeString('PVCalibrationJSON'), true);
        if (!is_array($calibration)) $calibration = [];
        $hours = [];
        $surfaceTotals = [];
        $surfaceCalibration = [];
        $nowHour = strtotime(date('Y-m-d H:00:00'));

        foreach ($surfaces as $idx => $surface) {
            if (empty($surface['Active']) || (float)($surface['KWp'] ?? 0) <= 0) {
                continue;
            }
            $name = trim((string)($surface['Name'] ?? 'PV'));
            if ($name === '') $name = 'PV ' . ($idx + 1);
            $key = $this->SurfaceKey($name, $idx);
            $kwp = (float)$surface['KWp'];
            $orientationKnown = !array_key_exists('OrientationKnown', $surface) || (bool)$surface['OrientationKnown'];
            // Bei unbekannter Ausrichtung wird während der Lernphase eine horizontale Referenz verwendet.
            // Die reale Stringleistung kalibriert diese Referenz; die Einspeise-Automatik bleibt bis zum Ende der Lernphase gesperrt.
            $tilt = $orientationKnown ? (float)($surface['Tilt'] ?? 0) : 0.0;
            // Azimut wird direkt in der Open-Meteo-Konvention eingegeben:
            // 0=Süd, -90=Ost, +90=West, -180/+180=Nord.
            $azOM = $orientationKnown ? max(-180.0, min(180.0, (float)($surface['Azimuth'] ?? 0))) : 0.0;
            $manualFactor = max(0.01, (float)($surface['Factor'] ?? 1.0));
            $autoEnabled = !array_key_exists('AutoCalibrate', $surface) || (bool)$surface['AutoCalibrate'];
            $autoFactor = 1.0;
            if ($autoEnabled && isset($calibration[$key]['factor'])) {
                $autoFactor = (float)$calibration[$key]['factor'];
            }
            $autoFactor = max($this->ReadPropertyFloat('PVCalibrationMinFactor'), min($this->ReadPropertyFloat('PVCalibrationMaxFactor'), $autoFactor));

            $url = 'https://api.open-meteo.com/v1/forecast?' . http_build_query([
                'latitude' => $lat,
                'longitude' => $lon,
                'hourly' => 'global_tilted_irradiance',
                'tilt' => $tilt,
                'azimuth' => $azOM,
                'timezone' => 'auto',
                'forecast_days' => 3
            ]);
            $data = $this->HttpGetJson($url);
            if (!isset($data['hourly']['time'], $data['hourly']['global_tilted_irradiance'])) {
                throw new Exception('Ungültige Open-Meteo-Antwort für Fläche ' . $name);
            }

            $sum = 0.0;
            $currentExpectedBaseW = 0.0;
            foreach ($data['hourly']['time'] as $i => $timeStr) {
                $ts = strtotime($timeStr);
                $gti = max(0.0, (float)$data['hourly']['global_tilted_irradiance'][$i]);
                $basePowerKW = $kwp * ($gti / 1000.0) * $this->ReadPropertyFloat('SystemEfficiency') * $manualFactor * $this->ReadPropertyFloat('GlobalPVFactor');
                $powerKW = $basePowerKW * ($autoEnabled ? $autoFactor : 1.0);
                if (!isset($hours[$ts])) $hours[$ts] = ['totalKW' => 0.0, 'surfaces' => []];
                $hours[$ts]['totalKW'] += $powerKW;
                $hours[$ts]['surfaces'][$name] = $powerKW;

                if ($ts === $nowHour) {
                    $currentExpectedBaseW = $basePowerKW * 1000.0;
                }
                if (date('Y-m-d', $ts) === date('Y-m-d', strtotime('tomorrow'))) {
                    $sum += $powerKW;
                }
            }

            $actualW = $this->ReadSurfaceActualPower($surface);
            if ($autoEnabled && $actualW !== null && $currentExpectedBaseW >= $this->ReadPropertyInteger('PVCalibrationMinExpectedW')) {
                $calibration = $this->AddPVCalibrationSample($calibration, $key, $currentExpectedBaseW, $actualW);
                $autoFactor = isset($calibration[$key]['factor']) ? (float)$calibration[$key]['factor'] : $autoFactor;
            }

            $surfaceTotals[$name] = $sum;
            $surfaceCalibration[$name] = [
                'key' => $key,
                'manualFactor' => $manualFactor,
                'orientationKnown' => $orientationKnown,
                'autoEnabled' => $autoEnabled,
                'autoFactor' => $autoFactor,
                'effectiveFactor' => $manualFactor * ($autoEnabled ? $autoFactor : 1.0),
                'expectedBaseW' => $currentExpectedBaseW,
                'actualW' => $actualW,
                'sampleCount' => isset($calibration[$key]['samples']) && is_array($calibration[$key]['samples']) ? count($calibration[$key]['samples']) : 0
            ];
        }

        $this->WriteAttributeString('PVCalibrationJSON', json_encode($calibration));
        ksort($hours);
        $tomorrow = 0.0;
        foreach ($hours as $ts => $h) {
            if (date('Y-m-d', (int)$ts) === date('Y-m-d', strtotime('tomorrow'))) {
                $tomorrow += $h['totalKW'];
            }
        }

        $morningThresholdKW = max(0.1, $this->ReadPropertyInteger('MorningPVThresholdW') / 1000.0);
        $morningTs = strtotime('tomorrow ' . str_pad((string)$this->ReadPropertyInteger('FallbackMorningHour'), 2, '0', STR_PAD_LEFT) . ':00');
        foreach ($hours as $ts => $h) {
            if ((int)$ts >= strtotime('tomorrow 00:00') && (int)$ts < strtotime('tomorrow 12:00') && $h['totalKW'] >= $morningThresholdKW) {
                $morningTs = (int)$ts;
                break;
            }
        }

        return [
            'tomorrowKWh' => $tomorrow,
            'morningTs' => $morningTs,
            'hours' => $hours,
            'surfaceTotals' => $surfaceTotals,
            'surfaceCalibration' => $surfaceCalibration
        ];
    }

    private function SurfaceKey(string $name, int $index): string
    {
        return md5($index . '|' . $name);
    }

    private function ReadSurfaceActualPower(array $surface): ?float
    {
        $sum = 0.0;
        $count = 0;
        foreach (['PVVariable1', 'PVVariable2', 'PVVariable3'] as $field) {
            $id = (int)($surface[$field] ?? 0);
            if ($id <= 0 || !@IPS_VariableExists($id)) continue;
            try {
                $sum += max(0.0, (float)GetValue($id));
                $count++;
            } catch (Throwable $e) {
                $this->SendDebug('PVCalibration', 'Variable ' . $id . ' konnte nicht gelesen werden: ' . $e->getMessage(), 0);
            }
        }
        return $count > 0 ? $sum : null;
    }

    private function AddPVCalibrationSample(array $calibration, string $key, float $expectedW, float $actualW): array
    {
        if (!isset($calibration[$key]) || !is_array($calibration[$key])) {
            $calibration[$key] = ['factor' => 1.0, 'samples' => []];
        }
        if (!isset($calibration[$key]['samples']) || !is_array($calibration[$key]['samples'])) {
            $calibration[$key]['samples'] = [];
        }

        $now = time();
        // Höchstens ein Messpunkt je 20 Minuten, damit manuelles Neuberechnen den Lernwert nicht verzerrt.
        $lastTs = isset($calibration[$key]['lastSampleTs']) ? (int)$calibration[$key]['lastSampleTs'] : 0;
        if ($now - $lastTs >= 1200) {
            $calibration[$key]['samples'][] = ['ts' => $now, 'expectedW' => $expectedW, 'actualW' => $actualW];
            $calibration[$key]['lastSampleTs'] = $now;
        }

        $retentionDays = max(1, $this->ReadPropertyInteger('PVCalibrationDays'), $this->ReadPropertyInteger('UnknownOrientationLearningDays'));
        $cutoff = $now - $retentionDays * 86400;
        $samples = [];
        foreach ($calibration[$key]['samples'] as $sample) {
            if ((int)($sample['ts'] ?? 0) < $cutoff) continue;
            $exp = (float)($sample['expectedW'] ?? 0);
            $act = (float)($sample['actualW'] ?? 0);
            if ($exp < $this->ReadPropertyInteger('PVCalibrationMinExpectedW')) continue;
            if ($act < 0) continue;
            $samples[] = ['ts' => (int)$sample['ts'], 'expectedW' => $exp, 'actualW' => $act];
        }
        $calibration[$key]['samples'] = $samples;

        if (count($samples) > 0) {
            $sumExpected = array_sum(array_column($samples, 'expectedW'));
            $sumActual = array_sum(array_column($samples, 'actualW'));
            if ($sumExpected > 0) {
                $factor = $sumActual / $sumExpected;
                $factor = max($this->ReadPropertyFloat('PVCalibrationMinFactor'), min($this->ReadPropertyFloat('PVCalibrationMaxFactor'), $factor));
                $calibration[$key]['factor'] = $factor;
            }
        }
        $calibration[$key]['lastExpectedW'] = $expectedW;
        $calibration[$key]['lastActualW'] = $actualW;
        $calibration[$key]['updated'] = $now;
        return $calibration;
    }

    private function BuildPVCalibrationStatus(array $forecast): string
    {
        if (!isset($forecast['surfaceCalibration']) || !is_array($forecast['surfaceCalibration'])) return '-';
        $parts = [];
        foreach ($forecast['surfaceCalibration'] as $name => $c) {
            if (empty($c['autoEnabled'])) {
                $parts[] = $name . ': manuell';
                continue;
            }
            if ($c['actualW'] === null) {
                $parts[] = $name . ': keine String-Variable';
                continue;
            }
                        if (empty($c['orientationKnown'])) {
                $days = $this->GetSurfaceLearningDayCount((string)$c['key']);
                $required = max(1, $this->ReadPropertyInteger('UnknownOrientationLearningDays'));
                $parts[] = $name . ': Ausrichtung unbekannt, Lernphase ' . $days . '/' . $required . ' Tage, Auto ' . number_format((float)$c['autoFactor'], 3, ',', '.') . ' (' . (int)$c['sampleCount'] . ' Werte)';
            } else {
                $parts[] = $name . ': Auto ' . number_format((float)$c['autoFactor'], 3, ',', '.') . ' (' . (int)$c['sampleCount'] . ' Werte)';
            }
        }
        return count($parts) ? implode(' | ', $parts) : '-';
    }

    private function GetAutomaticLearningGateStatus(): array
    {
        $surfaces = json_decode($this->ReadPropertyString('PVSurfaces'), true);
        if (!is_array($surfaces)) {
            return ['ready' => true, 'text' => 'Freigegeben'];
        }

        $required = max(1, $this->ReadPropertyInteger('UnknownOrientationLearningDays'));
        $waiting = [];
        foreach ($surfaces as $idx => $surface) {
            if (empty($surface['Active']) || (float)($surface['KWp'] ?? 0) <= 0) continue;
            $orientationKnown = !array_key_exists('OrientationKnown', $surface) || (bool)$surface['OrientationKnown'];
            if ($orientationKnown) continue;

            $name = trim((string)($surface['Name'] ?? 'PV'));
            if ($name === '') $name = 'PV ' . ($idx + 1);
            $hasPowerVariable = false;
            foreach (['PVVariable1', 'PVVariable2', 'PVVariable3'] as $field) {
                $id = (int)($surface[$field] ?? 0);
                if ($id > 0 && @IPS_VariableExists($id)) {
                    $hasPowerVariable = true;
                    break;
                }
            }
            if (!$hasPowerVariable) {
                $waiting[] = $name . ': keine PV-Stringvariable';
                continue;
            }
            if (array_key_exists('AutoCalibrate', $surface) && !(bool)$surface['AutoCalibrate']) {
                $waiting[] = $name . ': Auto-Kalibrierung deaktiviert';
                continue;
            }
            $key = $this->SurfaceKey($name, $idx);
            $days = $this->GetSurfaceLearningDayCount($key);
            if ($days < $required) {
                $waiting[] = $name . ' ' . $days . '/' . $required . ' Tage';
            }
        }

        if (count($waiting) > 0) {
            return ['ready' => false, 'text' => 'Lernphase: ' . implode(', ', $waiting)];
        }
        return ['ready' => true, 'text' => 'Freigegeben'];
    }

    private function GetSurfaceLearningDayCount(string $key): int
    {
        $calibration = json_decode($this->ReadAttributeString('PVCalibrationJSON'), true);
        if (!is_array($calibration) || !isset($calibration[$key]['samples']) || !is_array($calibration[$key]['samples'])) {
            return 0;
        }
        $days = [];
        foreach ($calibration[$key]['samples'] as $sample) {
            $ts = (int)($sample['ts'] ?? 0);
            $exp = (float)($sample['expectedW'] ?? 0);
            if ($ts <= 0 || $exp < $this->ReadPropertyInteger('PVCalibrationMinExpectedW')) continue;
            $days[date('Y-m-d', $ts)] = true;
        }
        return count($days);
    }

    private function FetchPrices(): array
    {
        if ($this->ReadPropertyInteger('PriceSource') === 1) {
            $vid = $this->ReadPropertyInteger('PriceJSONVariable');
            if ($vid <= 0) throw new Exception('JSON-Preisvariable nicht gewählt.');
            $data = json_decode((string)GetValue($vid), true);
            if (!is_array($data)) throw new Exception('JSON-Preisvariable enthält kein gültiges JSON.');
            return $this->NormalizeCustomPrices($data);
        }

        $start = strtotime('today 00:00') * 1000;
        $end = strtotime('+2 days 23:59:59') * 1000;
        $url = 'https://api.awattar.at/v1/marketdata?start=' . $start . '&end=' . $end;
        $data = $this->HttpGetJson($url);
        if (!isset($data['data']) || !is_array($data['data'])) throw new Exception('Ungültige aWATTar-Antwort.');

        $prices = [];
        foreach ($data['data'] as $row) {
            $rawCt = ((float)$row['marketprice']) / 10.0; // EUR/MWh -> ct/kWh
            $effective = $this->CalculateFeedInTariff($rawCt);
            $prices[] = [
                'start' => (int)round(((int)$row['start_timestamp']) / 1000),
                'end' => (int)round(((int)$row['end_timestamp']) / 1000),
                'marketCt' => $rawCt,
                'priceCt' => $effective
            ];
        }
        usort($prices, fn($a, $b) => $a['start'] <=> $b['start']);
        return $prices;
    }


    private function CalculateFeedInTariff(float $marketCt): float
    {
        switch ($this->ReadPropertyInteger('FeedInTariffProvider')) {
            case 0: // KELAG Sonnenplus Smart: EPEX SPOT AT Stundenpreis 1:1
            case 1: // Reiner EPEX SPOT AT Marktpreis
                return $marketCt;

            case 2: // aWATTar SUNNY Spot 60min: Marktpreis minus 19 % des absoluten Marktpreises
                return $marketCt - (abs($marketCt) * 0.19);

            case 3: // Benutzerdefinierter Tarif
            default:
                $factor = $marketCt >= 0
                    ? $this->ReadPropertyFloat('PositivePriceFactor')
                    : $this->ReadPropertyFloat('NegativePriceFactor');
                return $marketCt * $factor + $this->ReadPropertyFloat('PriceAdjustmentCt');
        }
    }

    private function NormalizeCustomPrices(array $data): array
    {
        $prices = [];
        foreach ($data as $row) {
            if (!isset($row['start'], $row['priceCt'])) continue;
            $start = is_numeric($row['start']) ? (int)$row['start'] : strtotime((string)$row['start']);
            $end = isset($row['end']) ? (is_numeric($row['end']) ? (int)$row['end'] : strtotime((string)$row['end'])) : $start + 3600;
            $marketCt = isset($row['marketCt']) ? (float)$row['marketCt'] : (float)$row['priceCt'];
            $prices[] = ['start' => $start, 'end' => $end, 'marketCt' => $marketCt, 'priceCt' => (float)$row['priceCt']];
        }
        return $prices;
    }

    private function BuildPlan(array $forecast, array $prices, float $nightKWh): array
    {
        $socVar = $this->ReadPropertyInteger('SOCVariable');
        if ($socVar <= 0) throw new Exception('SoC-Variable fehlt.');
        $soc = max(0.0, min(100.0, (float)GetValue($socVar)));
        $capacity = $this->ReadPropertyFloat('BatteryCapacityKWh');
        $stored = $capacity * $soc / 100.0;
        $minEnergy = $capacity * $this->ReadPropertyFloat('MinimumSOC') / 100.0;
        $reserve = $nightKWh * (1.0 + $this->ReadPropertyFloat('SafetyReservePct') / 100.0);

        $tomorrowPV = (float)$forecast['tomorrowKWh'];
        if ($tomorrowPV < $this->ReadPropertyFloat('MinimumTomorrowPVKWh')) {
            $reserve *= (1.0 + $this->ReadPropertyFloat('PoorForecastExtraReservePct') / 100.0);
        }

        $status = 'Optimierung aktiv';
        if ($this->ReadPropertyBoolean('DisableFeedInOnVeryPoorForecast') && $tomorrowPV < $this->ReadPropertyFloat('VeryPoorForecastKWh')) {
            $available = 0.0;
            $status = 'Einspeisung gesperrt: PV-Prognose sehr schlecht';
        } else {
            $available = max(0.0, $stored - $minEnergy - $reserve);
        }

        $horizonEnd = max(time() + 3600, (int)$forecast['morningTs']);
        $eligible = [];
        foreach ($prices as $p) {
            if ($p['end'] <= time() || $p['start'] >= $horizonEnd) continue;
            if ($p['priceCt'] < $this->ReadPropertyFloat('MinimumFeedInPriceCt')) continue;
            $eligible[] = $p;
        }
        usort($eligible, fn($a, $b) => $b['priceCt'] <=> $a['priceCt']);

        $remaining = $available;
        $maxKW = max(0.0, $this->ReadPropertyInteger('MaxDischargePowerW') / 1000.0);
        $selected = [];
        $revenue = 0.0;
        foreach ($eligible as $p) {
            if ($remaining <= 0.001 || $maxKW <= 0) break;
            $durationH = max(0.0, ($p['end'] - max($p['start'], time())) / 3600.0);
            if ($durationH <= 0) continue;
            $maxEnergySlot = $maxKW * $durationH;
            $energy = min($remaining, $maxEnergySlot);
            $powerKW = $durationH > 0 ? min($maxKW, $energy / $durationH) : 0;
            $selected[] = [
                'start' => max($p['start'], time()),
                'end' => $p['end'],
                'priceCt' => $p['priceCt'],
                'marketCt' => $p['marketCt'],
                'energyKWh' => $energy,
                'powerW' => $powerKW * 1000.0
            ];
            $revenue += $energy * $p['priceCt'] / 100.0;
            $remaining -= $energy;
        }
        usort($selected, fn($a, $b) => $a['start'] <=> $b['start']);

        $next = '-';
        foreach ($selected as $s) {
            if ($s['end'] > time()) {
                $next = date('d.m. H:i', $s['start']) . '–' . date('H:i', $s['end']);
                break;
            }
        }
        $highest = count($selected) ? max(array_column($selected, 'priceCt')) : 0.0;

        return [
            'soc' => $soc,
            'storedKWh' => $stored,
            'reserveKWh' => $reserve,
            'minimumEnergyKWh' => $minEnergy,
            'availableKWh' => $available,
            'remainingUnscheduledKWh' => $remaining,
            'highestPriceCt' => $highest,
            'expectedRevenueEUR' => $revenue,
            'nextWindow' => $next,
            'status' => $status,
            'slots' => $selected
        ];
    }

    private function LearnNightConsumptionInternal(): float
    {
        $fallback = max(0.0, $this->ReadPropertyFloat('FallbackNightConsumptionKWh'));
        $varID = $this->ReadPropertyInteger('HousePowerVariable');

        if ($varID <= 0 || !@IPS_VariableExists($varID)) {
            return $this->UseNightFallback($fallback, 'Fallback – Hausverbrauchsvariable fehlt', 0);
        }

        $archiveID = $this->FindArchive();
        if ($archiveID <= 0) {
            return $this->UseNightFallback($fallback, 'Fallback – Archiv nicht gefunden', 0);
        }

        // Der Benutzer wählt die normale Variable. Das Archiv protokolliert genau diese Variable-ID.
        // Falls die Protokollierung nicht aktiv ist, wird nicht abgebrochen, sondern ein Ersatzwert benutzt.
        if (function_exists('AC_GetLoggingStatus')) {
            try {
                if (!AC_GetLoggingStatus($archiveID, $varID)) {
                    return $this->UseNightFallback($fallback, 'Fallback – Variable nicht archiviert', 0);
                }
            } catch (Throwable $e) {
                $this->SendDebug('NightArchive', 'Logging-Status konnte nicht geprüft werden: ' . $e->getMessage(), 0);
            }
        }

        $days = max(3, $this->ReadPropertyInteger('LearningDays'));
        $minimumSamples = max(1, min($days, $this->ReadPropertyInteger('MinimumValidNights')));
        $samples = [];
        for ($d = 1; $d <= $days; $d++) {
            $day = strtotime('-' . $d . ' days 00:00');
            $start = strtotime(date('Y-m-d', $day) . ' ' . str_pad((string)$this->ReadPropertyInteger('NightStartHour'), 2, '0', STR_PAD_LEFT) . ':00');
            $end = $this->DetermineMorningEnd($archiveID, $day + 86400);
            if ($end <= $start) continue;
            $kwh = $this->IntegratePowerVariable($archiveID, $varID, $start, $end);
            if ($kwh > 0.05 && is_finite($kwh)) {
                // Reihenfolge beibehalten: zuerst die neuesten Nächte.
                $samples[] = ['age' => $d, 'kWh' => $kwh];
            }
        }

        $this->WriteAttributeInteger('NightSampleCount', count($samples));

        if (count($samples) < $minimumSamples) {
            $learned = $this->ReadAttributeFloat('LearnedNightKWh');
            if ($learned > 0.05) {
                $source = 'Letzter Lernwert – nur ' . count($samples) . '/' . $minimumSamples . ' gültige Nächte';
                $this->WriteAttributeString('NightLearningSource', $source);
                $this->SendDebug('NightConsumption', $source, 0);
                return $learned;
            }
            return $this->UseNightFallback($fallback, 'Fallback – nur ' . count($samples) . '/' . $minimumSamples . ' gültige Nächte', count($samples));
        }

        $values = array_column($samples, 'kWh');
        $median = $this->Median($values);
        $band = $this->ReadPropertyFloat('OutlierPct') / 100.0;
        $filtered = array_values(array_filter($samples, function ($sample) use ($median, $band) {
            $v = (float)$sample['kWh'];
            if ($median <= 0) return true;
            return $v >= $median * max(0.0, 1.0 - $band) && $v <= $median * (1.0 + $band);
        }));
        if (count($filtered) < $minimumSamples) $filtered = $samples;

        // Zeitgewichtung: neueste 7 Nächte 60 %, Tage 8–14 25 %, ältere Nächte 15 %.
        $groups = [[], [], []];
        foreach ($filtered as $sample) {
            $age = (int)$sample['age'];
            $idx = $age <= 7 ? 0 : ($age <= 14 ? 1 : 2);
            $groups[$idx][] = (float)$sample['kWh'];
        }
        $groupWeights = [0.60, 0.25, 0.15];
        $weightedSum = 0.0;
        $usedWeight = 0.0;
        foreach ($groups as $idx => $group) {
            if (count($group) === 0) continue;
            $groupAvg = array_sum($group) / count($group);
            $weightedSum += $groupAvg * $groupWeights[$idx];
            $usedWeight += $groupWeights[$idx];
        }
        $weightedAvg = $usedWeight > 0 ? $weightedSum / $usedWeight : $median;
        $learned = 0.75 * $weightedAvg + 0.25 * $median;

        $this->WriteAttributeFloat('LearnedNightKWh', $learned);
        $this->WriteAttributeInteger('NightSampleCount', count($filtered));
        $source = 'Archiv gelernt – ' . count($filtered) . ' gültige Nächte';
        $this->WriteAttributeString('NightLearningSource', $source);
        $this->SendDebug('NightConsumption', $source . ', Prognose ' . round($learned, 3) . ' kWh', 0);
        return $learned;
    }

    private function UseNightFallback(float $fallback, string $source, int $samples): float
    {
        $this->WriteAttributeString('NightLearningSource', $source);
        $this->WriteAttributeInteger('NightSampleCount', $samples);
        $this->SendDebug('NightConsumption', $source . ', Wert ' . round($fallback, 3) . ' kWh', 0);
        return $fallback;
    }

    private function DetermineMorningEnd(int $archiveID, int $morningDayTs): int
    {
        $pvID = $this->ReadPropertyInteger('PVActualPowerVariable');
        $fallback = strtotime(date('Y-m-d', $morningDayTs) . ' ' . str_pad((string)$this->ReadPropertyInteger('FallbackMorningHour'), 2, '0', STR_PAD_LEFT) . ':00');
        if ($pvID <= 0) return $fallback;

        $start = strtotime(date('Y-m-d', $morningDayTs) . ' 04:00');
        $end = strtotime(date('Y-m-d', $morningDayTs) . ' 12:00');
        $values = @AC_GetLoggedValues($archiveID, $pvID, $start, $end, 0);
        if (!is_array($values) || count($values) === 0) return $fallback;
        $values = array_reverse($values);
        $threshold = $this->ReadPropertyInteger('MorningPVThresholdW');
        foreach ($values as $v) {
            if ((float)$v['Value'] >= $threshold) return (int)$v['TimeStamp'];
        }
        return $fallback;
    }

    private function IntegratePowerVariable(int $archiveID, int $varID, int $start, int $end): float
    {
        $values = @AC_GetLoggedValues($archiveID, $varID, $start, $end, 0);
        if (!is_array($values) || count($values) === 0) return 0.0;
        $values = array_reverse($values);

        // Include last known value before the interval to integrate change-only archive data correctly.
        $prev = @AC_GetLoggedValues($archiveID, $varID, 0, $start - 1, 1);
        if (is_array($prev) && count($prev) > 0) {
            array_unshift($values, ['TimeStamp' => $start, 'Value' => $prev[0]['Value']]);
        }

        $wh = 0.0;
        for ($i = 0; $i < count($values); $i++) {
            $t1 = max($start, (int)$values[$i]['TimeStamp']);
            $t2 = ($i + 1 < count($values)) ? min($end, (int)$values[$i + 1]['TimeStamp']) : $end;
            if ($t2 <= $t1) continue;
            $powerW = max(0.0, (float)$values[$i]['Value']);
            $wh += $powerW * (($t2 - $t1) / 3600.0);
        }
        return $wh / 1000.0;
    }

    private function SetFeedIn(bool $enable, float $powerW)
    {
        $enableID = $this->ReadPropertyInteger('FeedInEnableVariable');
        $powerID = $this->ReadPropertyInteger('DischargePowerVariable');
        if ($powerID > 0) {
            $setpoint = $this->ReadPropertyBoolean('InvertPowerSetpoint') ? -abs($powerW) : abs($powerW);
            if (!$enable) $setpoint = 0;
            $this->WriteVariableSmart($powerID, $setpoint);
        }
        if ($enableID > 0) {
            $this->WriteVariableSmart($enableID, $enable);
        }
        SetValue($this->GetIDForIdent('FeedInActive'), $enable);
        SetValue($this->GetIDForIdent('PlannedPower'), $enable ? abs($powerW) : 0.0);
    }

    private function WriteVariableSmart(int $variableID, $value)
    {
        try {
            RequestAction($variableID, $value);
        } catch (Throwable $e) {
            SetValue($variableID, $value);
        }
    }

    private function FindCurrentPrice(array $prices): float
    {
        $now = time();
        foreach ($prices as $p) if ($now >= $p['start'] && $now < $p['end']) return (float)$p['priceCt'];
        return 0.0;
    }

    private function FindArchive(): int
    {
        $ids = IPS_GetInstanceListByModuleID(self::ARCHIVE_GUID);
        return count($ids) ? (int)$ids[0] : 0;
    }

    private function Median(array $values): float
    {
        sort($values);
        $n = count($values);
        $m = intdiv($n, 2);
        return ($n % 2) ? (float)$values[$m] : ((float)$values[$m - 1] + (float)$values[$m]) / 2.0;
    }

    private function HttpGetJson(string $url): array
    {
        $opts = ['http' => ['timeout' => 12, 'header' => "User-Agent: IP-Symcon-SmartBatteryOptimizer/1.2.4\r\n"]];
        $ctx = stream_context_create($opts);
        $raw = @file_get_contents($url, false, $ctx);
        if ($raw === false) throw new Exception('HTTP-Abruf fehlgeschlagen.');
        $data = json_decode($raw, true);
        if (!is_array($data)) throw new Exception('Antwort ist kein gültiges JSON.');
        return $data;
    }

    private function BuildPriceChartRows(array $forecast, array $prices, array $plan): array
    {
        $rows = [];
        foreach ($prices as $p) {
            if ($p['end'] <= time() || $p['start'] > $forecast['morningTs']) continue;

            $slot = null;
            foreach ($plan['slots'] as $s) {
                if (abs($s['start'] - $p['start']) < 120 || ($s['start'] >= $p['start'] && $s['start'] < $p['end'])) {
                    $slot = $s;
                    break;
                }
            }

            $rows[] = [
                'label' => date('d.m. H:i', $p['start']),
                'marketCt' => round((float)$p['marketCt'], 4),
                'priceCt' => round((float)$p['priceCt'], 4),
                'selected' => $slot !== null,
                'powerW' => $slot ? round((float)$slot['powerW'], 1) : 0.0,
                'energyKWh' => $slot ? round((float)$slot['energyKWh'], 4) : 0.0
            ];
        }
        return $rows;
    }

    private function RenderOverviewHTML(array $forecast, array $plan, float $night): string
    {
        $html = '<div style="font-family:Tahoma;font-size:12px">';
        $html .= '<b>Börsenpreis-Speicheroptimierung</b><br><br>';
        $html .= 'SoC: <b>' . number_format($plan['soc'], 1, ',', '.') . ' %</b><br>';
        $html .= 'Speicherinhalt: <b>' . number_format($plan['storedKWh'], 2, ',', '.') . ' kWh</b><br>';
        $html .= 'Nachtverbrauch Prognose: <b>' . number_format($night, 2, ',', '.') . ' kWh</b><br>';
        $html .= 'Quelle Nachtverbrauch: <b>' . htmlspecialchars($this->ReadAttributeString('NightLearningSource')) . '</b><br>';
        $html .= 'Reserve inkl. Sicherheit: <b>' . number_format($plan['reserveKWh'], 2, ',', '.') . ' kWh</b><br>';
        $html .= 'PV morgen: <b>' . number_format($forecast['tomorrowKWh'], 2, ',', '.') . ' kWh</b><br>';
        $html .= 'PV ausreichend ab ca.: <b>' . date('H:i', $forecast['morningTs']) . '</b><br>';
        $html .= 'Für Einspeisung verfügbar: <b>' . number_format($plan['availableKWh'], 2, ',', '.') . ' kWh</b><br>';
        $html .= 'Erwarteter Erlös: <b>' . number_format($plan['expectedRevenueEUR'], 2, ',', '.') . ' €</b><br>';
        $html .= 'Status: <b>' . htmlspecialchars($plan['status']) . '</b>';
        return $html . '</div>';
    }

    private function RenderPriceChartHTML(array $forecast, array $prices, array $plan): string
    {
        $highchartsJS = $this->GetHighchartsJavaScript();
        $chartId = 'sbo_price_chart_' . $this->InstanceID;
        $chartRows = $this->BuildPriceChartRows($forecast, $prices, $plan);
        $chartJson = json_encode($chartRows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $minimumPrice = $this->ReadPropertyFloat('MinimumFeedInPriceCt');

        $html = '<div style="font-family:Tahoma;font-size:12px;color:#fff">';
        $html .= '<b>Einspeisevergütung bis zur nächsten PV-Phase</b><br>';
        if ($highchartsJS !== '') {
            $html .= '<div id="' . $chartId . '" style="width:100%;height:390px;margin-top:8px;margin-bottom:10px"></div>';
            $html .= '<script>' . $highchartsJS . '</script>';
            $html .= '<script>(function(){';
            $html .= 'var rows=' . $chartJson . ';';
            $html .= 'function renderSBOChart(){';
            $html .= 'if(typeof Highcharts==="undefined"){return;}';
            $html .= 'var categories=rows.map(function(r){return r.label;});';
            $html .= 'var market=rows.map(function(r){return {y:r.priceCt,color:r.selected?"#38a169":(r.priceCt<0?"#d9534f":"#4e8fd3"),custom:r};});';
            $html .= 'Highcharts.chart(' . json_encode($chartId) . ',{';
            $html .= 'chart:{type:"column",backgroundColor:"transparent",animation:false,style:{fontFamily:"Tahoma",color:"#ffffff"}},';
            $html .= 'title:{text:null,style:{fontFamily:"Tahoma",color:"#ffffff"}},credits:{enabled:false},legend:{enabled:false,itemStyle:{fontFamily:"Tahoma",color:"#ffffff"},itemHoverStyle:{color:"#ffffff"}},';
            $html .= 'xAxis:{categories:categories,lineColor:"#ffffff",tickColor:"#ffffff",labels:{rotation:-45,style:{fontFamily:"Tahoma",fontSize:"10px",color:"#ffffff"}}},';
            $html .= 'yAxis:{title:{text:"ct/kWh",style:{fontFamily:"Tahoma",color:"#ffffff"}},labels:{style:{fontFamily:"Tahoma",fontSize:"10px",color:"#ffffff"}},gridLineColor:"rgba(255,255,255,0.18)",plotLines:[{value:0,color:"#ffffff",width:1,zIndex:4},{value:' . json_encode($minimumPrice) . ',color:"#e0a000",width:1,dashStyle:"Dash",zIndex:4,label:{text:"Mindestpreis ' . number_format($minimumPrice, 2, ',', '.') . ' ct",style:{fontFamily:"Tahoma",fontSize:"10px",color:"#ffffff"}}}]},';
            $html .= 'tooltip:{useHTML:true,backgroundColor:"rgba(30,30,30,0.96)",borderColor:"#888888",style:{fontFamily:"Tahoma",color:"#ffffff",fontSize:"11px"},formatter:function(){var r=this.point.custom;return "<span style=\\"font-family:Tahoma;color:#fff\\"><b>"+r.label+"</b><br>Börsenpreis: <b>"+Highcharts.numberFormat(r.marketCt,2,",",".")+" ct/kWh</b><br>Berechneter Tarif: "+Highcharts.numberFormat(r.priceCt,2,",",".")+" ct/kWh"+(r.selected?"<br><b>Einspeisung geplant</b><br>Leistung: "+Highcharts.numberFormat(r.powerW/1000,2,",",".")+" kW<br>Energie: "+Highcharts.numberFormat(r.energyKWh,2,",",".")+" kWh":"")+"</span>";}},';
            $html .= 'plotOptions:{column:{borderWidth:0,groupPadding:0.08,pointPadding:0.03,dataLabels:{enabled:true,crop:false,overflow:"allow",formatter:function(){return Highcharts.numberFormat(this.y,2,",",".")+" ct";},style:{fontFamily:"Tahoma",fontSize:"10px",fontWeight:"normal",color:"#ffffff",textOutline:"none"}}}},';
            $html .= 'series:[{name:"Einspeisevergütung",data:market}]';
            $html .= '});}';
            $html .= 'if(document.readyState==="loading"){document.addEventListener("DOMContentLoaded",renderSBOChart);}else{setTimeout(renderSBOChart,0);}';
            $html .= '})();</script>';
        } else {
            $html .= $this->RenderFallbackPriceChart($chartRows, $minimumPrice);
        }
        $html .= '<div style="font-family:Tahoma;font-size:11px;color:#fff;margin-bottom:8px">Grün = für Batterieeinspeisung ausgewählt, Rot = negative Einspeisevergütung, Blau = übrige Preisintervalle.</div>';
        return $html . '</div>';
    }

    private function RenderPlanHTML(array $forecast, array $prices, array $plan): string
    {
        $html = '<div style="font-family:Tahoma;font-size:12px">';
        $html .= '<b>Einspeiseplan</b><br><br>';
        $html .= '<table style="border-collapse:collapse;width:100%"><tr><th style="text-align:left">Zeit</th><th>Markt</th><th>Tarif</th><th>Leistung</th><th>Energie</th></tr>';
        foreach ($prices as $p) {
            if ($p['end'] <= time() || $p['start'] > $forecast['morningTs']) continue;
            $slot = null;
            foreach ($plan['slots'] as $s) {
                if (abs($s['start'] - $p['start']) < 120 || ($s['start'] >= $p['start'] && $s['start'] < $p['end'])) { $slot = $s; break; }
            }
            $html .= '<tr style="border-top:1px solid #555"><td>' . date('d.m. H:i', $p['start']) . '</td>';
            $html .= '<td style="text-align:right">' . number_format($p['marketCt'], 2, ',', '.') . ' ct</td>';
            $html .= '<td style="text-align:right"><b>' . number_format($p['priceCt'], 2, ',', '.') . ' ct</b></td>';
            $html .= '<td style="text-align:right">' . ($slot ? number_format($slot['powerW']/1000, 2, ',', '.') . ' kW' : '-') . '</td>';
            $html .= '<td style="text-align:right">' . ($slot ? number_format($slot['energyKWh'], 2, ',', '.') . ' kWh' : '-') . '</td></tr>';
        }
        $html .= '</table><br><b>PV-Flächen morgen</b><br>';
        foreach ($forecast['surfaceTotals'] as $name => $kwh) {
            $html .= htmlspecialchars($name) . ': ' . number_format($kwh, 2, ',', '.') . ' kWh<br>';
        }
        if (isset($forecast['surfaceCalibration']) && is_array($forecast['surfaceCalibration'])) {
            $html .= '<br><b>PV-Flächen Kalibrierung</b><br>';
            foreach ($forecast['surfaceCalibration'] as $name => $c) {
                $actual = $c['actualW'] === null ? '-' : number_format((float)$c['actualW'], 0, ',', '.') . ' W';
                $expected = number_format((float)$c['expectedBaseW'], 0, ',', '.') . ' W';
                $mode = empty($c['autoEnabled']) ? 'manuell' : ('Auto-Faktor ' . number_format((float)$c['autoFactor'], 3, ',', '.'));
                $html .= htmlspecialchars($name) . ': erwartet ' . $expected . ' | Ist ' . $actual . ' | ' . $mode . ' | ' . (int)$c['sampleCount'] . ' Werte<br>';
            }
        }
        return $html . '</div>';
    }

    private function RenderFallbackPriceChart(array $rows, float $minimumPrice): string
    {
        if (count($rows) === 0) {
            return '<div style="margin:8px 0 14px 0;padding:10px;border:1px solid #777;border-radius:6px">Keine Preisdaten für die Balkengrafik verfügbar.</div>';
        }

        $maxAbs = max(abs($minimumPrice), 0.01);
        foreach ($rows as $row) {
            $maxAbs = max($maxAbs, abs((float)$row['priceCt']));
        }

        $html = '<div style="margin:8px 0 14px 0;padding:8px;border:1px solid rgba(128,128,128,.45);border-radius:6px">';
        $html .= '<div style="font-size:11px;margin-bottom:7px"><b>Fallback-Balkengrafik</b> – Highcharts ist auf diesem System nicht verfügbar.</div>';
        foreach ($rows as $row) {
            $value = (float)$row['priceCt'];
            $width = min(100.0, abs($value) / $maxAbs * 100.0);
            $color = !empty($row['selected']) ? '#38a169' : ($value < 0 ? '#d9534f' : '#4e8fd3');
            $label = htmlspecialchars((string)$row['label']);
            $valueText = number_format($value, 2, ',', '.') . ' ct/kWh';
            $title = 'Einspeisevergütung: ' . $valueText . ' | EPEX Spot AT: ' . number_format((float)$row['marketCt'], 2, ',', '.') . ' ct/kWh';
            if (!empty($row['selected'])) {
                $title .= ' | Einspeisung: ' . number_format((float)$row['powerW'] / 1000, 2, ',', '.') . ' kW, ' . number_format((float)$row['energyKWh'], 2, ',', '.') . ' kWh';
            }
            $title = htmlspecialchars($title, ENT_QUOTES);

            $html .= '<div style="display:flex;align-items:center;margin:3px 0;min-height:18px" title="' . $title . '">';
            $html .= '<div style="width:92px;flex:0 0 92px;font-size:10px;white-space:nowrap">' . $label . '</div>';
            $html .= '<div style="position:relative;display:flex;width:calc(100% - 185px);height:14px;background:rgba(128,128,128,.10)">';
            $html .= '<div style="position:absolute;left:50%;top:0;bottom:0;width:1px;background:#888"></div>';
            if ($value >= 0) {
                $html .= '<div style="width:50%"></div><div style="width:' . number_format($width / 2.0, 3, '.', '') . '%;background:' . $color . ';height:14px"></div>';
            } else {
                $html .= '<div style="width:' . number_format(50.0 - $width / 2.0, 3, '.', '') . '%"></div><div style="width:' . number_format($width / 2.0, 3, '.', '') . '%;background:' . $color . ';height:14px"></div>';
            }
            $html .= '</div>';
            $html .= '<div style="width:88px;flex:0 0 88px;text-align:right;font-size:10px">' . $valueText . '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }


    private function GetHighchartsJavaScript(): string
    {
        $candidates = [
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'highcharts' . DIRECTORY_SEPARATOR . 'highcharts.js',
            rtrim(IPS_GetKernelDir(), '\\/') . DIRECTORY_SEPARATOR . 'highcharts' . DIRECTORY_SEPARATOR . 'highcharts.js'
        ];

        foreach ($candidates as $file) {
            if (!is_file($file)) continue;
            $js = @file_get_contents($file);
            if ($js === false || trim($js) === '') continue;
            // Verhindert, dass der eingebettete JavaScript-Code das HTML-Script-Element vorzeitig beendet.
            return str_replace('</script>', '<\/script>', $js);
        }

        return '';
    }

}
