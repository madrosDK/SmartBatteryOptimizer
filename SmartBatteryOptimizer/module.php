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
        $this->RegisterPropertyInteger('PVCalibrationDays', 30);
        $this->RegisterPropertyInteger('UnknownOrientationLearningDays', 30);
        $this->RegisterPropertyInteger('PVCalibrationMinExpectedW', 300);
        $this->RegisterPropertyFloat('PVCalibrationMinFactor', 0.50);
        $this->RegisterPropertyFloat('PVCalibrationMaxFactor', 1.50);
        $this->RegisterPropertyInteger('PVCalibrationFeedInVariable', 0);
        $this->RegisterPropertyInteger('PVCalibrationFeedInLimitW', 10000);
        $this->RegisterPropertyInteger('PVCalibrationFeedInToleranceW', 500);
        $this->RegisterPropertyBoolean('PVCalibrationFeedInInvert', false);
        $this->RegisterPropertyString('PVSurfaces', json_encode([
            ['Active' => true, 'Name' => 'Süd', 'KWp' => 10.0, 'OrientationKnown' => true, 'Azimuth' => 0, 'Tilt' => 25, 'Factor' => 1.0, 'AutoCalibrate' => true, 'PVVariable1' => 0, 'PVVariable2' => 0, 'PVVariable3' => 0]
        ]));

        $this->RegisterPropertyInteger('SOCVariable', 0);
        $this->RegisterPropertyFloat('BatteryCapacityKWh', 10.0);
        $this->RegisterPropertyFloat('MinimumSOC', 15.0);
        $this->RegisterPropertyInteger('MaxDischargePowerW', 5000);
        $this->RegisterPropertyInteger('DischargePowerVariable', 0);
        $this->RegisterPropertyBoolean('InvertPowerSetpoint', false);
        $this->RegisterPropertyInteger('BatteryControlMode', 0);
        $this->RegisterPropertyInteger('AlphaDispatchStartVariable', 0);
        $this->RegisterPropertyInteger('AlphaDispatchPowerVariable', 0);
        $this->RegisterPropertyInteger('AlphaDispatchModeVariable', 0);
        $this->RegisterPropertyInteger('AlphaDispatchSOCVariable', 0);
        $this->RegisterPropertyInteger('AlphaDispatchTimeVariable', 0);

        $this->RegisterPropertyInteger('HousePowerVariable', 0);
        $this->RegisterPropertyInteger('PVActualPowerVariable', 0);
        $this->RegisterPropertyInteger('LearningDays', 30);
        $this->RegisterPropertyFloat('FallbackNightConsumptionKWh', 4.0);
        $this->RegisterPropertyBoolean('ConsumptionProfileLearningEnabled', true);
        $this->RegisterPropertyFloat('FallbackDailyConsumptionKWh', 12.0);
        $this->RegisterPropertyFloat('ConsumptionForecastSafetyPct', 10.0);
        $this->RegisterPropertyFloat('BatteryTargetSOC', 100.0);
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
        $this->RegisterPropertyBoolean('PreventPVCurtailment', true);
        $this->RegisterPropertyFloat('PVHeadroomTargetSOC', 95.0);
        $this->RegisterPropertyFloat('PVStorageSharePct', 70.0);
        $this->RegisterPropertyFloat('PVSpaceMinimumPriceCt', -100.0);

        $this->RegisterPropertyInteger('RefreshMinutes', 30);

        $this->RegisterVariableFloat('PVForecastToday', 'PV Prognose heute', '~Electricity', 9);
        $this->RegisterVariableFloat('PVForecastTomorrow', 'PV Prognose morgen', '~Electricity', 10);
        $this->RegisterVariableString('PVCalibrationStatus', 'PV Kalibrierung', '', 11);
        $this->RegisterVariableString('AutomaticReleaseStatus', 'Automatikfreigabe', '', 12);
        $this->RegisterVariableFloat('NightConsumptionForecast', 'Prognose Nachtverbrauch', '~Electricity', 20);
        $this->RegisterVariableString('NightConsumptionSource', 'Quelle Nachtverbrauch', '', 21);
        $this->RegisterVariableInteger('ValidNightSamples', 'Gültige Nächte', '', 22);
        $this->RegisterVariableFloat('ConsumptionForecastTomorrow', 'Verbrauchsprognose morgen', '~Electricity', 23);
        $this->RegisterVariableFloat('ExpectedPVSurplusTomorrow', 'PV-Überschuss morgen nach Eigenverbrauch', '~Electricity', 24);
        $this->RegisterVariableString('ConsumptionLearningStatus', 'Verbrauchsprofil Lernen', '', 25);
        $this->RegisterVariableFloat('AvailableFeedInEnergy', 'Für Einspeisung verfügbar', '~Electricity', 30);
        $this->RegisterVariableFloat('PVSpaceRequiredEnergy', 'Für PV freizugebender Speicher', '~Electricity', 31);
        $this->RegisterVariableFloat('CurrentPrice', 'Aktueller Einspeisepreis', '', 40);
        $this->RegisterVariableFloat('HighestPrice', 'Höchster geplanter Einspeisepreis', '', 50);
        $this->RegisterVariableBoolean('AutomaticEnabled', 'Einspeiseautomatik', '~Switch', 55);
        $this->EnableAction('AutomaticEnabled');
        $this->RegisterVariableBoolean('FeedInActive', 'Einspeisung aktiv', '~Switch', 60);
        $this->RegisterVariableFloat('PlannedPower', 'Geplante Einspeiseleistung', '~Watt', 70);
        $this->RegisterVariableString('NextFeedInWindow', 'Nächstes Einspeisefenster', '', 80);
        $this->RegisterVariableFloat('ExpectedRevenue', 'Erwarteter Erlös', '', 90);
        $this->RegisterVariableString('LastUpdate', 'Letzte Aktualisierung', '', 100);
        $this->RegisterVariableString('StatusText', 'Optimierungsstatus', '', 110);
        $this->RegisterVariableString('OverviewHTML', 'Übersicht', '~HTMLBox', 120);
        $this->RegisterVariableString('PVForecastChartHTML', 'PV-Prognose Diagramm', '~HTMLBox', 121);
        $this->RegisterVariableString('PVCalibrationDiagnosisHTML', 'PV-Kalibrierung Diagnose', '~HTMLBox', 122);
        $this->RegisterVariableString('PriceChartHTML', 'Börsenpreis Diagramm', '~HTMLBox', 123);
        $this->RegisterVariableString('PlanHTML', 'Einspeiseplan', '~HTMLBox', 123);

        $this->RegisterAttributeString('ForecastJSON', '{}');
        $this->RegisterAttributeString('PVCalibrationJSON', '{}');
        $this->RegisterAttributeString('PricesJSON', '[]');
        $this->RegisterAttributeString('PlanJSON', '[]');
        $this->RegisterAttributeFloat('LearnedNightKWh', 0.0);
        $this->RegisterAttributeString('NightLearningSource', 'Fallback');
        $this->RegisterAttributeInteger('NightSampleCount', 0);
        $this->RegisterAttributeString('ConsumptionProfileJSON', '{}');
        $this->RegisterAttributeInteger('ConsumptionProfileUpdated', 0);
        $this->RegisterAttributeString('ConsumptionLearningSource', 'Fallback');
        $this->RegisterAttributeBoolean('AlphaDispatchActive', false);
        $this->RegisterAttributeString('AlphaDispatchCommandKey', '');

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
            $this->SetStatus(($this->IsAutomaticEnabled() && !$gate['ready']) ? 202 : 102);
            SetValue($this->GetIDForIdent('AutomaticReleaseStatus'), $gate['text']);
        }

        if (!$this->IsAutomaticEnabled()) {
            $this->StopFeedIn();
        }
    }

    public function RequestAction($Ident, $Value)
    {
        switch ($Ident) {
            case 'AutomaticEnabled':
                $enabled = (bool)$Value;
                SetValue($this->GetIDForIdent('AutomaticEnabled'), $enabled);
                if ($enabled) {
                    SetValue($this->GetIDForIdent('StatusText'), 'Einspeiseautomatik aktiviert – Prognosen und Plan werden aktualisiert.');
                    $this->Recalculate();
                } else {
                    $this->StopFeedIn();
                    SetValue($this->GetIDForIdent('StatusText'), 'Einspeiseautomatik deaktiviert – Prognosen und Lernfunktionen bleiben aktiv.');
                    $gate = $this->GetAutomaticLearningGateStatus();
                    $this->SetStatus(102);
                    SetValue($this->GetIDForIdent('AutomaticReleaseStatus'), $gate['text']);
                }
                break;
            default:
                throw new Exception('Ungültige Aktion: ' . $Ident);
        }
    }

    private function IsAutomaticEnabled(): bool
    {
        $id = @$this->GetIDForIdent('AutomaticEnabled');
        return $id > 0 ? (bool)GetValue($id) : false;
    }

    public function Recalculate()
    {
        try {
            $night = $this->LearnNightConsumptionInternal();
            $consumptionProfile = $this->LearnConsumptionProfileInternal(false);
            $forecast = $this->FetchPVForecast();
            $forecast = $this->ApplyConsumptionForecastToPV($forecast, $consumptionProfile);
            SetValue($this->GetIDForIdent('PVCalibrationStatus'), $this->BuildPVCalibrationStatus($forecast));
            $gate = $this->GetAutomaticLearningGateStatus();
            SetValue($this->GetIDForIdent('AutomaticReleaseStatus'), $gate['text']);
            $prices = $this->FetchPrices();
            $plan = $this->BuildPlan($forecast, $prices, $night, $consumptionProfile);

            $this->WriteAttributeString('ForecastJSON', json_encode($forecast));
            $this->WriteAttributeString('PricesJSON', json_encode($prices));
            $this->WriteAttributeString('PlanJSON', json_encode($plan));

            SetValue($this->GetIDForIdent('PVForecastToday'), round((float)($forecast['todayKWh'] ?? 0.0), 3));
            SetValue($this->GetIDForIdent('PVForecastTomorrow'), round($forecast['tomorrowKWh'], 3));
            SetValue($this->GetIDForIdent('NightConsumptionForecast'), round($night, 3));
            SetValue($this->GetIDForIdent('NightConsumptionSource'), $this->ReadAttributeString('NightLearningSource'));
            SetValue($this->GetIDForIdent('ValidNightSamples'), $this->ReadAttributeInteger('NightSampleCount'));
            SetValue($this->GetIDForIdent('ConsumptionForecastTomorrow'), round((float)$forecast['consumptionTomorrowKWh'], 3));
            SetValue($this->GetIDForIdent('ExpectedPVSurplusTomorrow'), round((float)$forecast['pvSurplusTomorrowKWh'], 3));
            SetValue($this->GetIDForIdent('ConsumptionLearningStatus'), $this->ReadAttributeString('ConsumptionLearningSource'));
            SetValue($this->GetIDForIdent('AvailableFeedInEnergy'), round($plan['availableKWh'], 3));
            SetValue($this->GetIDForIdent('PVSpaceRequiredEnergy'), round($plan['pvSpaceRequiredKWh'], 3));
            SetValue($this->GetIDForIdent('HighestPrice'), round($plan['highestPriceCt'], 3));
            SetValue($this->GetIDForIdent('ExpectedRevenue'), round($plan['expectedRevenueEUR'], 3));
            SetValue($this->GetIDForIdent('NextFeedInWindow'), $plan['nextWindow']);
            SetValue($this->GetIDForIdent('StatusText'), $plan['status']);
            SetValue($this->GetIDForIdent('LastUpdate'), date('d.m.Y H:i:s'));
            SetValue($this->GetIDForIdent('OverviewHTML'), $this->RenderOverviewHTML($forecast, $plan, $night));
            SetValue($this->GetIDForIdent('PVForecastChartHTML'), $this->RenderPVForecastChartHTML($forecast));
            SetValue($this->GetIDForIdent('PVCalibrationDiagnosisHTML'), $this->RenderPVCalibrationDiagnosisHTML($forecast));
            SetValue($this->GetIDForIdent('PriceChartHTML'), $this->RenderPriceChartHTML($forecast, $prices, $plan));
            SetValue($this->GetIDForIdent('PlanHTML'), $this->RenderPlanHTML($forecast, $prices, $plan));
            $this->SetStatus(($this->IsAutomaticEnabled() && !$gate['ready']) ? 202 : 102);
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

    public function LearnConsumptionProfile()
    {
        try {
            $profile = $this->LearnConsumptionProfileInternal(true);
            $forecast = $this->ApplyConsumptionForecastToPV($this->FetchPVForecast(), $profile);
            SetValue($this->GetIDForIdent('ConsumptionForecastTomorrow'), round((float)$forecast['consumptionTomorrowKWh'], 3));
            SetValue($this->GetIDForIdent('ExpectedPVSurplusTomorrow'), round((float)$forecast['pvSurplusTomorrowKWh'], 3));
            SetValue($this->GetIDForIdent('ConsumptionLearningStatus'), $this->ReadAttributeString('ConsumptionLearningSource'));
            SetValue($this->GetIDForIdent('StatusText'), 'Verbrauchsprofil neu gelernt: ' . number_format((float)$forecast['consumptionTomorrowKWh'], 2, ',', '.') . ' kWh für morgen');
        } catch (Throwable $e) {
            SetValue($this->GetIDForIdent('StatusText'), 'Verbrauchsprofil lernen fehlgeschlagen: ' . $e->getMessage());
        }
    }

    public function ResetPVCalibration()
    {
        try {
            $this->WriteAttributeString('PVCalibrationJSON', '{}');
            SetValue($this->GetIDForIdent('PVCalibrationStatus'), 'PV-Kalibrierung zurückgesetzt – Auto-Faktoren starten wieder bei 1,000.');
            SetValue($this->GetIDForIdent('StatusText'), 'PV-Kalibrierung zurückgesetzt. Neue Messwerte werden ab der nächsten Berechnung über den eingestellten Lernzeitraum neu angelernt.');

            $gate = $this->GetAutomaticLearningGateStatus();
            SetValue($this->GetIDForIdent('AutomaticReleaseStatus'), $gate['text']);
            $this->SetStatus(($this->IsAutomaticEnabled() && !$gate['ready']) ? 202 : 102);
        } catch (Throwable $e) {
            SetValue($this->GetIDForIdent('StatusText'), 'PV-Kalibrierung zurücksetzen fehlgeschlagen: ' . $e->getMessage());
        }
    }

    public function Control()
    {
        if (!$this->IsAutomaticEnabled()) {
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

        $this->SetFeedIn(true, (float)$active['powerW'], (int)$active['end']);
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
        $calibrationFeedInGate = $this->GetPVCalibrationFeedInGate();
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
            if ($autoEnabled && $actualW !== null && $currentExpectedBaseW >= $this->ReadPropertyInteger('PVCalibrationMinExpectedW') && !$calibrationFeedInGate['blocked']) {
                $calibration = $this->AddPVCalibrationSample($calibration, $key, $currentExpectedBaseW, $actualW);
                $autoFactor = isset($calibration[$key]['factor']) ? (float)$calibration[$key]['factor'] : $autoFactor;
            }

            $surfaceTotals[$name] = $sum;
            $diag = $this->GetPVCalibrationDiagnostics($calibration, $key);
            $surfaceCalibration[$name] = [
                'key' => $key,
                'manualFactor' => $manualFactor,
                'orientationKnown' => $orientationKnown,
                'autoEnabled' => $autoEnabled,
                'autoFactor' => $autoFactor,
                'effectiveFactor' => $manualFactor * ($autoEnabled ? $autoFactor : 1.0),
                'expectedBaseW' => $currentExpectedBaseW,
                'expectedCorrectedW' => $currentExpectedBaseW * ($autoEnabled ? $autoFactor : 1.0),
                'actualW' => $actualW,
                'currentRatio' => ($actualW !== null && $currentExpectedBaseW > 0.0) ? ($actualW / $currentExpectedBaseW) : null,
                'sampleCount' => $diag['sampleCount'],
                'sumExpectedW' => $diag['sumExpectedW'],
                'sumActualW' => $diag['sumActualW'],
                'learnedRatio' => $diag['ratio'],
                'firstSampleTs' => $diag['firstSampleTs'],
                'lastSampleTs' => $diag['lastSampleTs'],
                'calibrationBlocked' => (bool)$calibrationFeedInGate['blocked'],
                'calibrationBlockReason' => (string)$calibrationFeedInGate['text']
            ];
        }

        $this->WriteAttributeString('PVCalibrationJSON', json_encode($calibration));
        ksort($hours);
        $today = 0.0;
        $tomorrow = 0.0;
        $todayDate = date('Y-m-d');
        $tomorrowDate = date('Y-m-d', strtotime('tomorrow'));
        foreach ($hours as $ts => $h) {
            $day = date('Y-m-d', (int)$ts);
            if ($day === $todayDate) {
                $today += $h['totalKW'];
            }
            if ($day === $tomorrowDate) {
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
            'todayKWh' => $today,
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

    private function GetPVCalibrationFeedInGate(): array
    {
        $variableID = $this->ReadPropertyInteger('PVCalibrationFeedInVariable');
        if ($variableID <= 0 || !@IPS_VariableExists($variableID)) {
            return ['blocked' => false, 'configured' => false, 'feedInW' => null, 'thresholdW' => null, 'text' => ''];
        }

        try {
            $feedInW = (float)GetValue($variableID);
            if ($this->ReadPropertyBoolean('PVCalibrationFeedInInvert')) {
                $feedInW *= -1.0;
            }
        } catch (Throwable $e) {
            $this->SendDebug('PVCalibration', 'Netzeinspeisung konnte nicht gelesen werden: ' . $e->getMessage(), 0);
            return ['blocked' => false, 'configured' => true, 'feedInW' => null, 'thresholdW' => null, 'text' => 'Netzeinspeisung nicht lesbar'];
        }

        $limitW = max(0.0, (float)$this->ReadPropertyInteger('PVCalibrationFeedInLimitW'));
        $toleranceW = max(0.0, (float)$this->ReadPropertyInteger('PVCalibrationFeedInToleranceW'));
        $thresholdW = max(0.0, $limitW - $toleranceW);
        $blocked = $limitW > 0.0 && $feedInW >= $thresholdW;
        $text = $blocked
            ? 'Lernen pausiert – Einspeisebegrenzung aktiv (' . number_format($feedInW, 0, ',', '.') . ' W / Grenze ' . number_format($limitW, 0, ',', '.') . ' W, Sperre ab ' . number_format($thresholdW, 0, ',', '.') . ' W)'
            : '';

        return ['blocked' => $blocked, 'configured' => true, 'feedInW' => $feedInW, 'thresholdW' => $thresholdW, 'text' => $text];
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

        // Messwerte werden für die ggf. längere Lernphase bei unbekannter Ausrichtung aufbewahrt.
        // Für den eigentlichen Auto-Faktor zählen aber ausschließlich Werte innerhalb von PVCalibrationDays.
        $retentionDays = max(1, $this->ReadPropertyInteger('PVCalibrationDays'), $this->ReadPropertyInteger('UnknownOrientationLearningDays'));
        $retentionCutoff = $now - $retentionDays * 86400;
        $samples = [];
        foreach ($calibration[$key]['samples'] as $sample) {
            if ((int)($sample['ts'] ?? 0) < $retentionCutoff) continue;
            $exp = (float)($sample['expectedW'] ?? 0);
            $act = (float)($sample['actualW'] ?? 0);
            if ($exp < $this->ReadPropertyInteger('PVCalibrationMinExpectedW')) continue;
            if ($act < 0) continue;
            $samples[] = ['ts' => (int)$sample['ts'], 'expectedW' => $exp, 'actualW' => $act];
        }
        $calibration[$key]['samples'] = $samples;

        $factorDays = max(1, $this->ReadPropertyInteger('PVCalibrationDays'));
        $factorCutoff = $now - $factorDays * 86400;
        $factorSamples = array_values(array_filter($samples, static function (array $sample) use ($factorCutoff): bool {
            return (int)$sample['ts'] >= $factorCutoff;
        }));

        if (count($factorSamples) > 0) {
            $sumExpected = array_sum(array_column($factorSamples, 'expectedW'));
            $sumActual = array_sum(array_column($factorSamples, 'actualW'));
            if ($sumExpected > 0) {
                $factor = $sumActual / $sumExpected;
                $factor = max($this->ReadPropertyFloat('PVCalibrationMinFactor'), min($this->ReadPropertyFloat('PVCalibrationMaxFactor'), $factor));
                $calibration[$key]['factor'] = $factor;
            }
        } else {
            $calibration[$key]['factor'] = 1.0;
        }
        $calibration[$key]['factorSampleCount'] = count($factorSamples);
        $calibration[$key]['lastExpectedW'] = $expectedW;
        $calibration[$key]['lastActualW'] = $actualW;
        $calibration[$key]['updated'] = $now;
        return $calibration;
    }

    private function GetPVCalibrationDiagnostics(array $calibration, string $key): array
    {
        $samples = isset($calibration[$key]['samples']) && is_array($calibration[$key]['samples']) ? $calibration[$key]['samples'] : [];
        $factorDays = max(1, $this->ReadPropertyInteger('PVCalibrationDays'));
        $cutoff = time() - $factorDays * 86400;
        $sumExpected = 0.0;
        $sumActual = 0.0;
        $count = 0;
        $firstTs = 0;
        $lastTs = 0;
        foreach ($samples as $sample) {
            $ts = (int)($sample['ts'] ?? 0);
            $exp = (float)($sample['expectedW'] ?? 0.0);
            $act = (float)($sample['actualW'] ?? 0.0);
            if ($ts < $cutoff || $exp < $this->ReadPropertyInteger('PVCalibrationMinExpectedW') || $act < 0.0) continue;
            $sumExpected += $exp;
            $sumActual += $act;
            $count++;
            if ($firstTs === 0 || $ts < $firstTs) $firstTs = $ts;
            if ($ts > $lastTs) $lastTs = $ts;
        }
        return [
            'sampleCount' => $count,
            'sumExpectedW' => $sumExpected,
            'sumActualW' => $sumActual,
            'ratio' => $sumExpected > 0.0 ? $sumActual / $sumExpected : null,
            'firstSampleTs' => $firstTs,
            'lastSampleTs' => $lastTs
        ];
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
            if (!empty($c['calibrationBlocked'])) {
                $parts[] = $name . ': ' . (string)$c['calibrationBlockReason'] . ' | Auto ' . number_format((float)$c['autoFactor'], 3, ',', '.') . ' (' . (int)$c['sampleCount'] . ' Werte)';
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

        // Kostenlose smartENERGY-API: echte EPEX SPOT AT Day-Ahead-Preise
        // im 15-Minuten-Raster. Laut API-Dokumentation sind die Werte in ct/kWh
        // inklusive 20 % USt. und ohne Grund-/Abwicklungsgebühr angegeben.
        $url = 'https://apis.smartenergy.at/market/v1/price';
        $data = $this->HttpGetJson($url);
        if (!isset($data['data']) || !is_array($data['data'])) {
            throw new Exception('Ungültige smartENERGY EPEX-SPOT-AT-Antwort.');
        }

        $intervalMinutes = max(1, (int)($data['interval'] ?? 15));
        $prices = [];
        foreach ($data['data'] as $row) {
            if (!isset($row['date'], $row['value'])) continue;
            $start = strtotime((string)$row['date']);
            if ($start === false) continue;
            $rawCt = (float)$row['value'];
            $prices[] = [
                'start' => $start,
                'end' => $start + ($intervalMinutes * 60),
                'marketCt' => $rawCt,
                'priceCt' => $this->CalculateFeedInTariff($rawCt)
            ];
        }
        if (count($prices) === 0) throw new Exception('smartENERGY liefert keine EPEX-SPOT-AT-Preisdaten.');
        usort($prices, fn($a, $b) => $a['start'] <=> $b['start']);
        return $this->ExpandPricesToQuarterHour($prices);
    }

    private function ExpandPricesToQuarterHour(array $prices): array
    {
        $result = [];
        foreach ($prices as $p) {
            $start = (int)($p['start'] ?? 0);
            $end = (int)($p['end'] ?? 0);
            if ($start <= 0 || $end <= $start) continue;
            for ($slotStart = $start; $slotStart < $end; $slotStart += 900) {
                $slotEnd = min($end, $slotStart + 900);
                $result[] = [
                    'start' => $slotStart,
                    'end' => $slotEnd,
                    'marketCt' => (float)$p['marketCt'],
                    'priceCt' => (float)$p['priceCt']
                ];
            }
        }
        usort($result, fn($a, $b) => $a['start'] <=> $b['start']);
        return $result;
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
        return $this->ExpandPricesToQuarterHour($prices);
    }

    private function BuildPlan(array $forecast, array $prices, float $nightKWh, array $consumptionProfile): array
    {
        $socVar = $this->ReadPropertyInteger('SOCVariable');
        if ($socVar <= 0) throw new Exception('SoC-Variable fehlt.');
        $soc = max(0.0, min(100.0, (float)GetValue($socVar)));
        $capacity = max(0.1, $this->ReadPropertyFloat('BatteryCapacityKWh'));
        $stored = $capacity * $soc / 100.0;
        $minEnergy = $capacity * $this->ReadPropertyFloat('MinimumSOC') / 100.0;
        $nightReserve = $nightKWh * (1.0 + $this->ReadPropertyFloat('SafetyReservePct') / 100.0);

        $tomorrowPV = (float)$forecast['tomorrowKWh'];
        $tomorrowConsumption = (float)($forecast['consumptionTomorrowKWh'] ?? 0.0);
        $pvOverlapConsumption = (float)($forecast['consumptionDuringPVTomorrowKWh'] ?? 0.0);
        $pvSurplusTomorrow = max(0.0, (float)($forecast['pvSurplusTomorrowKWh'] ?? ($tomorrowPV - $pvOverlapConsumption)));

        // Ziel: Der Speicher soll trotz geplanter Einspeisung am nächsten PV-Tag
        // wieder bis zum konfigurierten Ziel-SoC geladen werden können. Dafür wird
        // zuerst der gelernte Eigenverbrauch während der PV-Stunden abgezogen.
        $targetSOC = max($this->ReadPropertyFloat('MinimumSOC'), min(100.0, $this->ReadPropertyFloat('BatteryTargetSOC')));
        $targetEnergy = $capacity * $targetSOC / 100.0;
        $requiredMorningStored = max($minEnergy, $targetEnergy - $pvSurplusTomorrow);
        $reserve = $nightReserve + $requiredMorningStored;

        if ($tomorrowPV < $this->ReadPropertyFloat('MinimumTomorrowPVKWh')) {
            $reserve = $requiredMorningStored + ($nightReserve * (1.0 + $this->ReadPropertyFloat('PoorForecastExtraReservePct') / 100.0));
        }

        $status = 'Optimierung aktiv';
        if ($this->ReadPropertyBoolean('DisableFeedInOnVeryPoorForecast') && $tomorrowPV < $this->ReadPropertyFloat('VeryPoorForecastKWh')) {
            $available = 0.0;
            $status = 'Einspeisung gesperrt: PV-Prognose sehr schlecht';
        } else {
            $available = max(0.0, $stored - $reserve);
        }

        // Speicherplatz für den erwarteten PV-Überschuss freihalten. Der lernende
        // Verbrauch wird vorab von der PV-Prognose abgezogen.
        $pvSpaceRequired = 0.0;
        $pvTargetSOC = max($this->ReadPropertyFloat('MinimumSOC'), min(100.0, $this->ReadPropertyFloat('PVHeadroomTargetSOC')));
        $expectedMorningStored = max($minEnergy, $stored - max(0.0, $nightReserve));
        $targetMaxEnergy = $capacity * $pvTargetSOC / 100.0;
        $expectedPVToBattery = $pvSurplusTomorrow * max(0.0, min(100.0, $this->ReadPropertyFloat('PVStorageSharePct'))) / 100.0;
        $morningHeadroom = max(0.0, $targetMaxEnergy - $expectedMorningStored);
        if ($this->ReadPropertyBoolean('PreventPVCurtailment') && $available > 0.0) {
            $pvSpaceRequired = min($available, max(0.0, $expectedPVToBattery - $morningHeadroom));
        }

        $horizonEnd = max(time() + 3600, (int)$forecast['morningTs']);
        $allSlots = [];
        foreach ($prices as $p) {
            if ($p['end'] <= time() || $p['start'] >= $horizonEnd) continue;
            $allSlots[] = $p;
        }

        $economic = array_values(array_filter($allSlots, fn($p) => $p['priceCt'] >= $this->ReadPropertyFloat('MinimumFeedInPriceCt')));
        usort($economic, fn($a, $b) => $b['priceCt'] <=> $a['priceCt']);

        $remaining = $available;
        $maxKW = max(0.0, $this->ReadPropertyInteger('MaxDischargePowerW') / 1000.0);
        $selected = [];
        $revenue = 0.0;
        $scheduledEnergy = 0.0;
        $usedKeys = [];

        foreach ($economic as $p) {
            if ($remaining <= 0.001 || $maxKW <= 0) break;
            $slotStart = max($p['start'], time());
            $durationH = max(0.0, ($p['end'] - $slotStart) / 3600.0);
            if ($durationH <= 0) continue;
            $energy = min($remaining, $maxKW * $durationH);
            $powerKW = min($maxKW, $energy / $durationH);
            $key = $p['start'] . ':' . $p['end'];
            $selected[] = [
                'start' => $slotStart,
                'end' => $p['end'],
                'priceCt' => $p['priceCt'],
                'marketCt' => $p['marketCt'],
                'energyKWh' => $energy,
                'powerW' => $powerKW * 1000.0,
                'reason' => 'price'
            ];
            $usedKeys[$key] = true;
            $revenue += $energy * $p['priceCt'] / 100.0;
            $remaining -= $energy;
            $scheduledEnergy += $energy;
        }

        // Falls die normalen Preisfenster nicht genug Speicherplatz freimachen, werden
        // zusätzlich die bestbezahlten noch freien Intervalle gewählt. Der separate
        // Mindestpreis kann auf einen sehr niedrigen Wert gestellt werden, wenn die
        // Vermeidung von PV-Abregelung Vorrang vor dem momentanen Verkaufspreis hat.
        $mandatoryMissing = max(0.0, $pvSpaceRequired - $scheduledEnergy);
        if ($mandatoryMissing > 0.001 && $remaining > 0.001 && $maxKW > 0) {
            $pvFloor = $this->ReadPropertyFloat('PVSpaceMinimumPriceCt');
            $fallbackSlots = array_values(array_filter($allSlots, function ($p) use ($usedKeys, $pvFloor) {
                $key = $p['start'] . ':' . $p['end'];
                return !isset($usedKeys[$key]) && $p['priceCt'] >= $pvFloor;
            }));
            usort($fallbackSlots, fn($a, $b) => $b['priceCt'] <=> $a['priceCt']);

            foreach ($fallbackSlots as $p) {
                if ($mandatoryMissing <= 0.001 || $remaining <= 0.001) break;
                $slotStart = max($p['start'], time());
                $durationH = max(0.0, ($p['end'] - $slotStart) / 3600.0);
                if ($durationH <= 0) continue;
                $energy = min($remaining, $mandatoryMissing, $maxKW * $durationH);
                $powerKW = min($maxKW, $energy / $durationH);
                $selected[] = [
                    'start' => $slotStart,
                    'end' => $p['end'],
                    'priceCt' => $p['priceCt'],
                    'marketCt' => $p['marketCt'],
                    'energyKWh' => $energy,
                    'powerW' => $powerKW * 1000.0,
                    'reason' => 'pv_space'
                ];
                $revenue += $energy * $p['priceCt'] / 100.0;
                $remaining -= $energy;
                $scheduledEnergy += $energy;
                $mandatoryMissing -= $energy;
            }
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

        if ($pvSpaceRequired > 0.05) {
            $status .= ' | PV-Speicherfreihaltung ' . number_format($pvSpaceRequired, 2, ',', '.') . ' kWh';
            if ($mandatoryMissing > 0.05) {
                $status .= ' (noch ' . number_format($mandatoryMissing, 2, ',', '.') . ' kWh ungeplant)';
            }
        }

        return [
            'soc' => $soc,
            'storedKWh' => $stored,
            'reserveKWh' => $reserve,
            'minimumEnergyKWh' => $minEnergy,
            'availableKWh' => $available,
            'pvSpaceRequiredKWh' => $pvSpaceRequired,
            'pvSpaceUnscheduledKWh' => max(0.0, $mandatoryMissing),
            'expectedMorningStoredKWh' => $expectedMorningStored,
            'expectedPVToBatteryKWh' => $expectedPVToBattery,
            'targetSOCPct' => $targetSOC,
            'targetEnergyKWh' => $targetEnergy,
            'requiredMorningStoredKWh' => $requiredMorningStored,
            'tomorrowConsumptionKWh' => $tomorrowConsumption,
            'pvOverlapConsumptionKWh' => $pvOverlapConsumption,
            'pvSurplusTomorrowKWh' => $pvSurplusTomorrow,
            'remainingUnscheduledKWh' => $remaining,
            'highestPriceCt' => $highest,
            'expectedRevenueEUR' => $revenue,
            'nextWindow' => $next,
            'status' => $status,
            'slots' => $selected
        ];
    }

    private function LearnConsumptionProfileInternal(bool $force = false): array
    {
        $fallbackDaily = max(0.0, $this->ReadPropertyFloat('FallbackDailyConsumptionKWh'));
        if (!$this->ReadPropertyBoolean('ConsumptionProfileLearningEnabled')) {
            return $this->BuildFallbackConsumptionProfile($fallbackDaily, 'Fallback – Verbrauchsprofil-Lernen deaktiviert');
        }

        $cached = json_decode($this->ReadAttributeString('ConsumptionProfileJSON'), true);
        $updated = $this->ReadAttributeInteger('ConsumptionProfileUpdated');
        if (!$force && is_array($cached) && isset($cached['hourlyKWh']) && is_array($cached['hourlyKWh']) && count($cached['hourlyKWh']) === 24 && $updated > time() - 6 * 3600) {
            $this->WriteAttributeString('ConsumptionLearningSource', (string)($cached['source'] ?? 'Archiv gelernt'));
            return $cached;
        }

        $varID = $this->ReadPropertyInteger('HousePowerVariable');
        if ($varID <= 0 || !@IPS_VariableExists($varID)) {
            return $this->BuildFallbackConsumptionProfile($fallbackDaily, 'Fallback – Hausverbrauchsvariable fehlt');
        }

        $archiveID = $this->FindArchive();
        if ($archiveID <= 0) {
            return $this->BuildFallbackConsumptionProfile($fallbackDaily, 'Fallback – Archiv nicht gefunden');
        }

        if (function_exists('AC_GetLoggingStatus')) {
            try {
                if (!AC_GetLoggingStatus($archiveID, $varID)) {
                    return $this->BuildFallbackConsumptionProfile($fallbackDaily, 'Fallback – Hausverbrauch nicht archiviert');
                }
            } catch (Throwable $e) {
                $this->SendDebug('ConsumptionProfile', 'Logging-Status konnte nicht geprüft werden: ' . $e->getMessage(), 0);
            }
        }

        $days = max(3, min(90, $this->ReadPropertyInteger('LearningDays')));
        $targetTomorrow = strtotime('tomorrow 12:00');
        $targetWeekend = in_array((int)date('N', $targetTomorrow), [6, 7], true);
        $sum = array_fill(0, 24, 0.0);
        $weight = array_fill(0, 24, 0.0);
        $validDays = 0;

        for ($age = 1; $age <= $days; $age++) {
            $dayStart = strtotime('-' . $age . ' days 00:00');
            $hourly = $this->GetHourlyConsumptionForDay($archiveID, $varID, $dayStart);
            if ($hourly === null) continue;

            $daily = array_sum($hourly);
            if ($daily <= 0.1 || !is_finite($daily)) continue;

            $baseWeight = $age <= 7 ? 1.0 : ($age <= 14 ? 0.55 : 0.30);
            $isWeekend = in_array((int)date('N', $dayStart), [6, 7], true);
            $dayTypeWeight = ($isWeekend === $targetWeekend) ? 1.25 : 0.85;
            $w = $baseWeight * $dayTypeWeight;

            for ($h = 0; $h < 24; $h++) {
                $v = max(0.0, (float)$hourly[$h]);
                $sum[$h] += $v * $w;
                $weight[$h] += $w;
            }
            $validDays++;
        }

        if ($validDays < 3) {
            if (is_array($cached) && isset($cached['hourlyKWh']) && count($cached['hourlyKWh']) === 24) {
                $source = 'Letztes Verbrauchsprofil – nur ' . $validDays . '/3 gültige Tage';
                $cached['source'] = $source;
                $this->WriteAttributeString('ConsumptionLearningSource', $source);
                return $cached;
            }
            return $this->BuildFallbackConsumptionProfile($fallbackDaily, 'Fallback – nur ' . $validDays . '/3 gültige Verbrauchstage');
        }

        $profile = [];
        for ($h = 0; $h < 24; $h++) {
            $profile[$h] = $weight[$h] > 0 ? $sum[$h] / $weight[$h] : 0.0;
        }

        $safety = 1.0 + max(0.0, $this->ReadPropertyFloat('ConsumptionForecastSafetyPct')) / 100.0;
        $forecastProfile = array_map(fn($v) => max(0.0, (float)$v) * $safety, $profile);
        $source = 'Archiv gelernt – ' . $validDays . ' Tage, Stundenprofil';
        $result = [
            'hourlyKWh' => $forecastProfile,
            'rawHourlyKWh' => $profile,
            'dailyKWh' => array_sum($forecastProfile),
            'validDays' => $validDays,
            'source' => $source,
            'updated' => time()
        ];

        $this->WriteAttributeString('ConsumptionProfileJSON', json_encode($result));
        $this->WriteAttributeInteger('ConsumptionProfileUpdated', time());
        $this->WriteAttributeString('ConsumptionLearningSource', $source);
        $this->SendDebug('ConsumptionProfile', $source . ', Prognose ' . round($result['dailyKWh'], 3) . ' kWh', 0);
        return $result;
    }

    private function BuildFallbackConsumptionProfile(float $dailyKWh, string $source): array
    {
        $hourly = array_fill(0, 24, $dailyKWh / 24.0);
        $result = [
            'hourlyKWh' => $hourly,
            'rawHourlyKWh' => $hourly,
            'dailyKWh' => $dailyKWh,
            'validDays' => 0,
            'source' => $source,
            'updated' => time()
        ];
        $this->WriteAttributeString('ConsumptionLearningSource', $source);
        return $result;
    }

    private function GetHourlyConsumptionForDay(int $archiveID, int $varID, int $dayStart): ?array
    {
        $dayEnd = $dayStart + 86400;
        $values = @AC_GetLoggedValues($archiveID, $varID, $dayStart, $dayEnd, 0);
        if (!is_array($values) || count($values) === 0) return null;
        $values = array_reverse($values);

        $prev = @AC_GetLoggedValues($archiveID, $varID, 0, $dayStart - 1, 1);
        if (is_array($prev) && count($prev) > 0) {
            array_unshift($values, ['TimeStamp' => $dayStart, 'Value' => $prev[0]['Value']]);
        } elseif ((int)$values[0]['TimeStamp'] > $dayStart) {
            array_unshift($values, ['TimeStamp' => $dayStart, 'Value' => $values[0]['Value']]);
        }

        $hourlyWh = array_fill(0, 24, 0.0);
        for ($i = 0; $i < count($values); $i++) {
            $segmentStart = max($dayStart, (int)$values[$i]['TimeStamp']);
            $segmentEnd = ($i + 1 < count($values)) ? min($dayEnd, (int)$values[$i + 1]['TimeStamp']) : $dayEnd;
            if ($segmentEnd <= $segmentStart) continue;
            $powerW = max(0.0, (float)$values[$i]['Value']);

            $cursor = $segmentStart;
            while ($cursor < $segmentEnd) {
                $hour = (int)date('G', $cursor);
                $hourEnd = min($segmentEnd, strtotime(date('Y-m-d H:00:00', $cursor)) + 3600);
                if ($hourEnd <= $cursor) break;
                $hourlyWh[$hour] += $powerW * (($hourEnd - $cursor) / 3600.0);
                $cursor = $hourEnd;
            }
        }

        return array_map(fn($wh) => $wh / 1000.0, $hourlyWh);
    }

    private function GetActualPVTodayHourly(int $todayStart): array
    {
        $result = [
            'hourlyKW' => array_fill(0, 24, null),
            'energyKWh' => 0.0,
            'source' => 'keine Ist-PV-Variable konfiguriert'
        ];

        $archiveID = $this->FindArchive();
        if ($archiveID <= 0) {
            $result['source'] = 'Archiv nicht gefunden';
            return $result;
        }

        $variableIDs = [];
        $totalPV = $this->ReadPropertyInteger('PVActualPowerVariable');
        if ($totalPV > 0 && @IPS_VariableExists($totalPV)) {
            $variableIDs[] = $totalPV;
            $result['source'] = 'PV-Istleistung Gesamtvariable';
        } else {
            $surfaces = json_decode($this->ReadPropertyString('PVSurfaces'), true);
            if (is_array($surfaces)) {
                foreach ($surfaces as $surface) {
                    if (empty($surface['Active'])) continue;
                    for ($i = 1; $i <= 3; $i++) {
                        $id = (int)($surface['PVVariable' . $i] ?? 0);
                        if ($id > 0 && @IPS_VariableExists($id)) $variableIDs[$id] = $id;
                    }
                }
            }
            $variableIDs = array_values($variableIDs);
            if (count($variableIDs) > 0) $result['source'] = 'Summe PV-String/MPPT-Variablen';
        }

        if (count($variableIDs) === 0) return $result;

        $end = min(time(), $todayStart + 86400);
        if ($end <= $todayStart) return $result;

        $hourlyWh = array_fill(0, 24, 0.0);
        $hasData = false;
        foreach ($variableIDs as $varID) {
            if (function_exists('AC_GetLoggingStatus')) {
                try {
                    if (!AC_GetLoggingStatus($archiveID, $varID)) continue;
                } catch (Throwable $e) {
                    $this->SendDebug('PVActualChart', 'Logging-Status konnte nicht geprüft werden: ' . $e->getMessage(), 0);
                }
            }

            $values = @AC_GetLoggedValues($archiveID, $varID, $todayStart, $end, 0);
            if (!is_array($values)) $values = [];
            $values = array_reverse($values);
            $prev = @AC_GetLoggedValues($archiveID, $varID, 0, $todayStart - 1, 1);
            if (is_array($prev) && count($prev) > 0) {
                array_unshift($values, ['TimeStamp' => $todayStart, 'Value' => $prev[0]['Value']]);
            } elseif (count($values) > 0 && (int)$values[0]['TimeStamp'] > $todayStart) {
                array_unshift($values, ['TimeStamp' => $todayStart, 'Value' => $values[0]['Value']]);
            }
            if (count($values) === 0) continue;
            $hasData = true;

            for ($i = 0; $i < count($values); $i++) {
                $segmentStart = max($todayStart, (int)$values[$i]['TimeStamp']);
                $segmentEnd = ($i + 1 < count($values)) ? min($end, (int)$values[$i + 1]['TimeStamp']) : $end;
                if ($segmentEnd <= $segmentStart) continue;
                $powerW = max(0.0, (float)$values[$i]['Value']);

                $cursor = $segmentStart;
                while ($cursor < $segmentEnd) {
                    $hour = (int)date('G', $cursor);
                    $hourStart = strtotime(date('Y-m-d H:00:00', $cursor));
                    $hourEnd = min($segmentEnd, $hourStart + 3600);
                    if ($hourEnd <= $cursor) break;
                    $hourlyWh[$hour] += $powerW * (($hourEnd - $cursor) / 3600.0);
                    $cursor = $hourEnd;
                }
            }
        }

        if (!$hasData) {
            $result['source'] .= ' – keine Archivdaten';
            return $result;
        }

        $currentHour = (int)date('G', $end);
        for ($h = 0; $h < 24; $h++) {
            $hourStart = $todayStart + $h * 3600;
            if ($hourStart >= $end) {
                $result['hourlyKW'][$h] = null;
                continue;
            }
            $elapsedSeconds = min(3600, max(1, $end - $hourStart));
            $avgW = $hourlyWh[$h] / ($elapsedSeconds / 3600.0);
            $result['hourlyKW'][$h] = round($avgW / 1000.0, 3);
        }
        $result['energyKWh'] = array_sum($hourlyWh) / 1000.0;
        return $result;
    }

    private function ApplyConsumptionForecastToPV(array $forecast, array $profile): array
    {
        $hourly = isset($profile['hourlyKWh']) && is_array($profile['hourlyKWh']) ? $profile['hourlyKWh'] : array_fill(0, 24, 0.0);
        $tomorrowStart = strtotime('tomorrow 00:00');
        $totalConsumption = 0.0;
        $consumptionDuringPV = 0.0;
        $netPVSurplus = 0.0;
        $thresholdKW = max(0.0, $this->ReadPropertyInteger('MorningPVThresholdW') / 1000.0);

        for ($h = 0; $h < 24; $h++) {
            $loadKWh = max(0.0, (float)($hourly[$h] ?? 0.0));
            $totalConsumption += $loadKWh;
            $ts = $tomorrowStart + $h * 3600;
            $pvKWh = isset($forecast['hours'][$ts]) ? max(0.0, (float)$forecast['hours'][$ts]['totalKW']) : 0.0;

            if ($pvKWh >= $thresholdKW) {
                $consumptionDuringPV += $loadKWh;
                $netPVSurplus += max(0.0, $pvKWh - $loadKWh);
            }
        }

        $forecast['consumptionTomorrowKWh'] = $totalConsumption;
        $forecast['consumptionDuringPVTomorrowKWh'] = $consumptionDuringPV;
        $forecast['pvSurplusTomorrowKWh'] = $netPVSurplus;
        $forecast['consumptionProfile'] = $profile;
        return $forecast;
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

    private function SetFeedIn(bool $enable, float $powerW, int $slotEnd = 0)
    {
        if ($this->ReadPropertyInteger('BatteryControlMode') === 1) {
            $this->SetAlphaESSDispatch($enable, $powerW, $slotEnd);
        } else {
            $powerID = $this->ReadPropertyInteger('DischargePowerVariable');
            if ($powerID > 0) {
                $setpoint = $this->ReadPropertyBoolean('InvertPowerSetpoint') ? -abs($powerW) : abs($powerW);
                if (!$enable) $setpoint = 0;
                $this->WriteVariableSmart($powerID, $setpoint);
            }
        }
        SetValue($this->GetIDForIdent('FeedInActive'), $enable);
        SetValue($this->GetIDForIdent('PlannedPower'), $enable ? abs($powerW) : 0.0);
    }

    private function SetAlphaESSDispatch(bool $enable, float $powerW, int $slotEnd): void
    {
        $startID = $this->ReadPropertyInteger('AlphaDispatchStartVariable');
        $powerID = $this->ReadPropertyInteger('AlphaDispatchPowerVariable');
        $modeID = $this->ReadPropertyInteger('AlphaDispatchModeVariable');
        $socID = $this->ReadPropertyInteger('AlphaDispatchSOCVariable');
        $timeID = $this->ReadPropertyInteger('AlphaDispatchTimeVariable');

        if ($startID <= 0) {
            throw new Exception('AlphaESS: Dispatch-Start-Variable (Register 2176) fehlt.');
        }

        if (!$enable) {
            if ($this->ReadAttributeBoolean('AlphaDispatchActive')) {
                $this->WriteVariableSmart($startID, 0);
                $this->WriteAttributeBoolean('AlphaDispatchActive', false);
                $this->WriteAttributeString('AlphaDispatchCommandKey', '');
                $this->SendDebug('AlphaESS', 'Dispatch gestoppt', 0);
            }
            return;
        }

        if ($powerID <= 0 || $modeID <= 0 || $socID <= 0 || $timeID <= 0) {
            throw new Exception('AlphaESS: Dispatch-Variablen 2177, 2181, 2182 und 2183 müssen konfiguriert sein.');
        }

        $powerW = max(0.0, min((float)$this->ReadPropertyInteger('MaxDischargePowerW'), abs($powerW)));
        $duration = $slotEnd > time() ? $slotEnd - time() : 60;
        $duration = max(60, min(86400, $duration));
        $socTargetRaw = (int)round(max(0.0, min(100.0, $this->ReadPropertyFloat('MinimumSOC'))) / 0.4);
        $activePowerRaw = (int)round(32000 + $powerW); // >32000 = Entladen
        $key = $activePowerRaw . ':' . $socTargetRaw . ':' . $slotEnd;

        if ($this->ReadAttributeBoolean('AlphaDispatchActive') && $this->ReadAttributeString('AlphaDispatchCommandKey') === $key) {
            return;
        }

        if ($this->ReadAttributeBoolean('AlphaDispatchActive')) {
            $this->WriteVariableSmart($startID, 0);
        }

        // AlphaESS Dispatch Mode 2 = SoC-Steuerung. Die Batterie entlädt mit dem
        // gesetzten Active-Power-Wert (>32000) bis Mindest-SoC oder Zeitablauf.
        $this->WriteVariableSmart($powerID, $activePowerRaw);
        $this->WriteVariableSmart($modeID, 2);
        $this->WriteVariableSmart($socID, $socTargetRaw);
        $this->WriteVariableSmart($timeID, $duration);
        $this->WriteVariableSmart($startID, 1);

        $this->WriteAttributeBoolean('AlphaDispatchActive', true);
        $this->WriteAttributeString('AlphaDispatchCommandKey', $key);
        $this->SendDebug('AlphaESS', 'Dispatch Entladen: ' . round($powerW) . ' W, Ziel-SoC ' . round($socTargetRaw * 0.4, 1) . ' %, ' . $duration . ' s', 0);
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
        $opts = ['http' => ['timeout' => 12, 'header' => "User-Agent: IP-Symcon-SmartBatteryOptimizer/1.2.7\r\n"]];
        $ctx = stream_context_create($opts);
        $raw = @file_get_contents($url, false, $ctx);
        if ($raw === false) throw new Exception('HTTP-Abruf fehlgeschlagen.');
        $data = json_decode($raw, true);
        if (!is_array($data)) throw new Exception('Antwort ist kein gültiges JSON.');
        return $data;
    }


    private function RenderPlanHTML(array $forecast, array $prices, array $plan): string
    {
        $html = '<div style="font-family:Tahoma;font-size:12px">';
        $html .= '<details><summary style="cursor:pointer;font-family:Tahoma;font-size:12px;font-weight:bold;padding:6px 0">Einspeiseplan anzeigen / ausblenden</summary>';
        $html .= '<div style="padding-top:6px"><b>Einspeiseplan / Preise – nächste 24 Stunden (15-Minuten-Raster)</b><br><span style="font-size:11px">Preiswerte werden 24 Stunden angezeigt; geplante Einspeisung nur bis zur nächsten PV-Phase.</span><br><br>';
        $html .= '<table style="border-collapse:collapse;width:100%"><tr><th style="text-align:left">Zeit</th><th>Markt</th><th>Tarif</th><th>Leistung</th><th>Energie</th><th>Grund</th></tr>';
        $now = time();
        $displayEnd = $now + 24 * 3600;
        foreach ($prices as $p) {
            if ($p['end'] <= $now || $p['start'] >= $displayEnd) continue;
            $slot = null;
            foreach ($plan['slots'] as $s) {
                if (abs($s['start'] - $p['start']) < 120 || ($s['start'] >= $p['start'] && $s['start'] < $p['end'])) { $slot = $s; break; }
            }
            $html .= '<tr style="border-top:1px solid #555"><td>' . date('d.m. H:i', $p['start']) . '–' . date('H:i', $p['end']) . '</td>';
            $html .= '<td style="text-align:right">' . number_format($p['marketCt'], 2, ',', '.') . ' ct</td>';
            $html .= '<td style="text-align:right"><b>' . number_format($p['priceCt'], 2, ',', '.') . ' ct</b></td>';
            $html .= '<td style="text-align:right">' . ($slot ? number_format($slot['powerW']/1000, 2, ',', '.') . ' kW' : '-') . '</td>';
            $html .= '<td style="text-align:right">' . ($slot ? number_format($slot['energyKWh'], 2, ',', '.') . ' kWh' : '-') . '</td>';
            $reason = $slot ? (($slot['reason'] ?? 'price') === 'pv_space' ? 'PV-Speicher' : 'Preis') : '-';
            $html .= '<td style="text-align:right">' . $reason . '</td></tr>';
        }
        $html .= '</table><br><b>PV-Flächen morgen</b><br>';
        foreach (($forecast['surfaceTotals'] ?? []) as $name => $kwh) {
            $html .= htmlspecialchars((string)$name) . ': ' . number_format((float)$kwh, 2, ',', '.') . ' kWh<br>';
        }
        if (isset($forecast['surfaceCalibration']) && is_array($forecast['surfaceCalibration'])) {
            $html .= '<br><b>PV-Flächen Kalibrierung</b><br>';
            foreach ($forecast['surfaceCalibration'] as $name => $c) {
                $actual = ($c['actualW'] ?? null) === null ? '-' : number_format((float)$c['actualW'], 0, ',', '.') . ' W';
                $expected = number_format((float)($c['expectedBaseW'] ?? 0), 0, ',', '.') . ' W';
                $mode = empty($c['autoEnabled']) ? 'manuell' : ('Auto-Faktor ' . number_format((float)($c['autoFactor'] ?? 1.0), 3, ',', '.'));
                $html .= htmlspecialchars((string)$name) . ': erwartet ' . $expected . ' | Ist ' . $actual . ' | ' . $mode . ' | ' . (int)($c['sampleCount'] ?? 0) . ' Werte<br>';
            }
        }
        return $html . '</div></details></div>';
    }

    private function BuildPriceChartRows(array $forecast, array $prices, array $plan): array
    {
        $rows = [];
        $now = time();
        $displayEnd = $now + 24 * 3600;
        foreach ($prices as $p) {
            if ($p['end'] <= $now || $p['start'] >= $displayEnd) continue;

            $slot = null;
            foreach ($plan['slots'] as $s) {
                if (abs($s['start'] - $p['start']) < 120 || ($s['start'] >= $p['start'] && $s['start'] < $p['end'])) {
                    $slot = $s;
                    break;
                }
            }

            $rows[] = [
                'start' => (int)$p['start'],
                'end' => (int)$p['end'],
                'label' => date('d.m. H:i', $p['start']),
                'endLabel' => date('H:i', $p['end']),
                'intervalMinutes' => (int)round(($p['end'] - $p['start']) / 60),
                'marketCt' => round((float)$p['marketCt'], 4),
                'priceCt' => round((float)$p['priceCt'], 4),
                'selected' => $slot !== null,
                'reason' => $slot ? ($slot['reason'] ?? 'price') : '',
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
        $html .= 'Reserve inkl. Ziel-SoC: <b>' . number_format($plan['reserveKWh'], 2, ',', '.') . ' kWh</b><br>';
        $html .= 'Ziel-SoC nach PV-Tag: <b>' . number_format((float)($plan['targetSOCPct'] ?? 100.0), 0, ',', '.') . ' %</b><br>';
        $html .= 'Benötigter Speicherstand am PV-Morgen: <b>' . number_format((float)($plan['requiredMorningStoredKWh'] ?? 0.0), 2, ',', '.') . ' kWh</b><br>';
        $html .= 'PV heute: <b>' . number_format((float)($forecast['todayKWh'] ?? 0.0), 2, ',', '.') . ' kWh</b><br>';
        $html .= 'PV morgen: <b>' . number_format($forecast['tomorrowKWh'], 2, ',', '.') . ' kWh</b><br>';
        $html .= 'Gelernter Verbrauch morgen: <b>' . number_format((float)($forecast['consumptionTomorrowKWh'] ?? 0.0), 2, ',', '.') . ' kWh</b><br>';
        $html .= 'Davon während PV-Zeit: <b>' . number_format((float)($forecast['consumptionDuringPVTomorrowKWh'] ?? 0.0), 2, ',', '.') . ' kWh</b><br>';
        $html .= 'Erwarteter PV-Überschuss nach Eigenverbrauch: <b>' . number_format((float)($forecast['pvSurplusTomorrowKWh'] ?? 0.0), 2, ',', '.') . ' kWh</b><br>';
        $html .= 'Verbrauchsprofil: <b>' . htmlspecialchars($this->ReadAttributeString('ConsumptionLearningSource')) . '</b><br>';
        $html .= 'PV ausreichend ab ca.: <b>' . date('H:i', $forecast['morningTs']) . '</b><br>';
        $html .= 'Für Einspeisung verfügbar: <b>' . number_format($plan['availableKWh'], 2, ',', '.') . ' kWh</b><br>';
        $html .= 'Für PV freizugebender Speicher: <b>' . number_format($plan['pvSpaceRequiredKWh'], 2, ',', '.') . ' kWh</b><br>';
        $html .= 'Erwarteter Erlös: <b>' . number_format($plan['expectedRevenueEUR'], 2, ',', '.') . ' €</b><br>';
        $html .= 'Status: <b>' . htmlspecialchars($plan['status']) . '</b>';
        return $html . '</div>';
    }

    private function RenderPVForecastChartHTML(array $forecast): string
    {
        $highchartsJS = $this->GetHighchartsJavaScript();
        $chartId = 'sbo_pv_forecast_chart_' . $this->InstanceID;
        $todayStart = strtotime('today 00:00:00');
        $tomorrowStart = strtotime('tomorrow 00:00:00');
        $end = $tomorrowStart + 86400;
        $actual = $this->GetActualPVTodayHourly($todayStart);
        $rows = [];
        $hours = is_array($forecast['hours'] ?? null) ? $forecast['hours'] : [];

        for ($i = 0; $i < 48; $i++) {
            $ts = $todayStart + $i * 3600;
            $powerKW = 0.0;
            if (isset($hours[$ts]) && is_array($hours[$ts])) {
                $powerKW = max(0.0, (float)($hours[$ts]['totalKW'] ?? 0.0));
            }
            $actualKW = null;
            if ($i < 24 && array_key_exists($i, $actual['hourlyKW'])) {
                $actualKW = $actual['hourlyKW'][$i];
            }
            $rows[] = [
                'label' => date('H:i', $ts),
                'day' => $ts < $tomorrowStart ? 'Heute' : 'Morgen',
                'powerKW' => round($powerKW, 3),
                'actualKW' => $actualKW === null ? null : round(max(0.0, (float)$actualKW), 3)
            ];
        }

        $chartJson = json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($chartJson === false) $chartJson = '[]';
        $todayKWh = (float)($forecast['todayKWh'] ?? 0.0);
        $tomorrowKWh = (float)($forecast['tomorrowKWh'] ?? 0.0);
        $actualTodayKWh = (float)($actual['energyKWh'] ?? 0.0);
        $actualSource = (string)($actual['source'] ?? '');
        $morningTs = (int)($forecast['morningTs'] ?? 0);

        $html = '<div style="font-family:Tahoma;font-size:12px;color:#fff">';
        $html .= '<b>PV-Prognose heute & morgen – Prognose und Ist-Produktion</b><br>';
        if ($highchartsJS !== '') {
            $html .= '<div id="' . $chartId . '" style="width:100%;height:410px;margin-top:8px;margin-bottom:10px"></div>';
            $html .= '<script>' . $highchartsJS . '</script>';
            $html .= '<script>(function(){';
            $html .= 'var rows=' . $chartJson . ';';
            $html .= 'function renderSBOPVChart(){';
            $html .= 'if(typeof Highcharts==="undefined"){return;}';
            $html .= 'var categories=rows.map(function(r){return r.label;});';
            $html .= 'var forecastData=rows.map(function(r){return {y:r.powerKW,custom:r};});';
            $html .= 'var actualData=rows.map(function(r){return r.actualKW===null?null:{y:r.actualKW,custom:r};});';
            $html .= 'Highcharts.chart(' . json_encode($chartId) . ',{';
            $html .= 'chart:{type:"column",backgroundColor:"transparent",animation:false,style:{fontFamily:"Tahoma",color:"#ffffff"}},';
            $html .= 'title:{text:null},credits:{enabled:false},';
            $html .= 'legend:{enabled:true,itemStyle:{fontFamily:"Tahoma",fontSize:"10px",color:"#ffffff",fontWeight:"normal"},itemHoverStyle:{color:"#ffffff"}},';
            $html .= 'xAxis:{categories:categories,lineColor:"#ffffff",tickColor:"#ffffff",tickInterval:2,labels:{style:{fontFamily:"Tahoma",fontSize:"10px",color:"#ffffff"}},plotLines:[{value:23.5,width:2,color:"#ffffff",dashStyle:"ShortDash",zIndex:5,label:{text:"Morgen",rotation:0,y:14,style:{fontFamily:"Tahoma",fontSize:"10px",color:"#ffffff"}}}]},';
            $html .= 'yAxis:{min:0,title:{text:"kW",style:{fontFamily:"Tahoma",color:"#ffffff"}},labels:{style:{fontFamily:"Tahoma",fontSize:"10px",color:"#ffffff"}},gridLineColor:"rgba(255,255,255,0.18)"},';
            $html .= 'tooltip:{useHTML:true,backgroundColor:"rgba(30,30,30,0.96)",borderColor:"#888888",style:{fontFamily:"Tahoma",color:"#ffffff",fontSize:"11px"},formatter:function(){var n=this.series.name;return "<span style=\\"font-family:Tahoma;color:#fff\\"><b>"+this.point.custom.day+" "+this.point.custom.label+"</b><br>"+n+": <b>"+Highcharts.numberFormat(this.y,2,",",".")+" kW</b></span>";}},';
            $html .= 'plotOptions:{column:{borderWidth:0,grouping:false,groupPadding:0.06,pointPadding:0.02}},';
            $html .= 'series:[{name:"PV-Prognose",data:forecastData,zIndex:1,dataLabels:{enabled:true,crop:false,overflow:"allow",formatter:function(){return this.y>=0.25?Highcharts.numberFormat(this.y,1,",","."):"";},style:{fontFamily:"Tahoma",fontSize:"9px",fontWeight:"normal",color:"#ffffff",textOutline:"none"}}},{name:"Ist-Produktion heute",data:actualData,color:"#ffd54f",zIndex:3,pointPadding:0.20,dataLabels:{enabled:false}}]';
            $html .= '});}';
            $html .= 'if(document.readyState==="loading"){document.addEventListener("DOMContentLoaded",renderSBOPVChart);}else{setTimeout(renderSBOPVChart,0);}';
            $html .= '})();</script>';
        } else {
            $maxKW = 0.01;
            foreach ($rows as $row) {
                $maxKW = max($maxKW, (float)$row['powerKW']);
                if ($row['actualKW'] !== null) $maxKW = max($maxKW, (float)$row['actualKW']);
            }
            $html .= '<div style="margin:8px 0 14px 0;padding:8px;border:1px solid rgba(128,128,128,.45);border-radius:6px">';
            foreach ($rows as $i => $row) {
                if ($i === 24) $html .= '<div style="margin:8px 0 5px 0;border-top:1px dashed #fff;padding-top:5px"><b>Morgen</b></div>';
                $forecastWidth = max(0.0, min(100.0, ((float)$row['powerKW'] / $maxKW) * 100.0));
                $actualWidth = $row['actualKW'] === null ? 0.0 : max(0.0, min(100.0, ((float)$row['actualKW'] / $maxKW) * 100.0));
                $html .= '<div style="display:flex;align-items:center;margin:3px 0"><div style="width:45px;flex:0 0 45px">' . htmlspecialchars($row['label']) . '</div><div style="flex:1;height:16px;position:relative;background:rgba(128,128,128,.08)"><div style="position:absolute;left:0;top:1px;height:14px;width:' . number_format($forecastWidth, 1, '.', '') . '%;background:#4e8fd3"></div>';
                if ($row['actualKW'] !== null) $html .= '<div style="position:absolute;left:0;top:4px;height:8px;width:' . number_format($actualWidth, 1, '.', '') . '%;background:#ffd54f"></div>';
                $html .= '</div><div style="width:115px;text-align:right">' . number_format((float)$row['powerKW'], 2, ',', '.') . ' kW';
                if ($row['actualKW'] !== null) $html .= ' / <span style="color:#ffd54f">' . number_format((float)$row['actualKW'], 2, ',', '.') . '</span>';
                $html .= '</div></div>';
            }
            $html .= '</div>';
        }
        $html .= '<div style="font-family:Tahoma;font-size:11px;color:#fff;margin-bottom:8px">Prognose heute: <b>' . number_format($todayKWh, 2, ',', '.') . ' kWh</b> · <span style="color:#ffd54f">Ist heute bis jetzt: <b>' . number_format($actualTodayKWh, 2, ',', '.') . ' kWh</b></span> · Prognose morgen: <b>' . number_format($tomorrowKWh, 2, ',', '.') . ' kWh</b>';
        if ($morningTs > 0 && $morningTs >= $tomorrowStart && $morningTs < $end) {
            $html .= ' · Morgen über der eingestellten Morgenschwelle ab ca. <b>' . date('H:i', $morningTs) . '</b>';
        }
        $html .= '.<br><span style="color:#ccc">Gelb = tatsächlich gemessene mittlere PV-Leistung je Stunde. Quelle: ' . htmlspecialchars($actualSource) . '. Die aktuelle Stunde zeigt den Mittelwert bis zum jetzigen Zeitpunkt.</span></div>';
        return $html . '</div>';
    }

    private function RenderPVCalibrationDiagnosisHTML(array $forecast): string
    {
        $cal = is_array($forecast['surfaceCalibration'] ?? null) ? $forecast['surfaceCalibration'] : [];
        $days = max(1, $this->ReadPropertyInteger('PVCalibrationDays'));
        $html = '<div style="font-family:Tahoma;font-size:12px;color:#fff">';
        $html .= '<b>PV-Kalibrierung Diagnose</b><br><span style="font-size:11px">Auto-Faktor = Summe gemessene Leistung / Summe theoretische Leistung vor Auto-Faktor über die letzten ' . $days . ' Tage.</span><br><br>';
        if (count($cal) === 0) return $html . 'Keine aktive PV-Fläche.</div>';
        $html .= '<div style="overflow-x:auto"><table style="border-collapse:collapse;width:100%;font-family:Tahoma;font-size:11px;color:#fff">';
        $html .= '<tr><th style="text-align:left;border-bottom:1px solid #888;padding:4px">PV-Fläche</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Theorie jetzt<br>vor Auto</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Prognose jetzt<br>mit Auto</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Gemessen<br>jetzt</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Verhältnis<br>jetzt</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Lern-Summen<br>Ist / Theorie</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Auto-Faktor</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Samples</th><th style="text-align:left;border-bottom:1px solid #888;padding:4px">Letzter Wert</th></tr>';
        foreach ($cal as $name => $c) {
            $exp = (float)($c['expectedBaseW'] ?? 0.0);
            $corr = (float)($c['expectedCorrectedW'] ?? 0.0);
            $act = $c['actualW'] ?? null;
            $ratio = $c['currentRatio'] ?? null;
            $sumE = (float)($c['sumExpectedW'] ?? 0.0);
            $sumA = (float)($c['sumActualW'] ?? 0.0);
            $factor = (float)($c['autoFactor'] ?? 1.0);
            $last = (int)($c['lastSampleTs'] ?? 0);
            $status = !empty($c['calibrationBlocked']) ? '<br><span style="color:#ffd166">' . htmlspecialchars((string)$c['calibrationBlockReason']) . '</span>' : '';
            $html .= '<tr>';
            $html .= '<td style="padding:4px;border-bottom:1px solid rgba(128,128,128,.25)"><b>' . htmlspecialchars((string)$name) . '</b>' . $status . '</td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . number_format($exp, 0, ',', '.') . ' W</td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . number_format($corr, 0, ',', '.') . ' W</td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . ($act === null ? '-' : number_format((float)$act, 0, ',', '.') . ' W') . '</td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . ($ratio === null ? '-' : number_format((float)$ratio, 3, ',', '.')) . '</td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . number_format($sumA / 1000.0, 1, ',', '.') . ' / ' . number_format($sumE / 1000.0, 1, ',', '.') . ' kWΣ</td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)"><b>' . number_format($factor, 3, ',', '.') . '</b></td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . (int)($c['sampleCount'] ?? 0) . '</td>';
            $html .= '<td style="padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . ($last > 0 ? date('d.m. H:i', $last) : '-') . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table></div><br><span style="font-size:11px"><b>Lesebeispiel:</b> Theorie 4.000 W, gemessen 6.000 W ⇒ Verhältnis 1,500. Ein Auto-Faktor um 0,500 wäre dann unplausibel und die Lern-Summen zeigen sofort, aus welchen gespeicherten Werten er entsteht.</span>';
        return $html . '</div>';
    }

    private function RenderPriceChartHTML(array $forecast, array $prices, array $plan): string
    {
        // Diagramm-Rendering exakt nach dem bewährten Highcharts-Aufbau aus v1.2.6.
        // Nur die Daten werden vorab von 15 Minuten auf Stundenmittel zusammengefasst.
        $highchartsJS = $this->GetHighchartsJavaScript();
        $chartId = 'sbo_price_chart_' . $this->InstanceID;
        $minimumPrice = $this->ReadPropertyFloat('MinimumFeedInPriceCt');

        $now = time();
        $displayStart = mktime((int)date('H', $now), 0, 0, (int)date('m', $now), (int)date('d', $now), (int)date('Y', $now));
        $displayEnd = $displayStart + 24 * 3600;
        $hourBuckets = [];

        for ($i = 0; $i < 24; $i++) {
            $hourTs = $displayStart + $i * 3600;
            $hourBuckets[$hourTs] = [
                'market' => [], 'price' => [], 'selected' => false, 'reason' => '',
                'powerW' => 0.0, 'energyKWh' => 0.0
            ];
        }

        foreach ($prices as $p) {
            $start = (int)($p['start'] ?? 0);
            $end = (int)($p['end'] ?? 0);
            if ($start <= 0 || $end <= $start) continue;
            if ($end <= $displayStart || $start >= $displayEnd) continue;

            $hourTs = mktime((int)date('H', $start), 0, 0, (int)date('m', $start), (int)date('d', $start), (int)date('Y', $start));
            if (!isset($hourBuckets[$hourTs])) continue;

            $hourBuckets[$hourTs]['market'][] = (float)($p['marketCt'] ?? 0.0);
            $hourBuckets[$hourTs]['price'][] = (float)($p['priceCt'] ?? 0.0);

            foreach ($plan['slots'] as $slot) {
                $slotStart = (int)($slot['start'] ?? 0);
                if (abs($slotStart - $start) < 120 || ($slotStart >= $start && $slotStart < $end)) {
                    $hourBuckets[$hourTs]['selected'] = true;
                    if (($slot['reason'] ?? '') === 'pv_space') {
                        $hourBuckets[$hourTs]['reason'] = 'pv_space';
                    } elseif ($hourBuckets[$hourTs]['reason'] === '') {
                        $hourBuckets[$hourTs]['reason'] = 'price';
                    }
                    $hourBuckets[$hourTs]['powerW'] = max($hourBuckets[$hourTs]['powerW'], (float)($slot['powerW'] ?? 0.0));
                    $hourBuckets[$hourTs]['energyKWh'] += (float)($slot['energyKWh'] ?? 0.0);
                    break;
                }
            }
        }

        $chartRows = [];
        $knownHours = 0;
        foreach ($hourBuckets as $hourTs => $bucket) {
            $known = count($bucket['market']) > 0 && count($bucket['price']) > 0;
            if ($known) $knownHours++;
            $chartRows[] = [
                'label' => date('d.m. H:i', $hourTs),
                'marketCt' => $known ? round(array_sum($bucket['market']) / count($bucket['market']), 4) : null,
                'priceCt' => $known ? round(array_sum($bucket['price']) / count($bucket['price']), 4) : null,
                'known' => $known,
                'selected' => $bucket['selected'],
                'reason' => $bucket['reason'],
                'powerW' => round($bucket['powerW'], 1),
                'energyKWh' => round($bucket['energyKWh'], 4)
            ];
        }

        $chartJson = json_encode($chartRows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($chartJson === false) $chartJson = '[]';

        $html = '<div style="font-family:Tahoma;font-size:12px;color:#fff">';
        $html .= '<b>Einspeisevergütung – Stundenmittel der nächsten 24 Stunden</b><br>';
        if ($highchartsJS !== '') {
            $html .= '<div id="' . $chartId . '" style="width:100%;height:390px;margin-top:8px;margin-bottom:10px"></div>';
            $html .= '<script>' . $highchartsJS . '</script>';
            $html .= '<script>(function(){';
            $html .= 'var rows=' . $chartJson . ';';
            $html .= 'function renderSBOChart(){';
            $html .= 'if(typeof Highcharts==="undefined"){return;}';
            $html .= 'var categories=rows.map(function(r){return r.label;});';
            $html .= 'var market=rows.map(function(r){if(!r.known){return {y:null,custom:r};}return {y:r.priceCt,color:r.reason==="pv_space"?"#e0a000":(r.selected?"#38a169":(r.priceCt<0?"#d9534f":"#4e8fd3")),custom:r};});';
            $html .= 'Highcharts.chart(' . json_encode($chartId) . ',{';
            $html .= 'chart:{type:"column",backgroundColor:"transparent",animation:false,style:{fontFamily:"Tahoma",color:"#ffffff"}},';
            $html .= 'title:{text:null,style:{fontFamily:"Tahoma",color:"#ffffff"}},credits:{enabled:false},legend:{enabled:false,itemStyle:{fontFamily:"Tahoma",color:"#ffffff"},itemHoverStyle:{color:"#ffffff"}},';
            $html .= 'xAxis:{categories:categories,lineColor:"#ffffff",tickColor:"#ffffff",labels:{rotation:-45,style:{fontFamily:"Tahoma",fontSize:"10px",color:"#ffffff"}}},';
            $html .= 'yAxis:{title:{text:"ct/kWh",style:{fontFamily:"Tahoma",color:"#ffffff"}},labels:{style:{fontFamily:"Tahoma",fontSize:"10px",color:"#ffffff"}},gridLineColor:"rgba(255,255,255,0.18)",plotLines:[{value:0,color:"#ffffff",width:1,zIndex:4},{value:' . json_encode($minimumPrice) . ',color:"#e0a000",width:1,dashStyle:"Dash",zIndex:4,label:{text:"Mindestpreis ' . number_format($minimumPrice, 2, ',', '.') . ' ct",style:{fontFamily:"Tahoma",fontSize:"10px",color:"#ffffff"}}}]},';
            $html .= 'tooltip:{useHTML:true,backgroundColor:"rgba(30,30,30,0.96)",borderColor:"#888888",style:{fontFamily:"Tahoma",color:"#ffffff",fontSize:"11px"},formatter:function(){var r=this.point.custom;return "<span style=\\"font-family:Tahoma;color:#fff\\"><b>"+r.label+"</b><br>Börsenpreis: <b>"+Highcharts.numberFormat(r.marketCt,2,",",".")+" ct/kWh</b><br>Berechneter Tarif: "+Highcharts.numberFormat(r.priceCt,2,",",".")+" ct/kWh"+(r.selected?"<br><b>"+(r.reason==="pv_space"?"Speicher für PV freihalten":"Preisoptimierung")+"</b><br>Leistung: "+Highcharts.numberFormat(r.powerW/1000,2,",",".")+" kW<br>Energie: "+Highcharts.numberFormat(r.energyKWh,2,",",".")+" kWh":"")+"</span>";}},';
            $html .= 'plotOptions:{column:{borderWidth:0,groupPadding:0.08,pointPadding:0.03,dataLabels:{enabled:true,crop:false,overflow:"allow",formatter:function(){return Highcharts.numberFormat(this.y,2,",",".")+" ct";},style:{fontFamily:"Tahoma",fontSize:"10px",fontWeight:"normal",color:"#ffffff",textOutline:"none"}}}},';
            $html .= 'series:[{name:"Einspeisevergütung",data:market}]';
            $html .= '});}';
            $html .= 'if(document.readyState==="loading"){document.addEventListener("DOMContentLoaded",renderSBOChart);}else{setTimeout(renderSBOChart,0);}';
            $html .= '})();</script>';
        } else {
            $html .= $this->RenderFallbackPriceChart($chartRows, $minimumPrice);
        }
        $missingHours = 24 - $knownHours;
        $priceAvailabilityText = $missingHours > 0
            ? ' Für ' . $missingHours . ' der nächsten 24 Stunden sind vom Preislieferanten noch keine Day-Ahead-Werte veröffentlicht; diese Stunden werden beim nächsten Abruf automatisch ergänzt.'
            : ' Für alle nächsten 24 Stunden liegen Preiswerte vor.';
        $html .= '<div style="font-family:Tahoma;font-size:11px;color:#fff;margin-bottom:8px">Jeder Balken ist der Mittelwert der 15-Minuten-Werte der jeweiligen Stunde. Grün = Preisoptimierung, Gelb = Speicher für PV freihalten, Rot = negative Einspeisevergütung, Blau = übrige Stunden. Die Optimierung selbst bleibt im 15-Minuten-Takt.' . htmlspecialchars($priceAvailabilityText) . '</div>';
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
            if (empty($row['known'])) {
                $label = htmlspecialchars((string)$row['label']);
                $html .= '<div style="display:flex;align-items:center;margin:3px 0;min-height:18px">';
                $html .= '<div style="width:92px;flex:0 0 92px;font-size:10px;white-space:nowrap">' . $label . '</div>';
                $html .= '<div style="width:calc(100% - 185px);height:14px;background:rgba(128,128,128,.08);border:1px dashed rgba(255,255,255,.18);box-sizing:border-box"></div>';
                $html .= '<div style="width:88px;flex:0 0 88px;text-align:right;font-size:10px;color:#aaa">noch offen</div>';
                $html .= '</div>';
                continue;
            }
            $value = (float)$row['priceCt'];
            $width = min(100.0, abs($value) / $maxAbs * 100.0);
            $color = (($row['reason'] ?? '') === 'pv_space') ? '#e0a000' : (!empty($row['selected']) ? '#38a169' : ($value < 0 ? '#d9534f' : '#4e8fd3'));
            $label = htmlspecialchars((string)$row['label']);
            $valueText = number_format($value, 2, ',', '.') . ' ct/kWh';
            $title = 'Einspeisevergütung: ' . $valueText . ' | EPEX Spot AT: ' . number_format((float)$row['marketCt'], 2, ',', '.') . ' ct/kWh';
            if (!empty($row['selected'])) {
                $title .= ' | ' . (($row['reason'] ?? '') === 'pv_space' ? 'PV-Speicherfreihaltung' : 'Preisoptimierung') . ' | Einspeisung: ' . number_format((float)$row['powerW'] / 1000, 2, ',', '.') . ' kW, ' . number_format((float)$row['energyKWh'], 2, ',', '.') . ' kWh';
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
            return str_replace('</script>', '<\\/script>', $js);
        }

        return '';
    }
}
