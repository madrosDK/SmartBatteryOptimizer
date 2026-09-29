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
        $this->RegisterPropertyBoolean('UseOpenMeteoForecast', true);
        $this->RegisterPropertyBoolean('UseForecastSolarForecast', false);
        $this->RegisterPropertyString('ForecastSolarAPIKey', '');
        $this->RegisterPropertyBoolean('UsePVNodeForecast', false);
        $this->RegisterPropertyString('PVNodeAPIKey', '');
        $this->RegisterPropertyString('PVNodeSiteID', '');
        $this->RegisterPropertyInteger('PVNodeMaxRequestsPerDay', 1);
        $this->RegisterPropertyInteger('ForecastWeightLearningDays', 7);
        $this->RegisterPropertyInteger('PVCalibrationDays', 30);
        $this->RegisterPropertyInteger('UnknownOrientationLearningDays', 30);
        $this->RegisterPropertyInteger('PVCalibrationMinExpectedW', 300);
        $this->RegisterPropertyFloat('PVCalibrationMinFactor', 0.50);
        $this->RegisterPropertyFloat('PVCalibrationMaxFactor', 1.50);
        $this->RegisterPropertyInteger('PVCalibrationFeedInVariable', 0);
        $this->RegisterPropertyInteger('PVCalibrationFeedInLimitW', 10000);
        $this->RegisterPropertyInteger('PVCalibrationFeedInToleranceW', 500);
        $this->RegisterPropertyInteger('PVCalibrationPollSeconds', 30);
        $this->RegisterPropertyInteger('PVCalibrationCurtailmentMajorityPct', 75);
        $this->RegisterPropertyBoolean('PVCalibrationFeedInInvert', false);
        // Legacy-Eigenschaften fuer Abwaertskompatibilitaet. Die Bedienung erfolgt ab 1.9.78 ueber einen Popup-Dialog.
        $this->RegisterPropertyString('PVCalibrationCleanupDate', '');
        $this->RegisterPropertyString('PVCalibrationCleanupFrom', '10:00');
        $this->RegisterPropertyString('PVCalibrationCleanupTo', '23:59');
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
        $this->RegisterPropertyInteger('MinimumValidConsumptionDays', 3);
        $this->RegisterPropertyFloat('FallbackDailyConsumptionKWh', 12.0);
        $this->RegisterPropertyFloat('ConsumptionForecastSafetyPct', 10.0);
        $this->RegisterPropertyFloat('BatteryTargetSOC', 100.0);
        $this->RegisterPropertyInteger('MinimumValidNights', 3);
        $this->RegisterPropertyBoolean('AutomaticDayNight', false);
        $this->RegisterPropertyInteger('SunriseVariable', 0);
        $this->RegisterPropertyInteger('SunsetVariable', 0);
        $this->RegisterPropertyInteger('NightBeforeSunsetMinutes', 60);
        $this->RegisterPropertyInteger('NightAfterSunriseMinutes', 60);
        $this->RegisterPropertyInteger('NightStartHour', 18);
        $this->RegisterPropertyInteger('FallbackMorningHour', 8);
        $this->RegisterPropertyInteger('MorningPVThresholdW', 300);
        $this->RegisterPropertyFloat('SafetyReservePct', 10.0);
        $this->RegisterPropertyFloat('OutlierPct', 70.0);

        $this->RegisterPropertyInteger('PriceProvider', 0);
        $this->RegisterPropertyInteger('PriceJSONVariable', 0);
        $this->RegisterPropertyInteger('PriceDisplayHours', 24);
        $this->RegisterPropertyFloat('PositivePriceFactor', 1.0);
        $this->RegisterPropertyFloat('NegativePriceFactor', 1.0);
        $this->RegisterPropertyFloat('PriceAdjustmentCt', 0.0);
        $this->RegisterPropertyFloat('MinimumFeedInPriceCt', 0.0);
        $this->RegisterPropertyFloat('MinimumTomorrowPVKWh', 8.0);
        $this->RegisterPropertyFloat('PoorForecastExtraReservePct', 40.0);
        $this->RegisterPropertyBoolean('DisableFeedInOnVeryPoorForecast', false);
        $this->RegisterPropertyFloat('VeryPoorForecastKWh', 2.0);
        $this->RegisterPropertyBoolean('PreventPVCurtailment', true);
        $this->RegisterPropertyInteger('GridFeedInLimitW', 10000);
        $this->RegisterPropertyInteger('GridLimitSafetyW', 500);
        $this->RegisterPropertyInteger('MaxBatteryChargePowerW', 5000);
        $this->RegisterPropertyFloat('PVHeadroomTargetSOC', 95.0);
        $this->RegisterPropertyFloat('PVStorageSharePct', 70.0);
        $this->RegisterPropertyFloat('PVSpaceMinimumPriceCt', 0.0);
        $this->RegisterPropertyInteger('FeedInFactorVariable', 0);

        $this->RegisterPropertyInteger('RefreshMinutes', 30);
        $this->RegisterPropertyInteger('PVForecastRefreshMinutes', 30);
        $this->RegisterPropertyInteger('PVActualRefreshMinutes', 5);
        $this->RegisterPropertyBoolean('DebugMode', false);

        $this->RegisterVariableFloat('PVForecastToday', 'PV Prognose heute', '~Electricity', 9);
        $this->RegisterVariableFloat('PVForecastTomorrow', 'PV Prognose morgen', '~Electricity', 10);
        $this->RegisterVariableString('PVCalibrationStatus', 'PV Kalibrierung', '', 11);
        $this->RegisterVariableString('AutomaticReleaseStatus', 'Automatikfreigabe', '', 12);
        $this->RegisterVariableFloat('NightConsumptionForecast', 'Prognose Nachtverbrauch', '~Electricity', 20);
        $this->RegisterVariableString('NightConsumptionSource', 'Quelle Nachtverbrauch', '', 21);
        $this->RegisterVariableInteger('ValidNightSamples', 'Gültige Nächte', '', 22);
        $this->RegisterVariableFloat('ConsumptionForecastTomorrow', 'Verbrauchsprognose morgen', '~Electricity', 23);
        $this->RegisterVariableFloat('ExpectedPVSurplusTomorrow', 'PV-Überschuss morgen nach Eigenverbrauch', '~Electricity', 24);
        $this->RegisterVariableFloat('PVPeakPowerTomorrow', 'PV Spitzenleistung morgen Prognose', '~Watt', 25);
        $this->RegisterVariableFloat('PredictedMaxGridExportTomorrow', 'Max. erwartete Netzeinspeisung morgen ohne Batterie', '~Watt', 26);
        $this->RegisterVariableFloat('GridLimitHeadroomRequired', 'Speicherbedarf Netzlimit-Schutz', '~Electricity', 27);
        $this->RegisterVariableString('ConsumptionLearningStatus', 'Verbrauchsprofil Lernen', '', 28);
        $this->RegisterVariableFloat('AvailableFeedInEnergy', 'Für Einspeisung verfügbar', '~Electricity', 30);
        $this->RegisterVariableFloat('PVSpaceRequiredEnergy', 'Für PV freizugebender Speicher', '~Electricity', 31);
        $this->RegisterVariableFloat('CurrentPrice', 'Aktueller Einspeisepreis', '', 40);
        $this->RegisterVariableFloat('HighestPrice', 'Höchster geplanter Einspeisepreis', '', 50);
        $this->RegisterVariableBoolean('AutomaticEnabled', 'Einspeiseautomatik', '~Switch', 55);
        $this->EnableAction('AutomaticEnabled');

        // Laufzeitwerte für den Netzlimit-Schutz. Diese Werte können direkt im
        // IP-Symcon Frontend geändert werden, ohne die Instanzkonfiguration zu öffnen.
        $this->EnsureRuntimeProfiles();
        $this->RegisterVariableBoolean('PVCurtailmentProtectionEnabled', 'PV-Abregelung vermeiden', '~Switch', 56);
        $this->EnableAction('PVCurtailmentProtectionEnabled');
        $this->RegisterVariableInteger('RuntimeGridFeedInLimitW', 'Maximale Netzeinspeisung', 'SBO.PowerW', 57);
        $this->EnableAction('RuntimeGridFeedInLimitW');
        $this->RegisterVariableInteger('RuntimeGridLimitSafetyW', 'Sicherheitsabstand Einspeisegrenze', 'SBO.PowerW', 58);
        $this->EnableAction('RuntimeGridLimitSafetyW');
        $this->RegisterVariableInteger('RuntimeMaxBatteryChargePowerW', 'Maximale Batterieladeleistung', 'SBO.PowerW', 59);
        $this->EnableAction('RuntimeMaxBatteryChargePowerW');
        $this->RegisterVariableFloat('RuntimePVHeadroomTargetSOC', 'Maximaler Ziel-SoC bei starker PV', 'SBO.Percent', 60);
        $this->EnableAction('RuntimePVHeadroomTargetSOC');
        $this->RegisterVariableFloat('RuntimePVStorageSharePct', 'PV-Prognose als möglicher Batterieüberschuss', 'SBO.Percent', 61);
        $this->EnableAction('RuntimePVStorageSharePct');
        $this->RegisterVariableFloat('RuntimePVSpaceMinimumPriceCt', 'Mindestpreis Einspeisung', 'SBO.PriceCt', 62);
        $this->EnableAction('RuntimePVSpaceMinimumPriceCt');
        $this->RegisterVariableFloat('RuntimeMinimumSOC', 'Mindest-SoC', 'SBO.Percent', 67);
        $this->EnableAction('RuntimeMinimumSOC');
        $this->RegisterVariableString('FeedInPriceLockStatus', 'Einspeisepreis-Sperre', '', 68);

        $this->RegisterVariableInteger('TestDischargePowerW', 'Test Entladeleistung', 'SBO.PowerW', 63);
        $this->EnableAction('TestDischargePowerW');
        $this->RegisterVariableBoolean('TestDischarge', 'Test Entladung / Einspeisung', '~Switch', 64);
        $this->EnableAction('TestDischarge');
        $this->RegisterVariableString('TestDischargeStatus', 'Test Entladung Status', '', 65);

        $this->RegisterVariableBoolean('FeedInActive', 'Einspeisung aktiv', '~Switch', 66);
        $this->RegisterVariableFloat('PlannedPower', 'Geplante Einspeiseleistung', '~Watt', 70);
        $this->RegisterVariableFloat('FeedInTargetEnergy', 'Geplante Einspeisemenge aktuell', '~Electricity', 71);
        $this->RegisterVariableFloat('FeedInDeliveredEnergy', 'Tatsächlich eingespeiste Menge aktuell', '~Electricity', 72);
        $this->RegisterVariableString('NextFeedInWindow', 'Nächstes Einspeisefenster', '', 80);
        $this->RegisterVariableFloat('ExpectedRevenue', 'Erwarteter Erlös', '', 90);
        $this->RegisterVariableString('LastUpdate', 'Letzte Aktualisierung', '', 100);
        $this->RegisterVariableString('StatusText', 'Optimierungsstatus', '', 110);
        $this->RegisterVariableString('OverviewHTML', 'Übersicht', '~HTMLBox', 120);
        $this->RegisterVariableString('PVForecastChartHTML', 'PV-Prognose Diagramm', '~HTMLBox', 150);
        $this->RegisterVariableString('ConsumptionProfileChartHTML', 'Verbrauch Lastprofil Diagramm', '~HTMLBox', 151);
        $this->RegisterVariableString('FeedInStatisticsHTML', 'Einspeise-Statistik', '~HTMLBox', 152);
        $this->RegisterVariableString('FeedInDebugHTML', 'Einspeise-Debug 24 h', '~HTMLBox', 153);
        $this->RegisterVariableString('PVCalibrationDiagnosisHTML', 'PV-Kalibrierung Diagnose', '~HTMLBox', 190);
        $this->RegisterVariableString('ActionFeedback', 'Letzte Aktionen', '~HTMLBox', 118);
        $this->RegisterVariableString('ForecastSolarStatus', 'PV-Prognose Anbieter', '~HTMLBox', 119);
        $this->RegisterVariableString('PVDebugVisibilityState', 'PV Debug Sichtbarkeit', '', 126);
        $this->RegisterVariableString('ProviderDebugHTML', 'Prognose Provider Debug', '~HTMLBox', 191);
        $this->RegisterVariableString('DataExportStatus', 'Datenspeicher Export', '', 128);
        $this->RegisterVariableString('ArchiveStorageStatus', 'Archiv-Datenspeicher', '', 129);
        $this->EnableAction('PVDebugVisibilityState');
        $this->RegisterVariableString('PriceChartHTML', 'Börsenpreis Diagramm', '~HTMLBox', 123);
        $this->RegisterVariableString('PlanHTML', 'Einspeiseplan', '~HTMLBox', 123);

        $this->RegisterAttributeString('ForecastJSON', '{}');
        $this->RegisterAttributeString('PVForecastHistoryJSON', '{}');
        $this->RegisterAttributeString('PVSourceForecastHistoryJSON', '{}');
        $this->RegisterAttributeString('ForecastSolarSurfaceCacheJSON', '{}');
        $this->RegisterAttributeInteger('ForecastSolarRetryAfterTs', 0);
        $this->RegisterAttributeString('PVDebugVisibilityJSON', '{}');
        $this->RegisterAttributeString('ProviderDebugLogJSON', '[]');
        $this->RegisterAttributeString('ActionHistoryJSON', '[]');
        $this->RegisterAttributeString('AppliedModuleVersion', '');
        $this->RegisterAttributeString('PVSourceWeightsJSON', '{}');
        $this->RegisterAttributeInteger('PVSourceWeightLearningResetTs', 0);
        $this->RegisterAttributeInteger('PVNodeConsecutiveRejects', 0);
        $this->RegisterAttributeBoolean('PVNodeAutoDisabled', false);
        $this->RegisterAttributeString('PVNodeLastError', '');
        $this->RegisterAttributeString('PVNodeForecastCacheJSON', '{}');
        $this->RegisterAttributeInteger('PVNodeNextPollTs', 0);
        $this->RegisterAttributeString('PVNodeRequestDay', '');
        $this->RegisterAttributeInteger('PVNodeRequestCount', 0);
        $this->RegisterAttributeBoolean('LastAppliedDebugMode', false);
        $this->RegisterAttributeString('PVCalibrationJSON', '{}');
        $this->RegisterAttributeInteger('ArchiveStorageMigrationVersion', 0);
        $this->RegisterAttributeString('ArchiveStorageStatus', '');
        $this->RegisterAttributeInteger('PVCalibrationEnergyVersion', 0);
        $this->RegisterAttributeBoolean('PVCalibrationCurtailmentLatched', false);
        $this->RegisterAttributeInteger('PVCalibrationBelowThresholdSince', 0);
        $this->RegisterAttributeInteger('PVCalibrationAboveThresholdSince', 0);
        $this->RegisterAttributeInteger('PVCalibrationAboveThresholdCount', 0);
        $this->RegisterAttributeInteger('PVCalibrationBlockedFromTs', 0);
        $this->RegisterAttributeString('PVCalibrationCurtailmentSamplesJSON', '[]');
        $this->RegisterAttributeInteger('PVCalibrationLockUntil', 0);
        $this->RegisterAttributeInteger('PVCalibrationExclusionActiveFromTs', 0);
        $this->RegisterAttributeString('PVCalibrationExclusionActiveReason', '');
        $this->RegisterAttributeString('PVCalibrationExcludedPeriodsJSON', '[]');
        $this->RegisterAttributeString('PVCalibrationCleanupStatus', '');
        $this->RegisterAttributeInteger('CalculationLockUntil', 0);
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
        $this->RegisterAttributeString('ActiveFeedInPlanKey', '');
        $this->RegisterAttributeFloat('ActiveFeedInTargetKWh', 0.0);
        $this->RegisterAttributeFloat('ActiveFeedInDeliveredKWh', 0.0);
        $this->RegisterAttributeInteger('ActiveFeedInLastTs', 0);
        $this->RegisterAttributeFloat('ActiveFeedInLastExportW', 0.0);
        $this->RegisterAttributeInteger('ActiveFeedInLastAdjustmentTs', 0);
        $this->RegisterAttributeInteger('ActiveFeedInPlannedEndTs', 0);
        $this->RegisterAttributeString('CompletedFeedInPlanKeysJSON', '{}');
        $this->RegisterAttributeString('FeedInStatisticsJSON', '[]');
        $this->RegisterAttributeString('FeedInDebugLogJSON', '[]');
        $this->RegisterAttributeString('GridExportDailyJSON', '{}');
        $this->RegisterAttributeInteger('GridExportTrackLastTs', 0);
        $this->RegisterAttributeFloat('GridExportTrackLastW', 0.0);
        $this->RegisterAttributeInteger('ActiveFeedInStartedTs', 0);
        $this->RegisterAttributeFloat('ActiveFeedInPriceCt', 0.0);
        $this->RegisterAttributeString('ActiveFeedInReason', '');
        $this->RegisterAttributeBoolean('FeedInPriceLockActive', false);
        $this->RegisterAttributeFloat('FeedInFactorOriginalValue', 0.0);
        $this->RegisterAttributeBoolean('FeedInFactorOriginalValid', false);
        $this->RegisterAttributeInteger('FeedInFactorVariableLastID', 0);
        $this->RegisterAttributeBoolean('RuntimePVSettingsInitialized', false);
        $this->RegisterAttributeInteger('ManualTestUntil', 0);
        $this->RegisterAttributeInteger('ManualTestPowerW', 0);
        $this->RegisterAttributeInteger('AlphaTestStage', 0);
        $this->RegisterAttributeInteger('AlphaTestNextTs', 0);
        $this->RegisterAttributeString('AlphaTestTrace', '');

        $this->RegisterTimer('RefreshTimer', 0, 'SBO_RefreshOptimization($_IPS[\'TARGET\']);');
        $this->RegisterTimer('PVForecastTimer', 0, 'SBO_Recalculate($_IPS[\'TARGET\']);');
        $this->RegisterTimer('PVActualTimer', 0, 'SBO_RefreshPVActual($_IPS[\'TARGET\']);');
        $this->RegisterTimer('PVCalibrationTimer', 0, 'SBO_RefreshPVCalibration($_IPS[\'TARGET\']);');
        $this->RegisterTimer('ControlTimer', 0, 'SBO_Control($_IPS[\'TARGET\']);');
        $this->RegisterTimer('ManualRecalculateWorker', 0, 'SBO_RunManualRecalculate($_IPS[\'TARGET\']);');
        $this->RegisterTimer('FullRefreshWorker', 0, 'SBO_RunFullRefresh($_IPS[\'TARGET\']);');
        $this->RegisterTimer('DeferredDebugRebuildTimer', 0, 'SBO_DeferredDebugRebuild($_IPS[\'TARGET\']);');
    }

    private function EnsureRuntimeProfiles(): void
    {
        if (!IPS_VariableProfileExists('SBO.PowerW')) {
            IPS_CreateVariableProfile('SBO.PowerW', 1);
        }
        IPS_SetVariableProfileDigits('SBO.PowerW', 0);
        IPS_SetVariableProfileText('SBO.PowerW', '', ' W');
        IPS_SetVariableProfileValues('SBO.PowerW', 0, 100000, 100);

        if (!IPS_VariableProfileExists('SBO.Percent')) {
            IPS_CreateVariableProfile('SBO.Percent', 2);
        }
        IPS_SetVariableProfileDigits('SBO.Percent', 1);
        IPS_SetVariableProfileText('SBO.Percent', '', ' %');
        IPS_SetVariableProfileValues('SBO.Percent', 0, 100, 1);

        if (!IPS_VariableProfileExists('SBO.PriceCt')) {
            IPS_CreateVariableProfile('SBO.PriceCt', 2);
        }
        IPS_SetVariableProfileDigits('SBO.PriceCt', 2);
        IPS_SetVariableProfileText('SBO.PriceCt', '', ' ct/kWh');
        IPS_SetVariableProfileValues('SBO.PriceCt', -100, 500, 0.1);
    }

    public function GetConfigurationForm()
    {
        $form = json_decode(file_get_contents(__DIR__ . '/form.json'), true);
        if (!is_array($form)) {
            return file_get_contents(__DIR__ . '/form.json');
        }

        $automatic = $this->ReadPropertyBoolean('AutomaticDayNight');
        $automaticFields = [
            'SunriseVariable',
            'SunsetVariable',
            'NightBeforeSunsetMinutes',
            'NightAfterSunriseMinutes',
            'AutomaticDayNightInfo'
        ];
        $manualFields = ['NightStartHour', 'FallbackMorningHour'];

        $setVisibility = function (&$node) use (&$setVisibility, $automatic, $automaticFields, $manualFields) {
            if (!is_array($node)) return;
            if (isset($node['name'])) {
                if (in_array($node['name'], $automaticFields, true)) {
                    $node['visible'] = $automatic;
                } elseif (in_array($node['name'], $manualFields, true)) {
                    $node['visible'] = !$automatic;
                }
            }
            foreach ($node as &$value) {
                if (is_array($value)) $setVisibility($value);
            }
            unset($value);
        };

        $setVisibility($form);

        // Popup zur gezielten PV-Kalibrierbereinigung: beim Oeffnen der
        // Konfiguration sinnvolle Startwerte vorbelegen. Diese Felder sind
        // reine Aktionsfelder und werden nicht als Instanz-Properties gespeichert.
        $today = ['year' => (int)date('Y'), 'month' => (int)date('n'), 'day' => (int)date('j')];
        $fromDefault = ['hour' => 0, 'minute' => 0, 'second' => 0];
        $toDefault = ['hour' => (int)date('G'), 'minute' => (int)date('i'), 'second' => 0];
        $setCleanupDefaults = function (&$node) use (&$setCleanupDefaults, $today, $fromDefault, $toDefault) {
            if (!is_array($node)) return;
            if (($node['name'] ?? '') === 'CleanupDialogDate') $node['value'] = $today;
            if (($node['name'] ?? '') === 'CleanupDialogFrom') $node['value'] = $fromDefault;
            if (($node['name'] ?? '') === 'CleanupDialogTo') $node['value'] = $toDefault;
            foreach ($node as &$value) {
                if (is_array($value)) $setCleanupDefaults($value);
            }
            unset($value);
        };
        $setCleanupDefaults($form);

        return json_encode($form, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function ApplyChanges()
    {
        parent::ApplyChanges();
        // Oberfläche aufgeräumt: Status zuerst, danach Diagramme, Debug ganz unten.
        $positions = [
            'ActionFeedback'=>118, 'ForecastSolarStatus'=>119,
            'OverviewHTML'=>120, 'PlanHTML'=>130, 'PriceChartHTML'=>149,
            'PVForecastChartHTML'=>150, 'ConsumptionProfileChartHTML'=>151,
            'PVCalibrationDiagnosisHTML'=>190, 'ProviderDebugHTML'=>191
        ];
        foreach ($positions as $ident => $position) {
            $id = @$this->GetIDForIdent($ident); if ($id > 0) @IPS_SetPosition($id, $position);
        }

        if (!$this->ReadAttributeBoolean('RuntimePVSettingsInitialized')) {
            SetValue($this->GetIDForIdent('PVCurtailmentProtectionEnabled'), $this->ReadPropertyBoolean('PreventPVCurtailment'));
            SetValue($this->GetIDForIdent('RuntimeGridFeedInLimitW'), $this->ReadPropertyInteger('GridFeedInLimitW'));
            SetValue($this->GetIDForIdent('RuntimeGridLimitSafetyW'), $this->ReadPropertyInteger('GridLimitSafetyW'));
            SetValue($this->GetIDForIdent('RuntimeMaxBatteryChargePowerW'), $this->ReadPropertyInteger('MaxBatteryChargePowerW'));
            SetValue($this->GetIDForIdent('RuntimePVHeadroomTargetSOC'), $this->ReadPropertyFloat('PVHeadroomTargetSOC'));
            SetValue($this->GetIDForIdent('RuntimePVStorageSharePct'), $this->ReadPropertyFloat('PVStorageSharePct'));
            SetValue($this->GetIDForIdent('RuntimePVSpaceMinimumPriceCt'), $this->ReadPropertyFloat('PVSpaceMinimumPriceCt'));
            SetValue($this->GetIDForIdent('RuntimeMinimumSOC'), $this->GetRuntimeMinimumSOC());
            SetValue($this->GetIDForIdent('TestDischargePowerW'), min(1000, max(0, $this->ReadPropertyInteger('MaxDischargePowerW'))));
            $this->WriteAttributeBoolean('RuntimePVSettingsInitialized', true);
        }

        if ((float)GetValue($this->GetIDForIdent('RuntimeMinimumSOC')) <= 0.0 && $this->GetRuntimeMinimumSOC() > 0.0) {
            SetValue($this->GetIDForIdent('RuntimeMinimumSOC'), $this->GetRuntimeMinimumSOC());
        }

        // Der bisherige Laufzeitwert bleibt aus Kompatibilitätsgründen unter demselben Ident,
        // ist funktional aber ab dieser Version die zentrale Preisuntergrenze für JEDE Netzeinspeisung.
        $minimumPriceVarID = @$this->GetIDForIdent('RuntimePVSpaceMinimumPriceCt');
        if ($minimumPriceVarID > 0) @IPS_SetName($minimumPriceVarID, 'Mindestpreis Einspeisung');
        $this->InitializeFeedInFactorMemory();
        // Zeitreihen ab 1.9.79 im IP-Symcon Archive Control verwalten.
        // Bestehende JSON-Lerndaten/Statistiken werden beim ersten Lauf einmalig uebernommen.
        $this->EnsureArchiveStorageAndMigration();

        $debugMode = $this->ReadPropertyBoolean('DebugMode');
        $lastAppliedDebugMode = $this->ReadAttributeBoolean('LastAppliedDebugMode');
        $debugModeChanged = ($debugMode !== $lastAppliedDebugMode);
        @IPS_SetHidden($this->GetIDForIdent('ProviderDebugHTML'), !$debugMode);
        if (!$debugMode) SetValue($this->GetIDForIdent('ProviderDebugHTML'), '');
        if ($debugModeChanged) {
            $this->WriteAttributeBoolean('LastAppliedDebugMode', $debugMode);
        }

        // Wurde pvnode nach einer automatischen Sperre vom Benutzer wieder angehakt,
        // beginnt die Prüfung der Zugangsdaten bewusst wieder bei null.
        if ($this->ReadPropertyBoolean('UsePVNodeForecast') && $this->ReadAttributeBoolean('PVNodeAutoDisabled')) {
            $this->WriteAttributeInteger('PVNodeConsecutiveRejects', 0);
            $this->WriteAttributeBoolean('PVNodeAutoDisabled', false);
            $this->WriteAttributeString('PVNodeLastError', '');
        }
        $refresh = max(5, $this->ReadPropertyInteger('RefreshMinutes'));
        $pvForecastRefresh = max(5, $this->ReadPropertyInteger('PVForecastRefreshMinutes'));
        $pvActualRefresh = max(1, $this->ReadPropertyInteger('PVActualRefreshMinutes'));
        $this->SetTimerInterval('RefreshTimer', $refresh * 60 * 1000);
        $this->SetTimerInterval('PVForecastTimer', $pvForecastRefresh * 60 * 1000);
        $this->SetTimerInterval('PVActualTimer', $pvActualRefresh * 60 * 1000);
        $pvCalibrationPollSeconds = max(10, min(120, $this->ReadPropertyInteger('PVCalibrationPollSeconds')));
        $this->SetTimerInterval('PVCalibrationTimer', $pvCalibrationPollSeconds * 1000);
        $this->SetTimerInterval('ControlTimer', 15 * 1000);
        $this->DebugLog('ApplyChanges', 'Debug=' . ($this->ReadPropertyBoolean('DebugMode') ? 'AN' : 'AUS') . ' | Timer Preise=' . $refresh . ' min | PV-Prognose=' . $pvForecastRefresh . ' min | PV-Ist=' . $pvActualRefresh . ' min | Steuerprüfung=15 s');

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

        // Externe API-Abfragen dürfen ApplyChanges nicht blockieren.
        // Beim Umschalten des Debug-Modus wird nur ein kurzer One-Shot-Timer
        // gestartet. Der Neuaufbau erfolgt direkt danach außerhalb von ApplyChanges.
        if ($debugModeChanged) {
            if ($debugMode) {
                $this->DebugLog('ApplyChanges', 'Debug-Modus geändert -> asynchroner Neuaufbau wird gestartet.');
            }
            $this->SetTimerInterval('DeferredDebugRebuildTimer', 250);
        }
    }

    public function DeferredDebugRebuild()
    {
        // One-Shot-Timer sofort stoppen.
        $this->SetTimerInterval('DeferredDebugRebuildTimer', 0);

        try {
            $this->DebugLog('Debug-Rebuild', 'Asynchroner Neuaufbau gestartet.');

            // Zuerst mit bereits gespeicherten Daten neu rendern. Damit erscheinen
            // bzw. verschwinden Debug-Serien ohne auf externe APIs warten zu müssen.
            $forecast = json_decode($this->ReadAttributeString('ForecastJSON'), true);
            $prices = json_decode($this->ReadAttributeString('PricesJSON'), true);
            $plan = json_decode($this->ReadAttributeString('PlanJSON'), true);

            if (is_array($forecast) && !empty($forecast)) {
                SetValue($this->GetIDForIdent('PVForecastChartHTML'), $this->RenderPVForecastChartHTML($forecast));
                SetValue($this->GetIDForIdent('ForecastSolarStatus'), $this->RenderProviderForecastStatusHTML($forecast));
                SetValue($this->GetIDForIdent('PVCalibrationDiagnosisHTML'), $this->RenderPVCalibrationDiagnosisHTML($forecast));

                if (is_array($prices) && is_array($plan) && !empty($plan)) {
                    $nightId = $this->GetIDForIdent('NightConsumptionForecast');
                    $night = $nightId > 0 ? (float)GetValue($nightId) : 0.0;
                    SetValue($this->GetIDForIdent('OverviewHTML'), $this->RenderOverviewHTML($forecast, $plan, $night));
                    SetValue($this->GetIDForIdent('PriceChartHTML'), $this->RenderPriceChartHTML($forecast, $prices, $plan));
                    SetValue($this->GetIDForIdent('PlanHTML'), $this->RenderPlanHTML($forecast, $prices, $plan));
                }
            }

            // Vollständige Aktualisierung inklusive Anbieterabfragen läuft danach
            // im Timer-Kontext und blockiert den Übernehmen-Dialog nicht.
            $this->RecalculateInternal(true);
        } catch (Throwable $e) {
            $this->DebugLog('Debug-Rebuild', $e->getMessage(), 0);
        }
        // Nach Installation bzw. einem Modulupdate einmal vollständig aktualisieren.
        // Normales "Übernehmen" ohne Versionswechsel startet keinen zusätzlichen Vollrefresh.
        $currentModuleVersion = '1.9.81';
        if ($this->ReadAttributeString('AppliedModuleVersion') !== $currentModuleVersion) {
            $this->WriteAttributeString('AppliedModuleVersion', $currentModuleVersion);
            $this->SetActionFeedback('Modulupdate erkannt – Anzeigen und Diagramme werden aktualisiert ...');
            $this->SetTimerInterval('FullRefreshWorker', 1500);
        }

    }

    public function ExportStoredData(): string
    {
        $stringAttributes = [
            'ForecastJSON','PVForecastHistoryJSON','PVSourceForecastHistoryJSON','ForecastSolarSurfaceCacheJSON',
            'PVDebugVisibilityJSON','ProviderDebugLogJSON','ActionHistoryJSON','AppliedModuleVersion','PVSourceWeightsJSON','PVNodeLastError',
            'PVCalibrationJSON','PVCalibrationCurtailmentSamplesJSON','PVCalibrationExcludedPeriodsJSON','PVCalibrationExclusionActiveReason','PVCalibrationCleanupStatus','PricesJSON','PlanJSON','NightLearningSource',
            'ConsumptionProfileJSON','ConsumptionLearningSource','AlphaDispatchCommandKey','ActiveFeedInPlanKey',
            'CompletedFeedInPlanKeysJSON','FeedInStatisticsJSON','ActiveFeedInReason','AlphaTestTrace','ArchiveStorageStatus'
        ];
        $integerAttributes = [
            'ForecastSolarRetryAfterTs','PVSourceWeightLearningResetTs','PVNodeConsecutiveRejects','PVCalibrationEnergyVersion',
            'PVCalibrationBelowThresholdSince','PVCalibrationAboveThresholdSince','PVCalibrationAboveThresholdCount',
            'PVCalibrationBlockedFromTs','PVCalibrationExclusionActiveFromTs','NightSampleCount','ConsumptionProfileUpdated','ActiveFeedInLastTs','ManualTestUntil',
            'ManualTestPowerW','AlphaTestStage','AlphaTestNextTs','ActiveFeedInLastAdjustmentTs','ActiveFeedInPlannedEndTs','ActiveFeedInStartedTs','FeedInFactorVariableLastID','ArchiveStorageMigrationVersion'
        ];
        $floatAttributes = ['LearnedNightKWh','ActiveFeedInTargetKWh','ActiveFeedInDeliveredKWh','ActiveFeedInLastExportW','ActiveFeedInPriceCt','FeedInFactorOriginalValue'];
        $booleanAttributes = ['PVNodeAutoDisabled','LastAppliedDebugMode','PVCalibrationCurtailmentLatched','AlphaDispatchActive','RuntimePVSettingsInitialized','FeedInPriceLockActive','FeedInFactorOriginalValid'];

        $attributes = [];
        foreach ($stringAttributes as $name) $attributes[$name] = $this->ReadAttributeString($name);
        foreach ($integerAttributes as $name) $attributes[$name] = $this->ReadAttributeInteger($name);
        foreach ($floatAttributes as $name) $attributes[$name] = $this->ReadAttributeFloat($name);
        foreach ($booleanAttributes as $name) $attributes[$name] = $this->ReadAttributeBoolean($name);

        // Zusätzlich alle aktuellen Modulvariablen sichern. Die historischen Rohdaten aus dem
        // IP-Symcon Archiv bleiben im Archiv und werden nicht nochmals in diese Datei kopiert.
        $variables = [];
        foreach (IPS_GetChildrenIDs($this->InstanceID) as $childID) {
            $object = @IPS_GetObject($childID);
            if (!is_array($object) || (int)($object['ObjectType'] ?? -1) !== 2) continue;
            $variable = @IPS_GetVariable($childID);
            if (!is_array($variable)) continue;
            $ident = (string)($object['ObjectIdent'] ?? '');
            if ($ident === '') continue;
            $variables[$ident] = [
                'id' => $childID,
                'name' => (string)($object['ObjectName'] ?? ''),
                'type' => (int)($variable['VariableType'] ?? -1),
                'value' => GetValue($childID)
            ];
        }

        // Konfiguration als Referenz mitsichern, Zugangsdaten aber bewusst nicht exportieren.
        $configuration = json_decode(IPS_GetConfiguration($this->InstanceID), true);
        if (!is_array($configuration)) $configuration = [];
        foreach (['ForecastSolarAPIKey','PVNodeAPIKey'] as $secretKey) {
            if (array_key_exists($secretKey, $configuration)) $configuration[$secretKey] = '__NICHT_EXPORTIERT__';
        }

        $payload = [
            'format' => 'SmartBatteryOptimizer-DataExport',
            'formatVersion' => 1,
            'moduleVersion' => '1.9.81',
            'instanceID' => $this->InstanceID,
            'exportedAt' => date('c'),
            'configurationWithoutSecrets' => $configuration,
            'attributes' => $attributes,
            'variables' => $variables,
            'note' => 'Historische Rohwerte der referenzierten IP-Symcon Variablen liegen weiterhin im IP-Symcon Archiv und sind nicht dupliziert.'
        ];

        $dir = rtrim(IPS_GetKernelDir(), '/\\') . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'SmartBatteryOptimizer';
        if (!is_dir($dir) && !@mkdir($dir, 0775, true) && !is_dir($dir)) {
            throw new Exception('Exportordner konnte nicht erstellt werden: ' . $dir);
        }
        $file = $dir . DIRECTORY_SEPARATOR . 'SmartBatteryOptimizer_Data_' . $this->InstanceID . '_' . date('Y-m-d_H-i-s') . '.json';
        $json = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json === false || @file_put_contents($file, $json) === false) {
            throw new Exception('Exportdatei konnte nicht geschrieben werden: ' . $file);
        }
        $size = filesize($file);
        $message = 'Export erstellt: ' . $file . ' (' . number_format((float)$size / 1024.0, 1, ',', '.') . ' KB)';
        SetValue($this->GetIDForIdent('DataExportStatus'), $message);
        $this->DebugLog('Datenexport', $message);
        return $message;
    }

    public function RequestAction($Ident, $Value)
    {
        $this->DebugLog('RequestAction', $Ident . ' = ' . json_encode($Value));
        switch ($Ident) {
            case 'TestDischargePowerW':
                $testPower = max(0, min((int)$Value, $this->ReadPropertyInteger('MaxDischargePowerW')));
                SetValue($this->GetIDForIdent('TestDischargePowerW'), $testPower);
                break;
            case 'TestDischarge':
                if ((bool)$Value) {
                    $priceLock = $this->UpdateFeedInPriceLock();
                    if (!empty($priceLock['blocked'])) {
                        SetValue($this->GetIDForIdent('TestDischarge'), false);
                        SetValue($this->GetIDForIdent('TestDischargeStatus'), 'Test nicht gestartet: Mindestpreis Einspeisung unterschritten.');
                        break;
                    }
                    $socVar = $this->ReadPropertyInteger('SOCVariable');
                    $soc = ($socVar > 0 && @IPS_VariableExists($socVar)) ? (float)GetValue($socVar) : 0.0;
                    if ($soc <= $this->GetRuntimeMinimumSOC()) {
                        SetValue($this->GetIDForIdent('TestDischarge'), false);
                        SetValue($this->GetIDForIdent('TestDischargeStatus'), 'Test nicht gestartet: SoC liegt am/unter Mindest-SoC.');
                        break;
                    }
                    $testPower = max(0, min((int)GetValue($this->GetIDForIdent('TestDischargePowerW')), $this->ReadPropertyInteger('MaxDischargePowerW')));
                    if ($testPower <= 0) {
                        SetValue($this->GetIDForIdent('TestDischarge'), false);
                        SetValue($this->GetIDForIdent('TestDischargeStatus'), 'Test nicht gestartet: Testleistung ist 0 W.');
                        break;
                    }
                    $until = time() + 120;
                    $this->WriteAttributeInteger('ManualTestUntil', $until);
                    $this->WriteAttributeInteger('ManualTestPowerW', $testPower);
                    SetValue($this->GetIDForIdent('TestDischarge'), true);
                    SetValue($this->GetIDForIdent('TestDischargeStatus'), 'Test aktiv: ' . $testPower . ' W bis ' . date('H:i:s', $until));
                    try {
                        $ids = $this->GetAlphaDispatchIDs();
                        $testSocRaw = (int)round(max(0.0, min(100.0, $this->GetRuntimeMinimumSOC())) / 0.4);
                        SetValue(
                            $this->GetIDForIdent('TestDischargeStatus'),
                            'AlphaESS Einspeisetest: Power=' . (32000 + $testPower)
                            . ' | Mode=2'
                            . ' | SOC=' . $testSocRaw
                            . ' | Time=120'
                            . ' | Start=1'
                            . ' | IDs ' . $ids['power'] . '/' . $ids['mode'] . '/' . $ids['soc'] . '/' . $ids['time'] . '/' . $ids['start']
                        );
                        $this->DebugLog(
                            'TestEntladung',
                            'Direkter AlphaESS-Test (BatteryControlMode wird umgangen)'
                            . ' | Start=' . $ids['start']
                            . ' | Power=' . $ids['power']
                            . ' | Mode=' . $ids['mode']
                            . ' | SOC=' . $ids['soc']
                            . ' | Time=' . $ids['time']
                            . ' | Soll=' . $testPower . ' W'
                        );
                        $this->StartAlphaESSDiagnosticTest($testPower);
                    } catch (Throwable $e) {
                        $this->WriteAttributeInteger('ManualTestUntil', 0);
                        SetValue($this->GetIDForIdent('TestDischarge'), false);
                        SetValue($this->GetIDForIdent('TestDischargeStatus'), 'Test fehlgeschlagen: ' . $e->getMessage());
                        $this->DebugLog('TestEntladung', 'FEHLER: ' . $e->getMessage());
                    }
                } else {
                    $this->WriteAttributeInteger('ManualTestUntil', 0);
                    $this->WriteAttributeInteger('ManualTestPowerW', 0);
                    $this->WriteAttributeInteger('AlphaTestStage', 0);
                    $this->WriteAttributeInteger('AlphaTestNextTs', 0);
                    SetValue($this->GetIDForIdent('TestDischarge'), false);
                    try {
                        $this->SetAlphaESSDispatch(false, 0, 0);
                        SetValue($this->GetIDForIdent('FeedInActive'), false);
                        SetValue($this->GetIDForIdent('PlannedPower'), 0.0);
                    } catch (Throwable $e) {
                        $this->DebugLog('TestEntladung', 'Stop-Fehler: ' . $e->getMessage());
                    }
                    SetValue($this->GetIDForIdent('TestDischargeStatus'), 'Direkter AlphaESS-Test gestoppt.');
                }
                break;
            case 'PVCurtailmentProtectionEnabled':
                SetValue($this->GetIDForIdent($Ident), (bool)$Value);
                $this->RecalculateInternal(false);
                break;
            case 'RuntimeGridFeedInLimitW':
                SetValue($this->GetIDForIdent($Ident), max(0, (int)$Value));
                $this->RecalculateInternal(false);
                break;
            case 'RuntimeGridLimitSafetyW':
                SetValue($this->GetIDForIdent($Ident), max(0, (int)$Value));
                $this->RecalculateInternal(false);
                break;
            case 'RuntimeMaxBatteryChargePowerW':
                SetValue($this->GetIDForIdent($Ident), max(0, (int)$Value));
                $this->RecalculateInternal(false);
                break;
            case 'RuntimePVHeadroomTargetSOC':
            case 'RuntimePVStorageSharePct':
                SetValue($this->GetIDForIdent($Ident), max(0.0, min(100.0, (float)$Value)));
                $this->RecalculateInternal(false);
                break;
            case 'RuntimePVSpaceMinimumPriceCt':
                SetValue($this->GetIDForIdent($Ident), (float)$Value);
                $this->UpdateFeedInPriceLock();
                $this->RecalculateInternal(false);
                break;
            case 'RuntimeMinimumSOC':
                SetValue($this->GetIDForIdent($Ident), max(0.0, min(100.0, (float)$Value)));
                $this->RecalculateInternal(false);
                break;
            case 'PVDebugVisibilityState':
                $state = json_decode((string)$Value, true);
                if (is_array($state)) {
                    $clean = [];
                    foreach ($state as $key => $visible) {
                        $clean[(string)$key] = (bool)$visible;
                    }
                    $json = json_encode($clean);
                    $this->WriteAttributeString('PVDebugVisibilityJSON', $json);
                    SetValue($this->GetIDForIdent('PVDebugVisibilityState'), $json);
                }
                break;
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

    private function GetRuntimeBoolean(string $ident, bool $fallback): bool
    {
        $id = @$this->GetIDForIdent($ident);
        return $id > 0 ? (bool)GetValue($id) : $fallback;
    }

    private function GetRuntimeInteger(string $ident, int $fallback): int
    {
        $id = @$this->GetIDForIdent($ident);
        return $id > 0 ? (int)GetValue($id) : $fallback;
    }

    private function GetRuntimeFloat(string $ident, float $fallback): float
    {
        $id = @$this->GetIDForIdent($ident);
        return $id > 0 ? (float)GetValue($id) : $fallback;
    }

    private function GetMinimumFeedInPriceCt(): float
    {
        return $this->GetRuntimeFloat('RuntimePVSpaceMinimumPriceCt', $this->ReadPropertyFloat('PVSpaceMinimumPriceCt'));
    }

    private function WriteFeedInFactorVariable(int $variableID, float $value): void
    {
        $variable = @IPS_GetVariable($variableID);
        $type = is_array($variable) ? (int)($variable['VariableType'] ?? -1) : -1;
        if ($type === 1) {
            $this->WriteVariableSmart($variableID, (int)round($value));
            return;
        }
        if ($type === 2) {
            $this->WriteVariableSmart($variableID, $value);
            return;
        }
        throw new Exception('Einspeisefaktor-Variable muss Integer oder Float sein.');
    }

    private function InitializeFeedInFactorMemory(): void
    {
        $variableID = $this->ReadPropertyInteger('FeedInFactorVariable');
        $lastID = $this->ReadAttributeInteger('FeedInFactorVariableLastID');

        if ($lastID !== $variableID) {
            // Wurde die Zielvariable gewechselt, einen eventuell noch gesperrten alten Wert
            // nach Möglichkeit wiederherstellen, bevor die neue Variable übernommen wird.
            if ($lastID > 0 && $this->ReadAttributeBoolean('FeedInPriceLockActive') && $this->ReadAttributeBoolean('FeedInFactorOriginalValid') && @IPS_VariableExists($lastID)) {
                try { $this->WriteFeedInFactorVariable($lastID, $this->ReadAttributeFloat('FeedInFactorOriginalValue')); } catch (Throwable $e) {}
            }
            $this->WriteAttributeBoolean('FeedInPriceLockActive', false);
            $this->WriteAttributeBoolean('FeedInFactorOriginalValid', false);
            $this->WriteAttributeInteger('FeedInFactorVariableLastID', $variableID);
        }

        if ($variableID > 0 && @IPS_VariableExists($variableID) && !$this->ReadAttributeBoolean('FeedInPriceLockActive')) {
            $variable = @IPS_GetVariable($variableID);
            $type = is_array($variable) ? (int)($variable['VariableType'] ?? -1) : -1;
            if ($type === 1 || $type === 2) {
                $value = (float)GetValue($variableID);
                $this->WriteAttributeFloat('FeedInFactorOriginalValue', $value);
                $this->WriteAttributeBoolean('FeedInFactorOriginalValid', true);
            }
        }
    }

    private function GetFeedInPriceLockInfo(?int $timestamp = null): array
    {
        $now = $timestamp ?? time();
        $threshold = $this->GetMinimumFeedInPriceCt();
        $prices = json_decode($this->ReadAttributeString('PricesJSON'), true);
        if (!is_array($prices)) $prices = [];
        usort($prices, static fn($a, $b) => ((int)($a['start'] ?? 0)) <=> ((int)($b['start'] ?? 0)));

        $current = null;
        foreach ($prices as $p) {
            $start = (int)($p['start'] ?? 0);
            $end = (int)($p['end'] ?? 0);
            if ($start <= $now && $now < $end) { $current = $p; break; }
        }

        $known = is_array($current);
        $priceCt = $known ? (float)($current['priceCt'] ?? 0.0) : null;
        $blocked = $known && $priceCt < $threshold;
        $blockedUntil = 0;
        $nextBlockedStart = 0;
        $nextBlockedEnd = 0;

        if ($blocked) {
            $blockedUntil = (int)($current['end'] ?? 0);
            foreach ($prices as $p) {
                $start = (int)($p['start'] ?? 0);
                $end = (int)($p['end'] ?? 0);
                if ($start < $blockedUntil - 1) continue;
                if ($start > $blockedUntil + 1) break;
                if ((float)($p['priceCt'] ?? 0.0) < $threshold) $blockedUntil = max($blockedUntil, $end);
                else break;
            }
        } else {
            foreach ($prices as $i => $p) {
                $start = (int)($p['start'] ?? 0);
                $end = (int)($p['end'] ?? 0);
                if ($end <= $now || (float)($p['priceCt'] ?? 0.0) >= $threshold) continue;
                $nextBlockedStart = max($now, $start);
                $nextBlockedEnd = $end;
                for ($j = $i + 1; $j < count($prices); $j++) {
                    $n = $prices[$j];
                    $ns = (int)($n['start'] ?? 0);
                    $ne = (int)($n['end'] ?? 0);
                    if ($ns > $nextBlockedEnd + 1) break;
                    if ((float)($n['priceCt'] ?? 0.0) < $threshold) $nextBlockedEnd = max($nextBlockedEnd, $ne);
                    else break;
                }
                break;
            }
        }

        return [
            'known'=>$known, 'blocked'=>$blocked, 'priceCt'=>$priceCt, 'thresholdCt'=>$threshold,
            'blockedUntil'=>$blockedUntil, 'nextBlockedStart'=>$nextBlockedStart, 'nextBlockedEnd'=>$nextBlockedEnd
        ];
    }

    private function UpdateFeedInPriceLock(): array
    {
        $info = $this->GetFeedInPriceLockInfo();
        $variableID = $this->ReadPropertyInteger('FeedInFactorVariable');
        $factorConfigured = $variableID > 0 && @IPS_VariableExists($variableID);
        $factorValid = false;
        if ($factorConfigured) {
            $variable = @IPS_GetVariable($variableID);
            $type = is_array($variable) ? (int)($variable['VariableType'] ?? -1) : -1;
            $factorValid = ($type === 1 || $type === 2);
        }

        if (!$info['known']) {
            $factorText = !$factorConfigured ? 'Einspeisefaktor-Variable nicht konfiguriert'
                : (!$factorValid ? 'Einspeisefaktor-Variable ist nicht numerisch'
                : 'Einspeisefaktor ' . number_format((float)GetValue($variableID), 1, ',', '.') . ' %'
                    . ($this->ReadAttributeBoolean('FeedInFactorOriginalValid') ? ' (Rückstellwert ' . number_format($this->ReadAttributeFloat('FeedInFactorOriginalValue'), 1, ',', '.') . ' %)' : ''));
            $status = 'Keine aktuelle Preisperiode verfügbar | Mindestpreis ' . number_format($info['thresholdCt'], 2, ',', '.') . ' ct/kWh | ' . $factorText;
            $statusID = @$this->GetIDForIdent('FeedInPriceLockStatus');
            if ($statusID > 0) SetValue($statusID, $status);
            return $info;
        }

        if (!empty($info['blocked'])) {
            if ($factorValid) {
                if (!$this->ReadAttributeBoolean('FeedInPriceLockActive')) {
                    $this->WriteAttributeFloat('FeedInFactorOriginalValue', (float)GetValue($variableID));
                    $this->WriteAttributeBoolean('FeedInFactorOriginalValid', true);
                }
                $this->StartPVCalibrationExclusion('Mindestpreis Einspeisung – Einspeisefaktor 0 %', time());
                if (abs((float)GetValue($variableID)) > 0.0001) {
                    $this->WriteFeedInFactorVariable($variableID, 0.0);
                }
            }
            $this->WriteAttributeBoolean('FeedInPriceLockActive', true);
        } else {
            if ($this->ReadAttributeBoolean('FeedInPriceLockActive')) {
                if ($factorValid && $this->ReadAttributeBoolean('FeedInFactorOriginalValid')) {
                    $this->WriteFeedInFactorVariable($variableID, $this->ReadAttributeFloat('FeedInFactorOriginalValue'));
                }
                $this->WriteAttributeBoolean('FeedInPriceLockActive', false);
                $this->FinishPVCalibrationExclusion(time());
            }
            // Außerhalb einer Preissperre folgt der gespeicherte Rückstellwert einer
            // manuellen Änderung des Einspeisefaktors automatisch.
            if ($factorValid) {
                $this->WriteAttributeFloat('FeedInFactorOriginalValue', (float)GetValue($variableID));
                $this->WriteAttributeBoolean('FeedInFactorOriginalValid', true);
            }
        }

        $factorText = !$factorConfigured ? 'Einspeisefaktor-Variable nicht konfiguriert'
            : (!$factorValid ? 'Einspeisefaktor-Variable ist nicht numerisch'
            : 'Einspeisefaktor ' . number_format((float)GetValue($variableID), 1, ',', '.') . ' %'
                . ($this->ReadAttributeBoolean('FeedInFactorOriginalValid') ? ' (Rückstellwert ' . number_format($this->ReadAttributeFloat('FeedInFactorOriginalValue'), 1, ',', '.') . ' %)' : ''));

        if ($info['blocked']) {
            $status = 'GESPERRT: ' . number_format((float)$info['priceCt'], 2, ',', '.') . ' < ' . number_format($info['thresholdCt'], 2, ',', '.') . ' ct/kWh'
                . ($info['blockedUntil'] > 0 ? ' | bis ' . date('d.m. H:i', $info['blockedUntil']) : '') . ' | ' . $factorText;
        } else {
            $status = 'Einspeisung erlaubt: ' . number_format((float)$info['priceCt'], 2, ',', '.') . ' ≥ ' . number_format($info['thresholdCt'], 2, ',', '.') . ' ct/kWh';
            if ($info['nextBlockedStart'] > 0) $status .= ' | nächste Preissperre ' . date('d.m. H:i', $info['nextBlockedStart']) . '–' . date('H:i', $info['nextBlockedEnd']);
            $status .= ' | ' . $factorText;
        }
        $statusID = @$this->GetIDForIdent('FeedInPriceLockStatus');
        if ($statusID > 0) SetValue($statusID, $status);
        return $info;
    }

    private function DebugLog(string $area, $message, int $format = 0): void
    {
        if (!$this->ReadPropertyBoolean('DebugMode')) return;
        if (is_array($message) || is_object($message)) {
            $encoded = json_encode($message, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE);
            $message = $encoded === false ? 'JSON-Darstellung fehlgeschlagen' : $encoded;
        }
        $this->SendDebug($area, (string)$message, 0);
    }

    private function SourceDisplayName(string $source): string
    {
        switch ($source) {
            case 'openmeteo': return 'Open-Meteo';
            case 'forecastsolar': return 'Forecast.Solar';
            case 'pvnode': return 'pvnode';
            default: return $source;
        }
    }

    private function IsAutomaticEnabled(): bool
    {
        $id = @$this->GetIDForIdent('AutomaticEnabled');
        return $id > 0 ? (bool)GetValue($id) : false;
    }

    private function SetActionFeedback(string $text): void
    {
        $entries = json_decode($this->ReadAttributeString('ActionHistoryJSON'), true);
        if (!is_array($entries)) $entries = [];
        $entries[] = ['time' => time(), 'text' => $text];
        if (count($entries) > 5) $entries = array_slice($entries, -5);
        $this->WriteAttributeString('ActionHistoryJSON', json_encode($entries));
        SetValue($this->GetIDForIdent('ActionFeedback'), $this->RenderActionHistoryHTML($entries));
        $this->DebugLog('Manuelle Aktion', $text);
    }

    private function RenderPersistentDetailsHTML(string $storageKey, string $title, string $body, string $subtitle = ''): string
    {
        $id = 'sbo_details_' . md5($storageKey . '_' . $this->InstanceID);
        $html = '<div style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;color:#fff;background:#181818;padding:8px">';
        $html .= '<details id="' . $id . '"><summary style="cursor:pointer;font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:14px;font-weight:bold;padding:4px 0">' . htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</summary>';
        if ($subtitle !== '') $html .= '<div style="font-size:11px;opacity:.75;margin:2px 0 6px">' . htmlspecialchars($subtitle, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</div>';
        $html .= $body . '</details>';
        $html .= '<script>(function(){var d=document.getElementById(' . json_encode($id) . '),k=' . json_encode($storageKey . '_' . $this->InstanceID) . ';if(!d)return;try{var v=localStorage.getItem(k);d.open=(v===null)?true:(v==="1");}catch(e){d.open=true;}d.addEventListener("toggle",function(){try{localStorage.setItem(k,d.open?"1":"0");}catch(e){}});})();</script></div>';
        return $html;
    }

    private function RenderActionHistoryHTML(array $entries): string
    {
        $e = static function ($v): string { return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); };
        $body = '<div style="border-top:1px solid #555;margin-top:4px">';
        if (!$entries) $body .= '<div style="padding:6px 0;opacity:.7">Noch keine Aktion.</div>';
        foreach (array_reverse($entries) as $row) {
            $body .= '<div style="padding:5px 2px;border-bottom:1px solid #333"><b>' . $e(date('d.m.Y H:i:s', (int)($row['time'] ?? 0))) . '</b> &nbsp; ' . $e($row['text'] ?? '') . '</div>';
        }
        $body .= '</div>';
        return $this->RenderPersistentDetailsHTML('sbo_action_history', 'Letzte Aktionen', $body, 'Neueste Aktion oben · letzte 5 Einträge');
    }

    public function RefreshAll()
    {
        $this->SetActionFeedback('Alles aktualisieren: Auftrag angenommen ...');
        $this->SetTimerInterval('FullRefreshWorker', 1000);
        echo "Aktualisierung aller Anzeigen und Diagramme wurde gestartet. Der Fortschritt steht in „Letzte manuelle Aktion“.";
    }

    public function RunFullRefresh()
    {
        $this->SetTimerInterval('FullRefreshWorker', 0);
        $this->SetActionFeedback('Alles aktualisieren: Anzeigen, Prognosen und Diagramme werden aktualisiert ...');
        try {
            // Bewusst KEIN erneutes Lernen aus dem Archiv. Vorhandene Lernwerte und
            // Verbrauchsprofile bleiben unverändert. RecalculateInternal(true) holt
            // nur die aktuellen externen Daten/Preise, berechnet die aktuelle Planung
            // und rendert alle davon abhängigen Werte, HTMLBoxen und Highcharts neu.
            $this->RecalculateInternal(true);

            $status = (string)GetValue($this->GetIDForIdent('StatusText'));
            $this->SetActionFeedback('Alle Anzeigen und Diagramme aktualisiert. ' . $status);
        } catch (Throwable $e) {
            $text = 'Alles aktualisieren FEHLER: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
        }
    }

    public function Recalculate()
    {
        $this->SetActionFeedback('Prognose & Plan: Auftrag angenommen – Berechnung startet ...');
        $this->SetTimerInterval('ManualRecalculateWorker', 1000);
        echo "Berechnung wurde gestartet. Der Fortschritt steht in „Letzte manuelle Aktion“.";
    }

    public function RunManualRecalculate()
    {
        $this->SetTimerInterval('ManualRecalculateWorker', 0);
        $this->SetActionFeedback('Prognose & Plan: Berechnung läuft – Prognosequellen werden abgefragt ...');
        try {
            $this->RecalculateInternal(true);
            $status = (string)GetValue($this->GetIDForIdent('StatusText'));
            $this->SetActionFeedback('Prognose & Plan fertig. ' . $status);
        } catch (Throwable $e) {
            $text = 'Prognose & Plan FEHLER: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
        }
    }

    public function RefreshOptimization()
    {
        $this->RecalculateInternal(false);
    }

    public function RefreshPVActual()
    {
        // PV-Ist und Planung aktualisieren, die gespeicherte PV-Prognose verwenden.
        // Die Prognose besitzt wieder ihr eigenes konfigurierbares Intervall.
        $this->DebugLog('PVActual', 'PV-Ist + Planung aktualisieren; gespeicherte PV-Prognose verwenden');
        $this->RecalculateInternal(false);

        // Diagramme bewusst nochmals direkt aus Archiv + gespeichertem Forecast/Profile
        // aufbauen. Dadurch werden die Istwerte auch dann im konfigurierten
        // PV-Ist-Intervall aktualisiert, wenn ein paralleler Rechenlauf durch die
        // Berechnungssperre uebersprungen wurde.
        try {
            $forecast = json_decode($this->ReadAttributeString('ForecastJSON'), true);
            if (is_array($forecast) && !empty($forecast)) {
                SetValue($this->GetIDForIdent('PVForecastChartHTML'), $this->RenderPVForecastChartHTML($forecast));
            }
            $profile = json_decode($this->ReadAttributeString('ConsumptionProfileJSON'), true);
            if (is_array($profile) && !empty($profile)) {
                SetValue($this->GetIDForIdent('ConsumptionProfileChartHTML'), $this->RenderConsumptionProfileChartHTML($profile));
                SetValue($this->GetIDForIdent('FeedInStatisticsHTML'), $this->RenderFeedInStatisticsHTML());
                SetValue($this->GetIDForIdent('FeedInDebugHTML'), $this->RenderFeedInDebugHTML());
            }
        } catch (Throwable $e) {
            $this->DebugLog('PVActual', 'Diagramm-Istwerte konnten nicht aktualisiert werden: ' . $e->getMessage(), 0);
        }
    }

    private function UpdatePVCalibrationState(bool $renderDiagnosis = true): void
    {
        $nowLock = time();
        $lockUntil = $this->ReadAttributeInteger('PVCalibrationLockUntil');
        if ($lockUntil > $nowLock) {
            $this->ForecastDiagnosticStep('05 PV-Kalibrierung übersprungen | anderer Lauf aktiv');
            return;
        }
        $this->WriteAttributeInteger('PVCalibrationLockUntil', $nowLock + 300);
        try {
        $this->ForecastDiagnosticStep('05.01 PV-Kalibrierung ForecastJSON lesen START');
        $forecast = json_decode($this->ReadAttributeString('ForecastJSON'), true);
        if (!is_array($forecast)) $forecast = [];
        $this->ForecastDiagnosticStep('05.02 PV-Kalibrierung ForecastJSON lesen ENDE');

        $this->ForecastDiagnosticStep('05.03 PV-Kalibrierung PVCalibrationJSON lesen START');
        $calibration = json_decode($this->ReadAttributeString('PVCalibrationJSON'), true);
        if (!is_array($calibration)) $calibration = [];
        if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') >= 1) {
            $calibration = $this->BuildPVCalibrationFromArchive($calibration);
        }
        $this->ForecastDiagnosticStep('05.04 PV-Kalibrierung Datenspeicher lesen ENDE | Modus=' . ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') >= 1 ? 'IP-Symcon Archiv' : 'JSON') . ' | Oberflächen=' . count($calibration));

        $this->ForecastDiagnosticStep('05.05 PV-Kalibrierung PVSurfaces lesen START');
        $surfaces = json_decode($this->ReadPropertyString('PVSurfaces'), true);
        if (!is_array($surfaces)) $surfaces = [];
        $this->ForecastDiagnosticStep('05.06 PV-Kalibrierung PVSurfaces lesen ENDE | Anzahl=' . count($surfaces));

        $this->ForecastDiagnosticStep('05.07 Feed-In-Gate START');
        $gate = $this->GetPVCalibrationFeedInGate();
        $this->ForecastDiagnosticStep('05.08 Feed-In-Gate ENDE | blockiert=' . (!empty($gate['blocked']) ? 'ja' : 'nein'));
        $surfaceCalibration = is_array($forecast['surfaceCalibration'] ?? null) ? $forecast['surfaceCalibration'] : [];

        foreach ($surfaces as $idx => $surface) {
            if (empty($surface['Active']) || empty($surface['AutoCalibrate'])) continue;
            $name = trim((string)($surface['Name'] ?? 'PV'));
            if ($name === '') $name = 'PV ' . ($idx + 1);
            $key = $this->SurfaceKey($name, $idx);
            $calibration = $this->CompactPVCalibrationData($calibration, $key);
            $prefix = '05.S' . ($idx + 1) . ' ' . $name . ' | ';

            $this->ForecastDiagnosticStep($prefix . 'Istleistung lesen START');
            $actualW = $this->ReadSurfaceActualPower($surface);
            $this->ForecastDiagnosticStep($prefix . 'Istleistung lesen ENDE | W=' . ($actualW === null ? 'n/a' : round($actualW, 1)));
            $expectedW = isset($surfaceCalibration[$name]['expectedBaseW'])
                ? (float)$surfaceCalibration[$name]['expectedBaseW'] : 0.0;

            // Prognose-kWh werden ausschließlich beim Erzeugen der Stundenprognose
            // archiviert. Der Kalibrier-Timer schreibt bewusst keine Prognosewerte mehr.

            if ($gate['blocked']) {
                if (isset($calibration[$key])) {
                    $blockedFromTs = (int)($gate['blockedFromTs'] ?? time());
                    $this->ForecastDiagnosticStep($prefix . 'Sperrbereich entfernen START');
                    $calibration = $this->InvalidatePVCalibrationFrom($calibration, $key, max(0, $blockedFromTs));
                    $this->ForecastDiagnosticStep($prefix . 'Sperrbereich entfernen ENDE');
                }
            } elseif ($actualW !== null && $expectedW >= $this->ReadPropertyInteger('PVCalibrationMinExpectedW')) {
                $sampleCountBefore = isset($calibration[$key]['energySamples']) && is_array($calibration[$key]['energySamples']) ? count($calibration[$key]['energySamples']) : 0;
                $this->ForecastDiagnosticStep($prefix . 'Energiesample START | Samples=' . $sampleCountBefore);
                $calibration = $this->AddPVCalibrationEnergySample($calibration, $key, $expectedW, $actualW);
                $sampleCountAfter = isset($calibration[$key]['energySamples']) && is_array($calibration[$key]['energySamples']) ? count($calibration[$key]['energySamples']) : 0;
                $this->ForecastDiagnosticStep($prefix . 'Energiesample ENDE | Samples=' . $sampleCountAfter);
            }

            $this->ForecastDiagnosticStep($prefix . 'Diagnose berechnen START');
            $diag = $this->GetPVCalibrationDiagnostics($calibration, $key);
            $this->ForecastDiagnosticStep($prefix . 'Diagnose berechnen ENDE | Samples=' . (int)($diag['sampleCount'] ?? 0));
            if (!isset($surfaceCalibration[$name]) || !is_array($surfaceCalibration[$name])) $surfaceCalibration[$name] = [];
            $surfaceCalibration[$name]['autoFactor'] = !empty($diag['factorReady'])
                ? max($this->ReadPropertyFloat('PVCalibrationMinFactor'), min($this->ReadPropertyFloat('PVCalibrationMaxFactor'), (float)($diag['learnedRatio'] ?? $diag['ratio'] ?? 1.0)))
                : 1.0;
            $surfaceCalibration[$name]['sumExpectedKWh'] = (float)($diag['sumExpectedKWh'] ?? 0.0);
            $surfaceCalibration[$name]['sumActualKWh'] = (float)($diag['sumActualKWh'] ?? 0.0);
            $surfaceCalibration[$name]['learnedRatio'] = $diag['ratio'] ?? null;
            $surfaceCalibration[$name]['calculatedFactor'] = $diag['ratio'] ?? null;
            $surfaceCalibration[$name]['sampleCount'] = (int)($diag['sampleCount'] ?? 0);
            $surfaceCalibration[$name]['factorReady'] = !empty($diag['factorReady']);
            $surfaceCalibration[$name]['learningDayCount'] = (int)($diag['learningDayCount'] ?? 0);
            $surfaceCalibration[$name]['firstSampleTs'] = (int)($diag['firstSampleTs'] ?? 0);
            $surfaceCalibration[$name]['lastSampleTs'] = (int)($diag['lastSampleTs'] ?? 0);
            $surfaceCalibration[$name]['calibrationBlocked'] = (bool)$gate['blocked'];
            $surfaceCalibration[$name]['calibrationBlockReason'] = (string)($gate['text'] ?? '');
            $surfaceCalibration[$name]['seasonalFactor'] = !empty($diag['factorReady']) ? (float)($calibration[$key]['factor'] ?? 1.0) : 1.0;
            $surfaceCalibration[$name]['seasonStats'] = ['season'=>$this->PVSeasonForTimestamp(time()), 'label'=>$this->GetPVSeasonLabel($this->PVSeasonForTimestamp(time())), 'factor'=>($diag['ratio'] !== null ? (float)$diag['ratio'] : 1.0), 'expectedKWh'=>(float)($diag['sumExpectedKWh'] ?? 0.0), 'actualKWh'=>(float)($diag['sumActualKWh'] ?? 0.0), 'days'=>(int)($diag['learningDayCount'] ?? 0)];
            $surfaceCalibration[$name]['compactionAudit'] = isset($calibration[$key]['lastCompactionAudit']) && is_array($calibration[$key]['lastCompactionAudit']) ? $calibration[$key]['lastCompactionAudit'] : [];
            $surfaceCalibration[$name]['storageMode'] = (string)($calibration[$key]['storageMode'] ?? 'raw');
        }

        $this->ForecastDiagnosticStep('05.90 PVCalibrationJSON schreiben START');
        $this->WriteAttributeString('PVCalibrationJSON', json_encode($calibration));
        $this->ForecastDiagnosticStep('05.91 PVCalibrationJSON schreiben ENDE');
        $forecast['surfaceCalibration'] = $surfaceCalibration;
        $this->ForecastDiagnosticStep('05.92 ForecastJSON schreiben START');
        $this->WriteAttributeString('ForecastJSON', json_encode($forecast));
        $this->ForecastDiagnosticStep('05.93 ForecastJSON schreiben ENDE');
        $this->ForecastDiagnosticStep('05.94 Kalibrierungsstatus rendern START');
        SetValue($this->GetIDForIdent('PVCalibrationStatus'), $this->BuildPVCalibrationStatus($forecast));
        $this->ForecastDiagnosticStep('05.95 Kalibrierungsstatus rendern ENDE');
        if ($renderDiagnosis) {
            $this->ForecastDiagnosticStep('05.96 Diagnose-HTML rendern START');
            SetValue($this->GetIDForIdent('PVCalibrationDiagnosisHTML'), $this->RenderPVCalibrationDiagnosisHTML($forecast));
            $this->ForecastDiagnosticStep('05.97 Diagnose-HTML rendern ENDE');
        }
        } finally {
            $this->WriteAttributeInteger('PVCalibrationLockUntil', 0);
        }
    }

    public function RefreshPVCalibration()
    {
        try {
            $this->UpdatePVCalibrationState(true);
        } catch (Throwable $e) {
            $this->DebugLog('PVCalibration', 'Kalibrierungs-Aktualisierung fehlgeschlagen: ' . $e->getMessage(), 0);
        }
    }

    private function RecalculateInternal(bool $refreshPVForecast)
    {
        $nowCalcLock = time();
        $calcLockUntil = $this->ReadAttributeInteger('CalculationLockUntil');
        if ($calcLockUntil > $nowCalcLock) {
            $this->DebugLog('Recalculate', 'Übersprungen: anderer Berechnungslauf ist noch aktiv');
            return;
        }
        $this->WriteAttributeInteger('CalculationLockUntil', $nowCalcLock + 900);
        // Execute a due saved window before rebuilding or fetching remote data.
        $this->Control();
        $this->DebugLog('Recalculate', 'Start | PV-Prognose neu abrufen=' . ($refreshPVForecast ? 'ja' : 'nein'));
        $dayNight = $this->GetCurrentDayNightStatus();
        $this->DebugLog('DayNight', ($dayNight['isNight'] ? 'NACHT' : 'TAG') . ' | Fenster ' . date('Y-m-d H:i', (int)$dayNight['start']) . ' -> ' . date('Y-m-d H:i', (int)$dayNight['end']) . ' | Modus=' . ($this->ReadPropertyBoolean('AutomaticDayNight') ? 'automatisch' : 'manuell'));
        try {
            $this->ForecastDiagnosticStep('01 Nachtverbrauch START');
            $night = $this->LearnNightConsumptionInternal();
            $this->ForecastDiagnosticStep('02 Nachtverbrauch ENDE');
            $this->DebugLog('Nachtverbrauch', 'Ergebnis ' . round($night, 3) . ' kWh | ' . $this->ReadAttributeString('NightLearningSource'));
            $this->ForecastDiagnosticStep('03 Verbrauchsprofil START');
            $consumptionProfile = $this->LearnConsumptionProfileInternal(false);
            $this->ForecastDiagnosticStep('04 Verbrauchsprofil ENDE');
            $this->DebugLog('Verbrauchsprofil', ['Quelle'=>$this->ReadAttributeString('ConsumptionLearningSource'),'dailyKWh'=>$consumptionProfile['dailyKWh'] ?? null,'validDays'=>$consumptionProfile['validDays'] ?? null]);
            $forecast = [];
            if (!$refreshPVForecast) {
                $forecast = json_decode($this->ReadAttributeString('ForecastJSON'), true);
                if (!is_array($forecast) || empty($forecast)) {
                    $refreshPVForecast = true;
                }
            }
            if ($refreshPVForecast) {
                // Zuerst Kalibrierung/Faktoren aktualisieren, erst danach Prognose berechnen und Highcharts rendern.
                $this->ForecastDiagnosticStep('05 PV-Kalibrierung START');
                $this->UpdatePVCalibrationState(false);
                $this->ForecastDiagnosticStep('06 PV-Kalibrierung ENDE');
                $this->ForecastDiagnosticStep('07 FetchPVForecast START');
                $forecast = $this->FetchPVForecast();
                $this->ForecastDiagnosticStep('08 FetchPVForecast ENDE');
                $this->DebugLog('PV-Prognose', ['heuteKWh'=>$forecast['todayKWh'] ?? null,'morgenKWh'=>$forecast['tomorrowKWh'] ?? null,'Quellen'=>$forecast['forecastSources'] ?? [],'Gewichte'=>$forecast['forecastSourceWeights'] ?? []]);
                $this->StorePVForecastHistory($forecast);
            }
            $forecast = $this->ApplyConsumptionForecastToPV($forecast, $consumptionProfile, $night);
            SetValue($this->GetIDForIdent('PVCalibrationStatus'), $this->BuildPVCalibrationStatus($forecast));
            $gate = $this->GetAutomaticLearningGateStatus();
            SetValue($this->GetIDForIdent('AutomaticReleaseStatus'), $gate['text']);
            $this->ForecastDiagnosticStep('09 Preise START');
            $prices = $this->FetchPrices();
            $this->ForecastDiagnosticStep('10 Preise ENDE');
            $this->DebugLog('Preise', 'Geladene interne Preis-Slots: ' . count($prices));
            $nightForPlan = (float)($forecast['nightConsumptionTomorrowKWh'] ?? $night);
            $this->ForecastDiagnosticStep('11 Einspeiseplan START');
            $previousPlan = json_decode($this->ReadAttributeString('PlanJSON'), true);
            if (!is_array($previousPlan)) $previousPlan = [];
            $plan = $this->BuildPlan($forecast, $prices, $nightForPlan, $consumptionProfile);
            // Bereits veröffentlichte zukünftige Einspeisefenster sind verbindlich.
            // Eine normale Neuberechnung darf sie nicht mehr entfernen oder verschieben.
            $plan = $this->PreserveCommittedFeedInPlan($plan, $previousPlan);
            $this->ForecastDiagnosticStep('12 Einspeiseplan ENDE');
            $this->DebugLog('Einspeiseplan', ['SoC'=>$plan['soc'] ?? null,'gespeichertKWh'=>$plan['storedKWh'] ?? null,'ReserveKWh'=>$plan['reserveKWh'] ?? null,'verfuegbarKWh'=>$plan['availableKWh'] ?? null,'PVSpeicherKWh'=>$plan['pvSpaceRequiredKWh'] ?? null,'Slots'=>count($plan['slots'] ?? []),'ErloesEUR'=>$plan['expectedRevenueEUR'] ?? null,'Status'=>$plan['status'] ?? '']);

            $this->WriteAttributeString('ForecastJSON', json_encode($forecast));
            $this->WriteAttributeString('PricesJSON', json_encode($prices));
            $this->WriteAttributeString('PlanJSON', json_encode($plan));

            SetValue($this->GetIDForIdent('PVForecastToday'), round((float)($forecast['todayKWh'] ?? 0.0), 3));
            SetValue($this->GetIDForIdent('PVForecastTomorrow'), round($forecast['tomorrowKWh'], 3));
            SetValue($this->GetIDForIdent('NightConsumptionForecast'), round($nightForPlan, 3));
            SetValue($this->GetIDForIdent('NightConsumptionSource'), $this->ReadAttributeString('NightLearningSource'));
            SetValue($this->GetIDForIdent('ValidNightSamples'), $this->ReadAttributeInteger('NightSampleCount'));
            SetValue($this->GetIDForIdent('ConsumptionForecastTomorrow'), round((float)$forecast['consumptionTomorrowKWh'], 3));
            SetValue($this->GetIDForIdent('ExpectedPVSurplusTomorrow'), round((float)$forecast['pvSurplusTomorrowKWh'], 3));
            SetValue($this->GetIDForIdent('PVPeakPowerTomorrow'), round((float)($plan['pvPeakPowerTomorrowW'] ?? 0.0), 0));
            SetValue($this->GetIDForIdent('PredictedMaxGridExportTomorrow'), round((float)($plan['predictedMaxGridExportTomorrowW'] ?? 0.0), 0));
            SetValue($this->GetIDForIdent('GridLimitHeadroomRequired'), round((float)($plan['gridLimitSpaceRequiredKWh'] ?? 0.0), 3));
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
            SetValue($this->GetIDForIdent('ForecastSolarStatus'), $this->RenderProviderForecastStatusHTML($forecast));
            SetValue($this->GetIDForIdent('ConsumptionProfileChartHTML'), $this->RenderConsumptionProfileChartHTML($consumptionProfile));
            SetValue($this->GetIDForIdent('FeedInStatisticsHTML'), $this->RenderFeedInStatisticsHTML());
            SetValue($this->GetIDForIdent('FeedInDebugHTML'), $this->RenderFeedInDebugHTML());
            SetValue($this->GetIDForIdent('PVCalibrationDiagnosisHTML'), $this->RenderPVCalibrationDiagnosisHTML($forecast));
            SetValue($this->GetIDForIdent('PriceChartHTML'), $this->RenderPriceChartHTML($forecast, $prices, $plan));
            SetValue($this->GetIDForIdent('PlanHTML'), $this->RenderPlanHTML($forecast, $prices, $plan));
            $this->SetStatus(($this->IsAutomaticEnabled() && !$gate['ready']) ? 202 : 102);
            $this->DebugLog('Recalculate', 'Berechnung abgeschlossen, Steuerprüfung folgt');
            $this->Control();
        } catch (Throwable $e) {
            $this->DebugLog('Recalculate', $e->getMessage(), 0);
            SetValue($this->GetIDForIdent('StatusText'), 'Fehler: ' . $e->getMessage());
            $this->SetStatus(201);
            $this->StopFeedIn();
        }
        $this->WriteAttributeInteger('CalculationLockUntil', 0);
    }

    public function LearnNightConsumption()
    {
        $this->SetActionFeedback('Nachtverbrauch wird neu gelernt ...');
        try {
            $value = $this->LearnNightConsumptionInternal();
            SetValue($this->GetIDForIdent('NightConsumptionForecast'), round($value, 3));
            SetValue($this->GetIDForIdent('NightConsumptionSource'), $this->ReadAttributeString('NightLearningSource'));
            SetValue($this->GetIDForIdent('ValidNightSamples'), $this->ReadAttributeInteger('NightSampleCount'));
            $this->RecalculateInternal(false);
            $text = 'Nachtverbrauch neu gelernt: ' . number_format($value, 2, ',', '.') . ' kWh (' . $this->ReadAttributeString('NightLearningSource') . ')';
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        } catch (Throwable $e) {
            $text = 'Nachtverbrauch lernen fehlgeschlagen: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        }
    }

    public function LearnConsumptionProfile()
    {
        $this->SetActionFeedback('Verbrauchsprofil wird neu gelernt ...');
        try {
            $profile = $this->LearnConsumptionProfileInternal(true);
            $this->RecalculateInternal(false);
            $daily = (float)($profile['dailyKWh'] ?? 0.0);
            $text = 'Verbrauchsprofil neu gelernt: ' . number_format($daily, 2, ',', '.') . ' kWh/Tag; Diagramm und Plan aktualisiert.';
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        } catch (Throwable $e) {
            $text = 'Verbrauchsprofil lernen fehlgeschlagen: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        }
    }

    public function CleanupPVCalibrationPeriod()
    {
        // Legacy-Aufruf fuer bestehende externe Skripte. Die Konfigurationsseite
        // verwendet ab 1.9.78 den Popup-Dialog und CleanupPVCalibrationPeriodSelection().
        $dateText = trim($this->ReadPropertyString('PVCalibrationCleanupDate'));
        $fromText = trim($this->ReadPropertyString('PVCalibrationCleanupFrom'));
        $toText = trim($this->ReadPropertyString('PVCalibrationCleanupTo'));
        if ($dateText === '') $dateText = date('Y-m-d');
        if ($fromText === '') $fromText = '00:00';
        if ($toText === '') $toText = '23:59';
        try {
            $text = $this->CleanupPVCalibrationPeriodByText($dateText, $fromText, $toText);
        } catch (Throwable $e) {
            $text = 'PV-Kalibrierung bereinigen fehlgeschlagen: ' . $e->getMessage();
            $this->WriteAttributeString('PVCalibrationCleanupStatus', $text);
            $this->SetActionFeedback($text);
        }
        echo $text;
    }

    public function CleanupPVCalibrationPeriodSelection(string $dateJson, string $fromJson, string $toJson)
    {
        try {
            $date = json_decode($dateJson, true);
            $from = json_decode($fromJson, true);
            $to = json_decode($toJson, true);
            if (!is_array($date) || !is_array($from) || !is_array($to)) {
                throw new Exception('Datum oder Uhrzeit konnte nicht gelesen werden.');
            }
            $year = (int)($date['year'] ?? 0);
            $month = (int)($date['month'] ?? 0);
            $day = (int)($date['day'] ?? 0);
            if ($year <= 0 || $month <= 0 || $day <= 0 || !checkdate($month, $day, $year)) {
                throw new Exception('Bitte ein gueltiges Datum auswaehlen.');
            }
            $fh = (int)($from['hour'] ?? -1);
            $fm = (int)($from['minute'] ?? -1);
            $th = (int)($to['hour'] ?? -1);
            $tm = (int)($to['minute'] ?? -1);
            if ($fh < 0 || $fh > 23 || $fm < 0 || $fm > 59 || $th < 0 || $th > 23 || $tm < 0 || $tm > 59) {
                throw new Exception('Bitte gueltige Von-/Bis-Zeiten auswaehlen.');
            }
            $dateText = sprintf('%04d-%02d-%02d', $year, $month, $day);
            $fromText = sprintf('%02d:%02d', $fh, $fm);
            $toText = sprintf('%02d:%02d', $th, $tm);
            return $this->CleanupPVCalibrationPeriodByText($dateText, $fromText, $toText);
        } catch (Throwable $e) {
            return 'FEHLER:' . $e->getMessage();
        }
    }

    private function CleanupPVCalibrationPeriodByText(string $dateText, string $fromText, string $toText): string
    {
        $dateTs = strtotime($dateText . ' 00:00:00');
        if ($dateTs === false) throw new Exception('Ungueltiges Bereinigungsdatum: ' . $dateText);
        if (!preg_match('/^(?:[01]\\d|2[0-3]):[0-5]\\d$/', $fromText)) throw new Exception('Ungueltige Von-Zeit: ' . $fromText);
        if (!preg_match('/^(?:[01]\\d|2[0-3]):[0-5]\\d$/', $toText)) throw new Exception('Ungueltige Bis-Zeit: ' . $toText);
        $day = date('Y-m-d', $dateTs);
        $fromTs = strtotime($day . ' ' . $fromText . ':00');
        $toTs = strtotime($day . ' ' . $toText . ':59');
        if ($fromTs === false || $toTs === false || $toTs < $fromTs) throw new Exception('Bereinigungszeitraum ist ungueltig.');

        $this->SetActionFeedback('PV-Kalibrierdaten werden fuer ' . date('d.m.Y H:i', $fromTs) . '–' . date('H:i', $toTs) . ' bereinigt ...');
        $calibration = json_decode($this->ReadAttributeString('PVCalibrationJSON'), true);
        if (!is_array($calibration)) $calibration = [];
        $removed = 0;
        foreach (array_keys($calibration) as $key) {
            if (!is_array($calibration[$key])) continue;
            $samples = isset($calibration[$key]['energySamples']) && is_array($calibration[$key]['energySamples']) ? $calibration[$key]['energySamples'] : [];
            $kept = [];
            foreach ($samples as $sample) {
                $sampleStart = (int)($sample['ts'] ?? 0);
                $sampleEnd = (int)($sample['endTs'] ?? $sampleStart);
                $overlaps = ($sampleEnd >= $fromTs && $sampleStart <= $toTs);
                if ($overlaps) { $removed++; continue; }
                $kept[] = $sample;
            }
            $calibration[$key]['energySamples'] = $kept;
            // Ein Integrationspunkt aus dem geloeschten Zeitraum darf nicht als
            // Startpunkt fuer das naechste gueltige Intervall weiterleben.
            $lastPointTs = (int)($calibration[$key]['lastPointTs'] ?? 0);
            if ($lastPointTs >= $fromTs && $lastPointTs <= $toTs) {
                unset($calibration[$key]['lastPointTs'], $calibration[$key]['lastPointExpectedW'], $calibration[$key]['lastPointActualW']);
            }
            $calibration = $this->RecalculatePVCalibrationFactors($calibration, (string)$key);
        }
        $this->WriteAttributeString('PVCalibrationJSON', json_encode($calibration));
        $periods = json_decode($this->ReadAttributeString('PVCalibrationExcludedPeriodsJSON'), true);
        if (!is_array($periods)) $periods = [];
        $periods[] = ['fromTs'=>$fromTs, 'toTs'=>$toTs, 'reason'=>'Manuelle Kalibrierbereinigung'];
        if (count($periods) > 180) $periods = array_slice($periods, -180);
        $this->WriteAttributeString('PVCalibrationExcludedPeriodsJSON', json_encode($periods));

        // Ab 1.9.79 auch die primaeren Archiv-Zeitreihen im gewaehlten Zeitraum bereinigen.
        // Ein 0-W-Punkt am Beginn verhindert, dass der letzte Wert vor der Luecke durch
        // das Archive Control in den geloeschten Zeitraum fortgeschrieben wird.
        if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') >= 1) {
            $archiveID = $this->FindArchive();
            $surfaces = json_decode($this->ReadPropertyString('PVSurfaces'), true);
            if ($archiveID > 0 && is_array($surfaces)) {
                foreach ($surfaces as $idx => $surface) {
                    foreach (['PVCalExpected_' . $idx, 'PVCalActual_' . $idx] as $ident) {
                        $varID = (int)@$this->GetIDForIdent($ident); if ($varID <= 0) continue;
                        @AC_DeleteVariableData($archiveID, $varID, $fromTs, $toTs);
                        @AC_AddLoggedValues($archiveID, $varID, [['TimeStamp'=>$fromTs,'Value'=>0.0]]);
                        if (function_exists('AC_ReAggregateVariable')) @AC_ReAggregateVariable($archiveID, $varID);
                    }
                }
            }
        }

        // Diagnose und Prognose-Cache sofort aus den bereinigten Daten neu aufbauen.
        $this->UpdatePVCalibrationState(true);
        $text = 'PV-Kalibrierung bereinigt: ' . date('d.m.Y H:i', $fromTs) . '–' . date('H:i', $toTs)
            . ' | entfernte Intervalle: ' . $removed . '. Faktoren wurden neu berechnet.';
        $this->WriteAttributeString('PVCalibrationCleanupStatus', $text);
        SetValue($this->GetIDForIdent('StatusText'), $text);
        $this->SetActionFeedback($text);
        return $text;
    }

    public function ResetPVCalibration()
    {
        $this->SetActionFeedback('PV-Kalibrierung und Prognose-Gewichtung werden zurückgesetzt ...');
        try {
            // PV-Flächenkalibrierung / Stundenfaktoren zurücksetzen.
            $this->WriteAttributeString('PVCalibrationJSON', '{}');
            $this->WriteAttributeInteger('PVCalibrationEnergyVersion', 1);
            $this->WriteAttributeInteger('PVCalibrationExclusionActiveFromTs', 0);
            $this->WriteAttributeString('PVCalibrationExclusionActiveReason', '');
            $this->WriteAttributeString('PVCalibrationExcludedPeriodsJSON', '[]');

            // Auch das automatische Anbieter-Lernen zurücksetzen. Die Quellenhistorie
            // bleibt für die Debug-Linien erhalten; ein Reset-Zeitstempel verhindert,
            // dass alte Vergleichstage sofort wieder in die Gewichtung eingehen.
            $this->WriteAttributeString('PVSourceWeightsJSON', '{}');
            // Debug-Linien benötigen die gespeicherte Quellenhistorie weiterhin.
            // Deshalb NICHT löschen. Stattdessen merkt ein Zeitstempel, ab wann
            // neue Daten wieder für das Gewichtslernen verwendet werden dürfen.
            $this->WriteAttributeInteger('PVSourceWeightLearningResetTs', time());

            // Neutrale Startgewichtung direkt sichtbar machen – ohne Provider-Abfrage.
            $enabledSources = [];
            if ($this->ReadPropertyBoolean('UseOpenMeteoForecast')) $enabledSources[] = 'openmeteo';
            if ($this->ReadPropertyBoolean('UseForecastSolarForecast')) $enabledSources[] = 'forecastsolar';
            if ($this->ReadPropertyBoolean('UsePVNodeForecast')) $enabledSources[] = 'pvnode';
            $neutralWeights = [];
            if (count($enabledSources) > 0) {
                $w = 1.0 / count($enabledSources);
                foreach ($enabledSources as $source) $neutralWeights[$source] = $w;
            }
            $this->WriteAttributeString('PVSourceWeightsJSON', json_encode($neutralWeights));

            // Primaere Archivdaten der PV-Kalibrierung ebenfalls leeren und Logging
            // danach wieder aktivieren. Feed-In-Statistik bleibt davon unberuehrt.
            if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') >= 1) {
                $archiveID = $this->FindArchive();
                $surfacesReset = json_decode($this->ReadPropertyString('PVSurfaces'), true);
                if ($archiveID > 0 && is_array($surfacesReset)) {
                    foreach ($surfacesReset as $idxReset => $surfaceReset) {
                        foreach (['PVCalExpected_' . $idxReset, 'PVCalActual_' . $idxReset] as $identReset) {
                            $varIDReset = (int)@$this->GetIDForIdent($identReset); if ($varIDReset <= 0) continue;
                            @AC_DeleteVariableData($archiveID, $varIDReset, 0, 0);
                            @AC_SetLoggingStatus($archiveID, $varIDReset, true);
                            @AC_SetAggregationType($archiveID, $varIDReset, 0);
                            SetValue($varIDReset, 0.0);
                        }
                    }
                }
            }

            SetValue($this->GetIDForIdent('PVCalibrationStatus'), 'PV-Kalibrierung zurückgesetzt – Auto-Faktoren 1,000; Anbietergewichtung neutral.');

            // KEINE externe Forecast-Abfrage beim Reset: dadurch erfolgt der Reset sofort.
            // Vorhandene Forecast-Werte bleiben erhalten, werden aber für die Anzeige mit
            // neutralen Gewichten neu gerendert. Die nächste reguläre Forecast-Aktualisierung
            // liefert neue Providerwerte und beginnt die Gewichtungshistorie von vorne.
            $forecast = json_decode($this->ReadAttributeString('ForecastJSON'), true);
            if (is_array($forecast) && count($forecast) > 0) {
                $forecast['forecastSourceWeights'] = $neutralWeights;
                $forecast['plantAutoFactor'] = 1.0;
                // Nach einem Kalibrierungs-Reset dürfen auch Diagnosewerte aus dem
                // Forecast-Cache keine alten Faktoren mehr anzeigen.
                if (isset($forecast['surfaceCalibration']) && is_array($forecast['surfaceCalibration'])) {
                    foreach ($forecast['surfaceCalibration'] as &$surfaceCalReset) {
                        if (!is_array($surfaceCalReset)) continue;
                        $surfaceCalReset['autoFactor'] = 1.0;
                        $surfaceCalReset['ratio'] = null;
                        $surfaceCalReset['learnedRatio'] = null;
                        $surfaceCalReset['factorReady'] = false;
                        $surfaceCalReset['sampleCount'] = 0;
                        $surfaceCalReset['sumExpectedKWh'] = 0.0;
                        $surfaceCalReset['sumActualKWh'] = 0.0;
                    }
                    unset($surfaceCalReset);
                }

                // Alle im Forecast-Cache mitgeführten Kalibrierwerte sofort neutralisieren.
                // Dadurch zeigen Chart und Diagnose direkt nach dem Tastendruck 1,000 bzw.
                // die neutrale Anbietergewichtung und warten nicht auf den nächsten Zyklus.
                foreach (['surfaceFactors', 'surfaceAutoFactors', 'hourlyCalibrationFactors', 'calibrationFactors', 'surfaceHourlyFactors', 'plantHourlyFactors'] as $factorKey) {
                    if (isset($forecast[$factorKey]) && is_array($forecast[$factorKey])) {
                        array_walk_recursive($forecast[$factorKey], function (&$value) {
                            if (is_numeric($value)) $value = 1.0;
                        });
                    }
                }

                $this->WriteAttributeString('ForecastJSON', json_encode($forecast));
                SetValue($this->GetIDForIdent('PVForecastChartHTML'), $this->RenderPVForecastChartHTML($forecast));
                SetValue($this->GetIDForIdent('ForecastSolarStatus'), $this->RenderProviderForecastStatusHTML($forecast));
                SetValue($this->GetIDForIdent('PVCalibrationDiagnosisHTML'), $this->RenderPVCalibrationDiagnosisHTML($forecast));
            } else {
                // Auch ohne vorhandenen Forecast die Diagnose unmittelbar aus dem
                // zurückgesetzten Kalibrierzustand neu aufbauen.
                SetValue($this->GetIDForIdent('PVCalibrationDiagnosisHTML'), $this->RenderPVCalibrationDiagnosisHTML([]));
            }

            $parts = [];
            foreach ($neutralWeights as $source => $weight) {
                $parts[] = $this->SourceDisplayName($source) . ' ' . number_format($weight * 100.0, 1, ',', '.') . ' %';
            }
            $text = 'PV-Kalibrierung / Auto-Faktoren und Prognose-Gewichtung zurückgesetzt'
                . (count($parts) ? ': ' . implode(' | ', $parts) : '') . '.';
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        } catch (Throwable $e) {
            $text = 'PV-Kalibrierung zurücksetzen fehlgeschlagen: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        }
    }


    public function ManualStopFeedIn()
    {
        $this->SetActionFeedback('Einspeisung wird gestoppt ...');
        try {
            if ($this->ReadAttributeString('ActiveFeedInPlanKey') !== '') {
                $this->UpdateMeasuredFeedInEnergy();
                $this->FinishMeasuredFeedInRun(false, 'manuell gestoppt');
            } else {
                $this->StopFeedIn();
            }
            $text = 'Einspeisung sofort gestoppt.';
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        } catch (Throwable $e) {
            $text = 'Einspeisung stoppen fehlgeschlagen: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        }
    }

    public function Control()
    {
        // Timer and recalculation must not interleave AlphaESS command sequences.
        $lock = 'SBO_Control_' . $this->InstanceID;
        if (!IPS_SemaphoreEnter($lock, 1)) return;
        try {
            $now = time();
            $this->TrackTotalGridExport();
            $priceLock = $this->UpdateFeedInPriceLock();
            if (!empty($priceLock['blocked'])) {
                if ($this->ReadAttributeString('ActiveFeedInPlanKey') !== '') {
                    $this->UpdateMeasuredFeedInEnergy();
                    $this->FinishMeasuredFeedInRun(false, 'Mindestpreis Einspeisung unterschritten');
                } else {
                    $this->StopFeedIn();
                }
                if ($this->ReadAttributeInteger('ManualTestUntil') > 0) {
                    $this->WriteAttributeInteger('ManualTestUntil', 0);
                    $this->WriteAttributeInteger('ManualTestPowerW', 0);
                    SetValue($this->GetIDForIdent('TestDischarge'), false);
                    SetValue($this->GetIDForIdent('TestDischargeStatus'), 'Test beendet: Mindestpreis Einspeisung unterschritten.');
                }
                SetValue($this->GetIDForIdent('StatusText'), 'Einspeisung gesperrt: Tarif ' . number_format((float)$priceLock['priceCt'], 2, ',', '.') . ' ct/kWh < Mindestpreis ' . number_format((float)$priceLock['thresholdCt'], 2, ',', '.') . ' ct/kWh' . (!empty($priceLock['blockedUntil']) ? ' | bis ' . date('d.m. H:i', (int)$priceLock['blockedUntil']) : ''));
                return;
            }

            $testUntil = $this->ReadAttributeInteger('ManualTestUntil');
            if ($testUntil > $now) {
                $testPower = max(0, min($this->ReadAttributeInteger('ManualTestPowerW'), $this->ReadPropertyInteger('MaxDischargePowerW')));
                $this->RunAlphaESSDiagnosticTest();
                SetValue($this->GetIDForIdent('FeedInActive'), true);
                SetValue($this->GetIDForIdent('PlannedPower'), (float)$testPower);
                SetValue($this->GetIDForIdent('TestDischarge'), true);
                return;
            }
            if ($testUntil > 0) {
                $this->WriteAttributeInteger('ManualTestUntil', 0);
                $this->WriteAttributeInteger('ManualTestPowerW', 0);
                $this->WriteAttributeInteger('AlphaTestStage', 0);
                $this->WriteAttributeInteger('AlphaTestNextTs', 0);
                SetValue($this->GetIDForIdent('TestDischarge'), false);
                SetValue($this->GetIDForIdent('TestDischargeStatus'), 'Test automatisch nach 120 Sekunden beendet.');
                $this->StopFeedIn();
            }

            $automaticEnabled = $this->IsAutomaticEnabled();
            $pvProtectionEnabled = $this->GetRuntimeBoolean('PVCurtailmentProtectionEnabled', $this->ReadPropertyBoolean('PreventPVCurtailment'));
            $dayNightControl = $this->GetCurrentDayNightStatus();
            $raw = json_decode($this->ReadAttributeString('PlanJSON'), true);

            // Einen vom Optimierer geplanten Preisslot zuerst prüfen. Der Plan selbst
            // wurde bereits mit DetermineNightStart/DetermineMorningEnd begrenzt. Damit
            // kann eine zweite Tag/Nacht-Prüfung den Dispatch am Slotbeginn nicht mehr
            // versehentlich blockieren.
            $plannedSlot = null;
            if (is_array($raw) && isset($raw['slots']) && is_array($raw['slots'])) {
                $completed = json_decode($this->ReadAttributeString('CompletedFeedInPlanKeysJSON'), true);
                if (!is_array($completed)) $completed = [];
                foreach ($completed as $k => $ts) if ((int)$ts < $now - 172800) unset($completed[$k]);
                $this->WriteAttributeString('CompletedFeedInPlanKeysJSON', json_encode($completed));
                foreach ($raw['slots'] as $slot) {
                    $key = (string)($slot['planKey'] ?? ((int)$slot['start'] . ':' . (int)($slot['priceIntervalEnd'] ?? $slot['end'])));
                    $intervalEnd = (int)($slot['priceIntervalEnd'] ?? $slot['end']);
                    if ($now >= (int)$slot['start'] && $now < $intervalEnd && (float)$slot['powerW'] > 0 && !isset($completed[$key])) {
                        $slot['planKey'] = $key;
                        $plannedSlot = $slot;
                        break;
                    }
                }
            }

            // Eine bereits gestartete Einspeisemenge darf über das rechnerische Ende
            // (20 kW * Zeit) hinaus weiterlaufen, bis die tatsächlich am Netz gemessene
            // Zielenergie erreicht ist. Als Sicherheitsgrenze gilt das Nachtende.
            $activeKey = $this->ReadAttributeString('ActiveFeedInPlanKey');
            $continuingMeasuredRun = $activeKey !== '' && $this->ReadAttributeFloat('ActiveFeedInTargetKWh') > $this->ReadAttributeFloat('ActiveFeedInDeliveredKWh') + 0.001;

            if ($automaticEnabled && ($plannedSlot !== null || $continuingMeasuredRun)) {
                if ($plannedSlot !== null) {
                    $key = (string)$plannedSlot['planKey'];
                    if ($activeKey !== $key) {
                        $expectedSOC = isset($plannedSlot['expectedSOCPct']) ? (float)$plannedSlot['expectedSOCPct'] : null;
                        $this->StartMeasuredFeedInRun($key, (float)$plannedSlot['energyKWh'], $expectedSOC);
                        $activeKey = $key;
                    }
                }

                $targetKWh = $this->ReadAttributeFloat('ActiveFeedInTargetKWh');
                $deliveredKWh = $this->UpdateMeasuredFeedInEnergy();
                SetValue($this->GetIDForIdent('FeedInTargetEnergy'), round($targetKWh, 3));
                SetValue($this->GetIDForIdent('FeedInDeliveredEnergy'), round($deliveredKWh, 3));

                $socID = $this->ReadPropertyInteger('SOCVariable');
                $soc = ($socID > 0 && @IPS_VariableExists($socID)) ? (float)GetValue($socID) : 100.0;
                if ($soc <= $this->GetRuntimeMinimumSOC() + 0.01) {
                    $this->FinishMeasuredFeedInRun(false, 'Mindest-SoC erreicht');
                    return;
                }
                if ($deliveredKWh + 0.001 >= $targetKWh) {
                    $this->FinishMeasuredFeedInRun(true, 'geplante Netzeinspeisemenge erreicht');
                    return;
                }

                $today = strtotime('today 00:00:00');
                $hardEnd = $now < $this->DetermineMorningEnd(0, $today)
                    ? $this->DetermineMorningEnd(0, $today)
                    : $this->DetermineMorningEnd(0, strtotime('tomorrow 00:00:00'));
                if ($now >= $hardEnd) {
                    $this->FinishMeasuredFeedInRun(false, 'Nachtende erreicht');
                    return;
                }

                $consumptionProfile = json_decode($this->ReadAttributeString('ConsumptionProfileJSON'), true);
                if (!is_array($consumptionProfile)) $consumptionProfile = ['hourlyKWh'=>array_fill(0,24,0.0)];
                $powerW = max(0.0, (float)$this->ReadPropertyInteger('MaxDischargePowerW'));
                $expectedExportW = $this->GetExpectedGridExportPowerW($consumptionProfile, $now);
                $remainingKWh = max(0.0, $targetKWh - $deliveredKWh);

                // Alle 5 Minuten aus der tatsächlich gemessenen Restenergie ein neues
                // Fensterende berechnen. Beim Start erfolgt die erste Berechnung sofort.
                $lastAdjustment = $this->ReadAttributeInteger('ActiveFeedInLastAdjustmentTs');
                $plannedEnd = $this->ReadAttributeInteger('ActiveFeedInPlannedEndTs');
                $adjustDue = $lastAdjustment <= 0 || ($now - $lastAdjustment) >= 300 || $plannedEnd <= $now;
                if ($adjustDue) {
                    $requiredSeconds = $this->EstimateFeedInDurationSeconds($remainingKWh, $now, $hardEnd, $consumptionProfile);
                    $plannedEnd = min($hardEnd, $now + max(1, $requiredSeconds));
                    $this->WriteAttributeInteger('ActiveFeedInPlannedEndTs', $plannedEnd);
                    $this->WriteAttributeInteger('ActiveFeedInLastAdjustmentTs', $now);
                    $this->UpdateActivePlanWindowEnd($activeKey, $plannedEnd);
                    $this->DebugLog(
                        'Einspeisefenster',
                        '5-min-Korrektur | Rest=' . round($remainingKWh,3) . ' kWh'
                        . ' | Lastprofil=' . round($this->GetExpectedLoadPowerW($consumptionProfile,$now)) . ' W'
                        . ' | erwartete Netzeinspeisung=' . round($expectedExportW) . ' W'
                        . ' | neues Ende=' . date('H:i:s',$plannedEnd)
                    );
                    $this->AddFeedInDebug('LAUFEND', 'Netz ' . number_format($deliveredKWh,3,',','.') . ' / ' . number_format($targetKWh,3,',','.') . ' kWh | Rest ' . number_format($remainingKWh,3,',','.') . ' kWh | aktuell ' . number_format($this->ReadCurrentGridExportW()/1000.0,2,',','.') . ' kW | Restzeit ca. ' . max(0,(int)ceil(($plannedEnd-$now)/60)) . ' min | Ende ' . date('H:i:s',$plannedEnd));
                }

                // AlphaESS nur beim Start bzw. bei der 5-Minuten-Korrektur neu programmieren.
                // Dispatch Time erhält innerhalb SetAlphaESSDispatch zusätzlich 30 % Reserve.
                if (!$this->ReadAttributeBoolean('AlphaDispatchActive') || $adjustDue) {
                    $this->SetFeedIn(true, $powerW, $plannedEnd);
                } else {
                    SetValue($this->GetIDForIdent('FeedInActive'), true);
                    SetValue($this->GetIDForIdent('PlannedPower'), $powerW);
                }
                SetValue($this->GetIDForIdent('StatusText'), 'Einspeisung aktiv: Netz ' . number_format($deliveredKWh, 2, ',', '.') . ' / ' . number_format($targetKWh, 2, ',', '.') . ' kWh | Rest ' . number_format($remainingKWh,2,',','.') . ' kWh | erwartete Netzeinspeisung ' . round($expectedExportW) . ' W | Ende ' . date('H:i',$plannedEnd));
                return;
            }

            $this->DebugLog('Control', 'Steuerprüfung | Automatik=' . ($automaticEnabled?'AN':'AUS') . ' | PV-Schutz=' . ($pvProtectionEnabled?'AN':'AUS') . ' | ' . ($dayNightControl['isNight']?'Nacht':'Tag'));

            if (!$dayNightControl['isNight']) {
                if ($pvProtectionEnabled) {
                    $socVariableID = $this->ReadPropertyInteger('SOCVariable');
                    $soc = $socVariableID > 0 ? (float)GetValue($socVariableID) : 0.0;
                    $targetSOC = max($this->GetRuntimeMinimumSOC(), min(100.0, $this->GetRuntimeFloat('RuntimePVHeadroomTargetSOC', $this->ReadPropertyFloat('PVHeadroomTargetSOC'))));
                    if ($soc > $targetSOC + 0.01) {
                        $powerW = max(0, $this->ReadPropertyInteger('MaxDischargePowerW'));
                        $this->SetFeedIn(true, (float)$powerW, $now + 120);
                        SetValue($this->GetIDForIdent('StatusText'), 'PV-Abregelung vermeiden: ' . round($powerW) . ' W | SoC ' . round($soc,1) . ' % > Ziel ' . round($targetSOC,1) . ' %');
                        return;
                    }
                }
                $this->StopFeedIn();
                SetValue($this->GetIDForIdent('StatusText'), $pvProtectionEnabled ? 'Tagbetrieb: kein PV-Headroom erforderlich' : 'Tagbetrieb: PV-Abregelungsschutz deaktiviert');
                return;
            }

            if (!$automaticEnabled) {
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
            $this->StopFeedIn();
        } catch (Throwable $e) {
            $this->DebugLog('Control', 'FEHLER: ' . $e->getMessage());
            SetValue($this->GetIDForIdent('StatusText'), 'Steuerfehler: ' . $e->getMessage());
            try { $this->StopFeedIn(); } catch (Throwable $ignored) {}
        } finally {
            IPS_SemaphoreLeave($lock);
        }
    }

    private function StartMeasuredFeedInRun(string $key, float $targetKWh, ?float $expectedSOCPct = null): void
    {
        $originalTargetKWh = max(0.0, $targetKWh);
        $targetKWh = $originalTargetKWh;
        $socID = $this->ReadPropertyInteger('SOCVariable');
        $actualSOC = ($socID > 0 && @IPS_VariableExists($socID)) ? max(0.0, min(100.0, (float)GetValue($socID))) : null;

        // Ein geplanter Slot wird grundsätzlich ausgeführt. Nur wenn der reale SoC
        // beim Start mehr als 5 Prozentpunkte unter dem bei der Planung erwarteten
        // SoC liegt, wird die Energiemenge reduziert. Die komplette Abweichung wird
        // berücksichtigt, damit die ursprünglich eingeplante Reserve erhalten bleibt.
        if ($expectedSOCPct !== null && $actualSOC !== null && $actualSOC < $expectedSOCPct - 5.0) {
            $capacity = max(0.1, $this->ReadPropertyFloat('BatteryCapacityKWh'));
            $socDeficitPct = max(0.0, $expectedSOCPct - $actualSOC);
            $reductionKWh = $capacity * $socDeficitPct / 100.0;
            $targetKWh = max(0.0, $originalTargetKWh - $reductionKWh);
            $this->DebugLog('Einspeiseplan',
                'Startmenge angepasst | erwartet SoC=' . round($expectedSOCPct,1) . ' %'
                . ' | Ist=' . round($actualSOC,1) . ' %'
                . ' | Abweichung=-' . round($socDeficitPct,1) . ' %-Punkte'
                . ' | geplant=' . round($originalTargetKWh,3) . ' kWh'
                . ' | neu=' . round($targetKWh,3) . ' kWh');
        } elseif ($expectedSOCPct !== null && $actualSOC !== null) {
            $this->DebugLog('Einspeiseplan',
                'Plan wie geplant gestartet | erwartet SoC=' . round($expectedSOCPct,1) . ' %'
                . ' | Ist=' . round($actualSOC,1) . ' %'
                . ' | Ziel=' . round($targetKWh,3) . ' kWh');
        }

        $this->WriteAttributeString('ActiveFeedInPlanKey', $key);
        $this->WriteAttributeFloat('ActiveFeedInTargetKWh', max(0.0, $targetKWh));
        $this->WriteAttributeFloat('ActiveFeedInDeliveredKWh', 0.0);
        $this->WriteAttributeInteger('ActiveFeedInLastTs', time());
        $this->WriteAttributeFloat('ActiveFeedInLastExportW', $this->ReadCurrentGridExportW());
        $this->WriteAttributeInteger('ActiveFeedInLastAdjustmentTs', 0);
        $this->WriteAttributeInteger('ActiveFeedInPlannedEndTs', 0);
        $this->WriteAttributeInteger('ActiveFeedInStartedTs', time());
        $priceCt = 0.0; $reason = 'price';
        $plan = json_decode($this->ReadAttributeString('PlanJSON'), true);
        if (is_array($plan) && isset($plan['slots']) && is_array($plan['slots'])) {
            foreach ($plan['slots'] as $slot) {
                $slotKey = (string)($slot['planKey'] ?? ((int)($slot['start'] ?? 0) . ':' . (int)($slot['priceIntervalEnd'] ?? ($slot['end'] ?? 0))));
                if ($slotKey === $key) { $priceCt = (float)($slot['priceCt'] ?? 0.0); $reason = (string)($slot['reason'] ?? 'price'); break; }
            }
        }
        $this->WriteAttributeFloat('ActiveFeedInPriceCt', $priceCt);
        $this->WriteAttributeString('ActiveFeedInReason', $reason);
        SetValue($this->GetIDForIdent('FeedInTargetEnergy'), max(0.0, $targetKWh));
        SetValue($this->GetIDForIdent('FeedInDeliveredEnergy'), 0.0);
        $this->DebugLog('Einspeisemenge', 'Start ' . $key . ' | Ziel=' . round($targetKWh,3) . ' kWh');
        $this->AddFeedInDebug('START', 'Plan ' . $key . ' | Ziel ' . number_format($targetKWh,3,',','.') . ' kWh | Tarif ' . number_format($priceCt,2,',','.') . ' ct/kWh' . ($actualSOC !== null ? ' | SoC ' . number_format($actualSOC,1,',','.') . ' %' : ''));
    }

    private function UpdateMeasuredFeedInEnergy(): float
    {
        $now = time();
        $lastTs = $this->ReadAttributeInteger('ActiveFeedInLastTs');
        $lastW = max(0.0, $this->ReadAttributeFloat('ActiveFeedInLastExportW'));
        $currentW = $this->ReadCurrentGridExportW();
        $delivered = max(0.0, $this->ReadAttributeFloat('ActiveFeedInDeliveredKWh'));
        if ($lastTs > 0 && $now > $lastTs) {
            $seconds = min(180, $now - $lastTs);
            $delivered += (($lastW + $currentW) / 2.0) * ($seconds / 3600.0) / 1000.0;
        }
        $this->WriteAttributeFloat('ActiveFeedInDeliveredKWh', $delivered);
        $this->WriteAttributeInteger('ActiveFeedInLastTs', $now);
        $this->WriteAttributeFloat('ActiveFeedInLastExportW', $currentW);
        return $delivered;
    }

    private function AddFeedInDebug(string $event, string $message): void
    {
        $now = time();
        $rows = json_decode($this->ReadAttributeString('FeedInDebugLogJSON'), true);
        if (!is_array($rows)) $rows = [];
        $rows[] = ['ts'=>$now, 'event'=>$event, 'message'=>$message];
        $cut = $now - 86400;
        $rows = array_values(array_filter($rows, static function($r) use ($cut) { return (int)($r['ts'] ?? 0) >= $cut; }));
        if (count($rows) > 500) $rows = array_slice($rows, -500);
        $this->WriteAttributeString('FeedInDebugLogJSON', json_encode($rows, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
        $id = (int)@$this->GetIDForIdent('FeedInDebugHTML');
        if ($id > 0) SetValue($id, $this->RenderFeedInDebugHTML());
    }

    private function RenderFeedInDebugHTML(): string
    {
        $rows = json_decode($this->ReadAttributeString('FeedInDebugLogJSON'), true);
        if (!is_array($rows)) $rows = [];
        $cut = time() - 86400;
        $rows = array_values(array_filter($rows, static function($r) use ($cut) { return (int)($r['ts'] ?? 0) >= $cut; }));
        usort($rows, static function($a,$b){ return ((int)($b['ts']??0)) <=> ((int)($a['ts']??0)); });
        $html='<div style="font-family:Tahoma,Arial,-apple-system,BlinkMacSystemFont,Segoe UI,sans-serif;color:#fff;width:100%"><details open><summary style="cursor:pointer;font-weight:bold">Einspeise-Debug – letzte 24 Stunden</summary><div style="max-height:360px;overflow-y:auto;margin-top:8px;border-top:1px solid rgba(255,255,255,.18)">';
        if (!$rows) $html.='<div style="padding:8px 2px;color:#bbb">Noch keine Einspeise-Ereignisse in den letzten 24 Stunden.</div>';
        foreach($rows as $r){
            $event=htmlspecialchars((string)($r['event']??''),ENT_QUOTES,'UTF-8');
            $msg=htmlspecialchars((string)($r['message']??''),ENT_QUOTES,'UTF-8');
            $html.='<div style="padding:6px 2px;border-bottom:1px solid rgba(255,255,255,.10);font-size:11px"><b>'.date('d.m.Y H:i:s',(int)$r['ts']).' · '.$event.'</b><br>'.$msg.'</div>';
        }
        return $html.'</div></details></div>';
    }

    private function TrackTotalGridExport(): void
    {
        try { $currentW = $this->ReadCurrentGridExportW(); } catch(Throwable $e) { return; }
        $now=time(); $lastTs=$this->ReadAttributeInteger('GridExportTrackLastTs'); $lastW=max(0.0,$this->ReadAttributeFloat('GridExportTrackLastW'));
        if($lastTs>0 && $now>$lastTs){
            $seconds=min(180,$now-$lastTs); $kWh=(($lastW+$currentW)/2.0)*($seconds/3600.0)/1000.0;
            if($kWh>0){
                $priceID=(int)@$this->GetIDForIdent('CurrentPrice'); $priceCt=$priceID>0?(float)GetValue($priceID):0.0;
                $day=date('Y-m-d',$now); $days=json_decode($this->ReadAttributeString('GridExportDailyJSON'),true); if(!is_array($days))$days=[];
                if(!isset($days[$day])||!is_array($days[$day]))$days[$day]=['kWh'=>0.0,'eur'=>0.0];
                $days[$day]['kWh']=(float)$days[$day]['kWh']+$kWh; $days[$day]['eur']=(float)$days[$day]['eur']+$kWh*$priceCt/100.0;
                $cut=strtotime('-400 days 00:00:00'); foreach(array_keys($days) as $d){$t=strtotime($d.' 00:00:00');if($t!==false&&$t<$cut)unset($days[$d]);}
                $this->WriteAttributeString('GridExportDailyJSON',json_encode($days));
            }
        }
        $this->WriteAttributeInteger('GridExportTrackLastTs',$now); $this->WriteAttributeFloat('GridExportTrackLastW',$currentW);
    }

    private function ReadCurrentGridExportW(): float
    {
        // Dieselbe Variable wie bei der PV-Lernsperre wird wiederverwendet.
        // PVCalibrationFeedInInvert=true bedeutet: Rohwert ist bei Einspeisung negativ
        // (typische Netzbezug-Variable). Intern wird Einspeisung immer positiv gerechnet.
        $id = $this->ReadPropertyInteger('PVCalibrationFeedInVariable');
        if ($id <= 0 || !@IPS_VariableExists($id)) {
            throw new Exception('Netzbezug/Netzeinspeisung für reale Einspeisemengenmessung ist nicht konfiguriert.');
        }
        $raw = (float)GetValue($id);
        $exportW = $this->ReadPropertyBoolean('PVCalibrationFeedInInvert') ? -$raw : $raw;
        return max(0.0, $exportW);
    }

    private function FinishMeasuredFeedInRun(bool $completed, string $reason): void
    {
        $key = $this->ReadAttributeString('ActiveFeedInPlanKey');
        $delivered = $this->UpdateMeasuredFeedInEnergy();
        $target = $this->ReadAttributeFloat('ActiveFeedInTargetKWh');
        $startedTs = $this->ReadAttributeInteger('ActiveFeedInStartedTs');
        $priceCt = $this->ReadAttributeFloat('ActiveFeedInPriceCt');
        $feedReason = $this->ReadAttributeString('ActiveFeedInReason');
        // Die Statistik gehört ausschließlich zur preisgesteuerten Einspeiseautomatik.
        // Entladungen zur PV-Speicherfreihaltung / zum Abregelungsschutz werden bewusst
        // nicht als Verkauf erfasst, auch wenn sie technisch über denselben Dispatchpfad laufen.
        $isPriceFeedInAutomation = ($feedReason === '' || $feedReason === 'price');
        if ($key !== '' && $startedTs > 0 && $isPriceFeedInAutomation) {
            $stats = json_decode($this->ReadAttributeString('FeedInStatisticsJSON'), true);
            if (!is_array($stats)) $stats = [];
            $stats[] = ['start'=>$startedTs,'end'=>time(),'planKey'=>$key,'targetKWh'=>$target,'deliveredKWh'=>$delivered,'priceCt'=>$priceCt,'revenueEUR'=>$delivered*$priceCt/100.0,'completed'=>$completed,'reason'=>'price','finishReason'=>$reason];
            if (count($stats) > 1500) $stats = array_slice($stats, -1500);
            $this->WriteAttributeString('FeedInStatisticsJSON', json_encode($stats));
            $this->StoreFeedInStatisticArchive($delivered, $delivered*$priceCt/100.0, $target, time());
        }
        // Anzeige nach jedem Abschluss aktualisieren. Dadurch verschwindet ein eventuell
        // laufender Status sofort, auch wenn das Fenster nicht statistikrelevant war.
        SetValue($this->GetIDForIdent('FeedInStatisticsHTML'), $this->RenderFeedInStatisticsHTML());
        if ($completed && $key !== '') {
            $done = json_decode($this->ReadAttributeString('CompletedFeedInPlanKeysJSON'), true);
            if (!is_array($done)) $done = [];
            $done[$key] = time();
            $this->WriteAttributeString('CompletedFeedInPlanKeysJSON', json_encode($done));
        }
        $this->StopFeedIn();
        $this->WriteAttributeString('ActiveFeedInPlanKey', '');
        $this->WriteAttributeFloat('ActiveFeedInTargetKWh', 0.0);
        $this->WriteAttributeFloat('ActiveFeedInDeliveredKWh', 0.0);
        $this->WriteAttributeInteger('ActiveFeedInLastTs', 0);
        $this->WriteAttributeFloat('ActiveFeedInLastExportW', 0.0);
        $this->WriteAttributeInteger('ActiveFeedInLastAdjustmentTs', 0);
        $this->WriteAttributeInteger('ActiveFeedInPlannedEndTs', 0);
        $this->WriteAttributeInteger('ActiveFeedInStartedTs', 0);
        $this->WriteAttributeFloat('ActiveFeedInPriceCt', 0.0);
        $this->WriteAttributeString('ActiveFeedInReason', '');
        SetValue($this->GetIDForIdent('StatusText'), 'Einspeisung beendet: ' . $reason . ' | Netz ' . number_format($delivered,2,',','.') . ' / ' . number_format($target,2,',','.') . ' kWh');
        $this->DebugLog('Einspeisemenge', 'Ende | ' . $reason . ' | ' . round($delivered,3) . '/' . round($target,3) . ' kWh');
        $revenue = $delivered * $priceCt / 100.0;
        $this->AddFeedInDebug('ENDE', $reason . ' | ' . number_format($delivered,3,',','.') . ' / ' . number_format($target,3,',','.') . ' kWh | Erlös ' . number_format($revenue,2,',','.') . ' € | Dauer ' . ($startedTs > 0 ? max(0,(int)round((time()-$startedTs)/60)) : 0) . ' min');
    }

    public function StopFeedIn()
    {
        $this->SetFeedIn(false, 0.0);
    }

    private function ForecastDiagnosticStep(string $step): void
    {
        $text = 'DIAG: ' . $step;
        $this->DebugLog('Forecast-Diagnose', $text);
        try {
            SetValue($this->GetIDForIdent('StatusText'), date('d.m.Y H:i:s') . ' | ' . $text);
        } catch (Throwable $e) {
        }
        $this->AddProviderDebug('DIAG', $step, [], $text, 0, 0.0);
    }

    private function FetchPVForecast(): array
    {
        $lat = $this->ReadPropertyFloat('Latitude');
        $lon = $this->ReadPropertyFloat('Longitude');
        $useOpenMeteo = $this->ReadPropertyBoolean('UseOpenMeteoForecast');
        $useForecastSolar = $this->ReadPropertyBoolean('UseForecastSolarForecast');
        $usePVNode = $this->ReadPropertyBoolean('UsePVNodeForecast');
        $this->DebugLog('PV-Prognose', 'Quellen: Open-Meteo=' . ($useOpenMeteo?'AN':'AUS') . ' | Forecast.Solar=' . ($useForecastSolar?'AN':'AUS') . ' | pvnode=' . ($usePVNode?'AN':'AUS'));
        if (!$useOpenMeteo && !$useForecastSolar && !$usePVNode) {
            throw new Exception('Mindestens eine PV-Prognosequelle muss aktiviert sein.');
        }

        $surfaces = json_decode($this->ReadPropertyString('PVSurfaces'), true);
        if (!is_array($surfaces) || count($surfaces) === 0) {
            throw new Exception('Keine PV-Flächen konfiguriert.');
        }

        if ($this->ReadAttributeInteger('PVCalibrationEnergyVersion') < 1) {
            $this->WriteAttributeString('PVCalibrationJSON', '{}');
            $this->WriteAttributeInteger('PVCalibrationEnergyVersion', 1);
        }
        $calibration = json_decode($this->ReadAttributeString('PVCalibrationJSON'), true);
        if (!is_array($calibration)) $calibration = [];
        if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') >= 1) {
            $calibration = $this->BuildPVCalibrationFromArchive($calibration);
        }

        $sourceHours = ['openmeteo' => [], 'forecastsolar' => [], 'pvnode' => []];
        // Rohprognose je PV-Fläche und Stunde. Diese kWh-Werte sind die verbindliche
        // Kalibrierbasis; nicht momentane Wattwerte des Kalibrier-Timers.
        $surfaceSourceHours = ['openmeteo' => [], 'forecastsolar' => [], 'pvnode' => []];
        $surfaceTotalsBySource = ['openmeteo' => [], 'forecastsolar' => [], 'pvnode' => []];
        $surfaceCalibration = [];
        $calibrationFeedInGate = $this->GetPVCalibrationFeedInGate();
        $nowHour = strtotime(date('Y-m-d H:00:00'));

        // Forecast.Solar muss bei Public pro Fläche abgefragt werden. Ergebnisse werden
        // zunächst separat gesammelt und erst dann als vollständige Anlagenprognose übernommen.
        // So kann ein Fehler/429 bei Fläche 2 nicht unbemerkt zu einer halben Prognose führen.
        $forecastSolarTempHours = [];
        $forecastSolarSurfaceStatus = [];
        $forecastSolarRequired = 0;
        $forecastSolarResolved = 0;
        $forecastSolarCache = json_decode($this->ReadAttributeString('ForecastSolarSurfaceCacheJSON'), true);
        if (!is_array($forecastSolarCache)) $forecastSolarCache = [];

        foreach ($surfaces as $idx => $surface) {
            if (empty($surface['Active']) || (float)($surface['KWp'] ?? 0) <= 0) continue;

            $name = trim((string)($surface['Name'] ?? 'PV'));
            if ($name === '') $name = 'PV ' . ($idx + 1);
            $key = $this->SurfaceKey($name, $idx);
            $kwp = (float)$surface['KWp'];
            $orientationKnown = !array_key_exists('OrientationKnown', $surface) || (bool)$surface['OrientationKnown'];
            $tilt = $orientationKnown ? max(0.0, min(90.0, (float)($surface['Tilt'] ?? 0))) : 0.0;
            $azimuth = $orientationKnown ? max(-180.0, min(180.0, (float)($surface['Azimuth'] ?? 0))) : 0.0;
            $manualFactor = max(0.01, (float)($surface['Factor'] ?? 1.0));
            $autoEnabled = !empty($surface['AutoCalibrate']);
            $autoFactor = 1.0;
            if ($autoEnabled && isset($calibration[$key]['factor'])) $autoFactor = (float)$calibration[$key]['factor'];
            $autoFactor = max($this->ReadPropertyFloat('PVCalibrationMinFactor'), min($this->ReadPropertyFloat('PVCalibrationMaxFactor'), $autoFactor));

            $currentExpectedBaseW = 0.0;

            if ($useOpenMeteo) {
                $url = 'https://api.open-meteo.com/v1/forecast?' . http_build_query([
                    'latitude' => $lat,
                    'longitude' => $lon,
                    'hourly' => 'global_tilted_irradiance',
                    'tilt' => $tilt,
                    'azimuth' => $azimuth,
                    'timezone' => 'Europe/Vienna',
                    'forecast_days' => 3
                ]);
                $this->ForecastDiagnosticStep('Open-Meteo START | ' . $name);
                $data = $this->HttpGetJson($url, 'Open-Meteo', ['Fläche'=>$name,'kWp'=>$kwp,'Azimut'=>$azimuth,'Neigung'=>$tilt,'AutoFaktor'=>$autoFactor,'Zeitzone'=>'Europe/Vienna']);
                $this->ForecastDiagnosticStep('Open-Meteo ENDE | ' . $name);
                if (!isset($data['hourly']['time'], $data['hourly']['global_tilted_irradiance'])) {
                    throw new Exception('Ungültige Open-Meteo-Antwort für Fläche ' . $name);
                }

                $sum = 0.0;
                $openMeteoTimezone = new DateTimeZone('Europe/Vienna');
                foreach ($data['hourly']['time'] as $i => $timeStr) {
                    $dt = DateTimeImmutable::createFromFormat('!Y-m-d\TH:i', (string)$timeStr, $openMeteoTimezone);
                    if ($dt === false) $dt = new DateTimeImmutable((string)$timeStr, $openMeteoTimezone);
                    // Open-Meteo kennzeichnet global_tilted_irradiance mit dem ENDE des
                    // Intervalls: der Stundenwert ist der Mittelwert der vorhergehenden Stunde.
                    // Intern verwenden alle anderen Provider und die Ist-/Kalibrierungsdaten den
                    // Beginn des Stundenintervalls. Deshalb hier zentral um eine Stunde nach vorn
                    // auf den Intervallbeginn normalisieren (z. B. API 13:00 => 12:00-13:00).
                    $ts = $dt->getTimestamp() - 3600;
                    $gti = max(0.0, (float)$data['hourly']['global_tilted_irradiance'][$i]);
                    $basePowerKW = $kwp * ($gti / 1000.0) * $this->ReadPropertyFloat('SystemEfficiency') * $manualFactor * $this->ReadPropertyFloat('GlobalPVFactor');
                    // Providerlinie bleibt Rohprognose; PV-Auto wird erst nach der Quellengewichtung angewendet.
                    $powerKW = $basePowerKW;
                    if (!isset($sourceHours['openmeteo'][$ts])) $sourceHours['openmeteo'][$ts] = 0.0;
                    $sourceHours['openmeteo'][$ts] += $powerKW;
                    if (!isset($surfaceSourceHours['openmeteo'][$name])) $surfaceSourceHours['openmeteo'][$name] = [];
                    $surfaceSourceHours['openmeteo'][$name][$ts] = $powerKW;
                    if ($ts === $nowHour) $currentExpectedBaseW = $basePowerKW * 1000.0;
                    if (date('Y-m-d', $ts) === date('Y-m-d', strtotime('tomorrow'))) $sum += $powerKW;
                }
                $surfaceTotalsBySource['openmeteo'][$name] = $sum;
                $this->DebugLog('Open-Meteo', $name . ' | morgen=' . round($sum, 3) . ' kWh | kWp=' . $kwp . ' | Azimut=' . $azimuth . ' | Neigung=' . $tilt . ' | AutoFaktor=' . round($autoFactor, 3));
            }

            if ($useForecastSolar) {
                $forecastSolarRequired++;
                $fsHours = null;
                $fromCache = false;
                try {
                    $this->SetActionFeedback('Prognose: Forecast.Solar – ' . $name . ' wird abgefragt ...');
                    // Public API: JEDE aktive PV-Fläche erhält ihren eigenen Request.
                    $retryAfterTs = $this->ReadAttributeInteger('ForecastSolarRetryAfterTs');
                    $cachedSurface = $forecastSolarCache[$key] ?? null;
                    $cacheAge = is_array($cachedSurface) ? (time() - (int)($cachedSurface['savedAt'] ?? 0)) : PHP_INT_MAX;

                    // Erfolgreiche Forecast.Solar-Flächendaten mindestens 15 Minuten
                    // wiederverwenden. Das gilt auch für manuelle Gesamtaktualisierungen.
                    if (is_array($cachedSurface) && $cacheAge >= 0 && $cacheAge < 900 && is_array($cachedSurface['hours'] ?? null)) {
                        $fsHours = $cachedSurface['hours'];
                        $this->DebugLog('Forecast.Solar', $name . ' | Cache ' . round($cacheAge / 60, 1) . ' min | kein API-Aufruf');
                    } elseif ($retryAfterTs > time()) {
                        if (is_array($cachedSurface) && is_array($cachedSurface['hours'] ?? null)) {
                            $fsHours = $cachedSurface['hours'];
                            $this->DebugLog('Forecast.Solar', $name . ' | Rate-Limit bis ' . date('H:i:s', $retryAfterTs) . ' | Cache verwendet');
                        } else {
                            throw new Exception('Forecast.Solar Rate-Limit aktiv bis ' . date('d.m.Y H:i:s', $retryAfterTs) . '; kein Flächen-Cache vorhanden.');
                        }
                    } else {
                        $this->ForecastDiagnosticStep('Forecast.Solar START | ' . $name);
                            $fsHours = $this->FetchForecastSolarSurface($lat, $lon, $tilt, $azimuth, $kwp, $name);
                            $this->ForecastDiagnosticStep('Forecast.Solar ENDE | ' . $name);
                    }
                    $forecastSolarCache[$key] = [
                        'savedAt' => time(),
                        'name' => $name,
                        'kwp' => $kwp,
                        'tilt' => $tilt,
                        'azimuth' => $azimuth,
                        'hours' => $fsHours
                    ];
                } catch (Throwable $e) {
                    // Bei Rate-Limit/temporärem Fehler niemals nur die andere Fläche verwenden.
                    // Eine vorhandene, höchstens 6 h alte Flächenprognose darf als Ersatz dienen.
                    $cached = $forecastSolarCache[$key] ?? null;
                    if (is_array($cached) && isset($cached['hours']) && is_array($cached['hours']) &&
                        (time() - (int)($cached['savedAt'] ?? 0)) <= 21600) {
                        $fsHours = $cached['hours'];
                        $fromCache = true;
                        $this->DebugLog('Forecast.Solar', $name . ' | Live-Abruf fehlgeschlagen, Cache verwendet: ' . $e->getMessage(), 0);
                    } else {
                        $forecastSolarSurfaceStatus[] = $name . ': FEHLER – ' . $e->getMessage();
                        $this->DebugLog('Forecast.Solar', $name . ' | FEHLER, kein gültiger Cache: ' . $e->getMessage(), 0);
                    }
                }

                if (is_array($fsHours) && count($fsHours) > 0) {
                    $forecastSolarResolved++;
                    $sum = 0.0;
                    foreach ($fsHours as $ts => $powerKW) {
                        $correctedKW = max(0.0, (float)$powerKW) * $manualFactor * $this->ReadPropertyFloat('GlobalPVFactor');
                        if (!isset($forecastSolarTempHours[$ts])) $forecastSolarTempHours[$ts] = 0.0;
                        $forecastSolarTempHours[$ts] += $correctedKW;
                        if (!isset($surfaceSourceHours['forecastsolar'][$name])) $surfaceSourceHours['forecastsolar'][$name] = [];
                        $surfaceSourceHours['forecastsolar'][$name][(int)$ts] = $correctedKW;
                        if (date('Y-m-d', (int)$ts) === date('Y-m-d', strtotime('tomorrow'))) $sum += $correctedKW;
                    }
                    $surfaceTotalsBySource['forecastsolar'][$name] = $sum;
                    $forecastSolarSurfaceStatus[] = $name . ': ' . number_format($sum, 2, ',', '.') . ' kWh morgen' . ($fromCache ? ' (Cache)' : ' (Live)');
                    $this->SetActionFeedback('Prognose: Forecast.Solar – ' . $name . ' OK, ' . number_format($sum, 2, ',', '.') . ' kWh morgen' . ($fromCache ? ' (Cache)' : ''));
                    $this->DebugLog('Forecast.Solar', $name . ' | morgen=' . round($sum, 3) . ' kWh | kWp=' . $kwp . ' | Azimut=' . $azimuth . ' | Neigung=' . $tilt . ' | ' . ($fromCache ? 'Cache' : 'Live'));
                }
            }

            $actualW = $this->ReadSurfaceActualPower($surface);
            // Kalibrierung erfolgt ausschließlich aus Archivdaten: stündliche Prognose-kWh
            // gegen die archivierten Originalwerte der zugeordneten PV-Strings.

            $diag = $this->GetPVCalibrationDiagnostics($calibration, $key);
            $surfaceCalibration[$name] = [
                'key' => $key, 'manualFactor' => $manualFactor, 'orientationKnown' => $orientationKnown,
                'autoEnabled' => $autoEnabled, 'autoFactor' => $autoFactor,
                'effectiveFactor' => $manualFactor * ($autoEnabled ? $autoFactor : 1.0),
                'expectedBaseW' => $currentExpectedBaseW,
                'expectedCorrectedW' => $currentExpectedBaseW * ($autoEnabled
                    ? $this->GetPVForecastHourFactor($calibration, $key, (int)date('G'), $autoFactor)
                    : 1.0),
                'actualW' => $actualW,
                'currentRatio' => ($actualW !== null && $currentExpectedBaseW > 0.0) ? ($actualW / $currentExpectedBaseW) : null,
                'sampleCount' => $diag['sampleCount'], 'sumExpectedKWh' => $diag['sumExpectedKWh'],
                'sumActualKWh' => $diag['sumActualKWh'], 'learnedRatio' => $diag['ratio'],
                'firstSampleTs' => $diag['firstSampleTs'], 'lastSampleTs' => $diag['lastSampleTs'],
                'calibrationBlocked' => (bool)$calibrationFeedInGate['blocked'],
                'calibrationBlockReason' => (string)$calibrationFeedInGate['text']
            ];
        }

        if ($useForecastSolar) {
            $this->WriteAttributeString('ForecastSolarSurfaceCacheJSON', json_encode($forecastSolarCache));
            if ($forecastSolarRequired > 0 && $forecastSolarResolved === $forecastSolarRequired) {
                $sourceHours['forecastsolar'] = $forecastSolarTempHours;
                $sumAll = array_sum($surfaceTotalsBySource['forecastsolar']);
                $forecastSolarSurfaceStatus[] = 'Gesamt: ' . number_format($sumAll, 2, ',', '.') . ' kWh morgen';
            } else {
                // Wichtig: keine Teilanlage in die Quellengewichtung geben.
                $sourceHours['forecastsolar'] = [];
                $forecastSolarSurfaceStatus[] = 'Forecast.Solar nicht verwendet: nur ' . $forecastSolarResolved . ' von ' . $forecastSolarRequired . ' Flächen verfügbar.';
            }
            // Detailstatus wird gesammelt; die kompakte Anbieter-HTMLBox wird nach Abschluss der Prognose gerendert.
        }

        // pvnode V2 arbeitet mit einem in pvnode gespeicherten Gesamtstandort
        // (Site-ID) und liefert deshalb die gesamte Anlage in einer Abfrage.
        if ($usePVNode) {
            $pvnodeKey = trim($this->ReadPropertyString('PVNodeAPIKey'));
            $pvnodeSiteID = trim($this->ReadPropertyString('PVNodeSiteID'));

            if ($pvnodeKey === '' || $pvnodeSiteID === '') {
                $this->WriteAttributeString('PVNodeLastError', 'API-Key und Site-ID sind erforderlich.');
                $this->DebugLog('pvnode', 'Aktiviert, aber API-Key oder Site-ID fehlt. Es wurde keine API-Anfrage gesendet.', 0);
            } else {
                try {
                    $sourceHours['pvnode'] = $this->GetPVNodeForecastLimited($pvnodeKey, $pvnodeSiteID);

                    // pvnode V2 kann mit include=strings die einzelnen, in der Site
                    // konfigurierten Solarflächen liefern. Diese werden positionsstabil den
                    // aktiven SBO-PV-Flächen zugeordnet. Nur bei eindeutiger 1:1-Anzahl wird
                    // die Flächenprognose verwendet; eine künstliche kWp-Verteilung findet
                    // ausdrücklich nicht statt.
                    $pvnodeCache = json_decode($this->ReadAttributeString('PVNodeForecastCacheJSON'), true);
                    $pvnodeStringHours = is_array($pvnodeCache['stringHours'] ?? null) ? $pvnodeCache['stringHours'] : [];
                    $activeSurfaceNames = [];
                    foreach ($surfaces as $pvIdx => $pvSurface) {
                        if (empty($pvSurface['Active'])) continue;
                        $pvName = trim((string)($pvSurface['Name'] ?? 'PV'));
                        if ($pvName === '') $pvName = 'PV ' . ($pvIdx + 1);
                        $activeSurfaceNames[] = $pvName;
                    }
                    ksort($pvnodeStringHours, SORT_NUMERIC);
                    if (count($pvnodeStringHours) === count($activeSurfaceNames) && count($activeSurfaceNames) > 0) {
                        $stringSets = array_values($pvnodeStringHours);
                        foreach ($activeSurfaceNames as $pvPos => $pvName) {
                            $surfaceSourceHours['pvnode'][$pvName] = [];
                            $tomorrowSurface = 0.0;
                            foreach (($stringSets[$pvPos] ?? []) as $pvTs => $pvKW) {
                                $surfaceSourceHours['pvnode'][$pvName][(int)$pvTs] = max(0.0, (float)$pvKW);
                                if (date('Y-m-d', (int)$pvTs) === date('Y-m-d', strtotime('tomorrow'))) {
                                    $tomorrowSurface += max(0.0, (float)$pvKW);
                                }
                            }
                            $surfaceTotalsBySource['pvnode'][$pvName] = $tomorrowSurface;
                        }
                        $this->DebugLog('pvnode', 'Flächen zerlegt | Strings=' . count($pvnodeStringHours) . ' | SBO-Flächen=' . implode(', ', $activeSurfaceNames));
                    } elseif (count($pvnodeStringHours) > 0) {
                        $this->DebugLog('pvnode', 'Strings vorhanden, aber keine eindeutige 1:1-Zuordnung | pvnode=' . count($pvnodeStringHours) . ' | SBO=' . count($activeSurfaceNames) . '. Keine künstliche Verteilung.', 0);
                    } else {
                        $this->DebugLog('pvnode', 'Antwort/Cache enthält keine nutzbaren String-Daten. Standortgesamt bleibt verfügbar.', 0);
                    }
                    $this->DebugLog('pvnode', 'Prognose bereit | Site-ID=' . $pvnodeSiteID . ' | Stunden=' . count($sourceHours['pvnode']));
                } catch (Throwable $e) {
                    $this->WriteAttributeString('PVNodeLastError', $e->getMessage());
                    $this->DebugLog('pvnode', $e->getMessage(), 0);
                }
            }
        }

        $this->WriteAttributeString('PVCalibrationJSON', json_encode($calibration));

        $availableSources = [];
        if ($useOpenMeteo && count($sourceHours['openmeteo']) > 0) $availableSources[] = 'openmeteo';
        if ($useForecastSolar && count($sourceHours['forecastsolar']) > 0) $availableSources[] = 'forecastsolar';
        if ($usePVNode && count($sourceHours['pvnode']) > 0) $availableSources[] = 'pvnode';
        if (count($availableSources) === 0) throw new Exception('Keine PV-Prognosequelle lieferte verwertbare Daten.');

        $this->StorePVSourceForecastHistory($sourceHours, $availableSources);

        $enabledSources = [];
        if ($useOpenMeteo) $enabledSources[] = 'openmeteo';
        if ($useForecastSolar) $enabledSources[] = 'forecastsolar';
        if ($usePVNode) $enabledSources[] = 'pvnode';

        // Die gelernte Gewichtung gehört zur konfigurierten Quelle und bleibt
        // erhalten, auch wenn ein Anbieter bei einem einzelnen Abruf ausfällt.
        $weights = $this->CalculatePVSourceWeights($enabledSources);
        $this->WriteAttributeString('PVSourceWeightsJSON', json_encode($weights));
        $this->DebugLog('PV-Gewichtung', array_map(fn($v) => round((float)$v * 100, 2), $weights));

        // Auto-Faktor als letzter Schritt NACH der Quellengewichtung.
        // Die Flächen werden nach ihrer tatsächlich verglichenen Prognoseenergie gewichtet,
        // NICHT nach installierten kWp. Dadurch entspricht der Anlagenfaktor exakt:
        // Summe Ist-Energie / Summe Prognose-vor-Auto über alle freigegebenen PV-Flächen.
        $plantExpectedKWh = 0.0;
        $plantCorrectedKWh = 0.0;
        $plantReadySurfaces = 0;
        foreach ($surfaces as $idx => $surface) {
            if (empty($surface['Active']) || empty($surface['AutoCalibrate'])) continue;
            $nameAuto = trim((string)($surface['Name'] ?? 'PV'));
            if ($nameAuto === '') $nameAuto = 'PV ' . ($idx + 1);
            $keyAuto = $this->SurfaceKey($nameAuto, $idx);
            $diagAuto = $this->GetPVCalibrationDiagnostics($calibration, $keyAuto);
            if (empty($diagAuto['factorReady'])) continue;
            $expectedAuto = max(0.0, (float)($diagAuto['sumExpectedKWh'] ?? 0.0));
            if ($expectedAuto <= 0.0) continue;
            // Der aktuelle, über identische Ist-/Prognoseintervalle gemessene Faktor ist maßgeblich.
            // Saisonwerte sind Langzeitwissen und dürfen einen belastbaren aktuellen Faktor nicht ersetzen.
            $factorAuto = max(
                $this->ReadPropertyFloat('PVCalibrationMinFactor'),
                min($this->ReadPropertyFloat('PVCalibrationMaxFactor'), (float)($diagAuto['ratio'] ?? 1.0))
            );
            $plantExpectedKWh += $expectedAuto;
            $plantCorrectedKWh += $expectedAuto * $factorAuto;
            $plantReadySurfaces++;
        }
        $plantAutoFactor = ($plantReadySurfaces > 0 && $plantExpectedKWh > 0.0)
            ? ($plantCorrectedKWh / $plantExpectedKWh)
            : 1.0;

        // v1.9.82: Die PV-Autokorrektur arbeitet wieder ausschließlich mit einem
        // generellen Faktor je PV-Fläche. Stundenfaktoren werden nicht mehr verwendet.
        // Der Anlagenfaktor ist das energiegewichtete Mittel der freigegebenen Flächen.
        $plantHourlyFactors = [];
        $surfaceHourlyFactors = [];

        $allTs = [];
        foreach ($availableSources as $source) foreach ($sourceHours[$source] as $ts => $_) $allTs[(int)$ts] = true;
        ksort($allTs);
        $hours = []; $todayBeforeAuto = 0.0; $tomorrowBeforeAuto = 0.0;
        foreach (array_keys($allTs) as $ts) {
            $weighted = 0.0; $weightSum = 0.0; $sourceValues = [];
            foreach ($availableSources as $source) {
                if (!array_key_exists($ts, $sourceHours[$source])) continue;
                $value = max(0.0, (float)$sourceHours[$source][$ts]);
                $w = max(0.0, (float)($weights[$source] ?? 0.0));
                $weighted += $value * $w; $weightSum += $w;
                $sourceValues[$source] = $value; // Provider-Debuglinien bleiben unverändert.
            }
            if ($weightSum <= 0.0) continue;
            $rawCombinedKW = $weighted / $weightSum;
            $hourAutoFactor = $plantAutoFactor;
            $hours[$ts] = ['totalKW' => max(0.0, $rawCombinedKW * $plantAutoFactor), 'totalKWBeforeAuto' => $rawCombinedKW, 'autoFactor' => $plantAutoFactor, 'surfaces' => [], 'sources' => $sourceValues];
            $day = date('Y-m-d', (int)$ts);
            if ($day === date('Y-m-d')) $todayBeforeAuto += $rawCombinedKW;
            if ($day === date('Y-m-d', strtotime('tomorrow'))) $tomorrowBeforeAuto += $rawCombinedKW;
        }

        // Kombinierte Stundenprognose auf die konfigurierten PV-Flächen verteilen.
        // Open-Meteo/Forecast.Solar liefern die Form je Fläche; pvnode liefert nur den
        // Gesamtstandort und wird deshalb proportional zu diesen Flächenanteilen verteilt.
        // Summe aller Flächen entspricht dadurch in jeder Stunde exakt der kombinierten
        // Anlagenprognose VOR Auto-Korrektur.
        $surfaceForecastHours = [];
        foreach ($surfaces as $idx => $surface) {
            if (empty($surface['Active'])) continue;
            $n = trim((string)($surface['Name'] ?? 'PV')); if ($n === '') $n = 'PV ' . ($idx + 1);
            $surfaceForecastHours[$n] = [];
        }
        foreach ($hours as $ts => $h) {
            $shape = []; $shapeSum = 0.0;
            foreach ($surfaceForecastHours as $n => $_) {
                $v = 0.0; $ws = 0.0;
                foreach (['openmeteo','forecastsolar','pvnode'] as $src) {
                    if (!isset($surfaceSourceHours[$src][$n][$ts])) continue;
                    $w = max(0.0, (float)($weights[$src] ?? 0.0));
                    $v += max(0.0, (float)$surfaceSourceHours[$src][$n][$ts]) * $w; $ws += $w;
                }
                $shape[$n] = $ws > 0.0 ? $v / $ws : 0.0; $shapeSum += $shape[$n];
            }
            if ($shapeSum <= 0.0) continue;
            $plantKWh = max(0.0, (float)($h['totalKWBeforeAuto'] ?? 0.0));
            foreach ($shape as $n => $v) $surfaceForecastHours[$n][(int)$ts] = $plantKWh * $v / $shapeSum;
        }
        $this->StorePVCalibrationHourlyForecast($surfaceForecastHours, $surfaces);

        $today = 0.0; $tomorrow = 0.0;
        $todayDate = date('Y-m-d'); $tomorrowDate = date('Y-m-d', strtotime('tomorrow'));
        foreach ($hours as $ts => $h) {
            $day = date('Y-m-d', (int)$ts);
            if ($day === $todayDate) $today += $h['totalKW'];
            if ($day === $tomorrowDate) $tomorrow += $h['totalKW'];
        }

        $surfaceTotals = [];
        foreach ($surfaces as $idx => $surface) {
            if (empty($surface['Active'])) continue;
            $name = trim((string)($surface['Name'] ?? 'PV'));
            if ($name === '') $name = 'PV ' . ($idx + 1);
            $v = 0.0; $ws = 0.0;
            foreach ($availableSources as $source) {
                if (!isset($surfaceTotalsBySource[$source][$name])) continue;
                $w = (float)($weights[$source] ?? 0.0);
                $v += (float)$surfaceTotalsBySource[$source][$name] * $w; $ws += $w;
            }
            $surfaceTotals[$name] = $ws > 0 ? $v / $ws : 0.0;
        }

        $morningTs = $this->DetermineMorningEnd(0, strtotime('tomorrow 00:00'));
        $this->DebugLog('DayNight', 'Nachtende morgen=' . date('Y-m-d H:i', $morningTs) . ' | ' . ($this->ReadPropertyBoolean('AutomaticDayNight') ? 'automatisch' : 'manuell'));

        return [
            'todayKWh' => $today, 'tomorrowKWh' => $tomorrow,
            'todayKWhBeforeAuto' => $todayBeforeAuto, 'tomorrowKWhBeforeAuto' => $tomorrowBeforeAuto,
            'plantAutoFactor' => $plantAutoFactor, 'plantHourlyFactors' => $plantHourlyFactors, 'surfaceHourlyFactors' => $surfaceHourlyFactors, 'morningTs' => $morningTs,
            'hours' => $hours, 'surfaceTotals' => $surfaceTotals, 'surfaceCalibration' => $surfaceCalibration,
            'forecastSources' => $availableSources, 'forecastSourceWeights' => $weights, 'providerSurfaceTomorrow' => $surfaceTotalsBySource
        ];
    }

    private function FetchForecastSolarSurface(float $lat, float $lon, float $tilt, float $azimuth, float $kwp, string $surfaceName = ''): array
    {
        $key = trim($this->ReadPropertyString('ForecastSolarAPIKey'));
        $base = 'https://api.forecast.solar/';
        if ($key !== '') $base .= rawurlencode($key) . '/';
        $url = $base . 'estimate/' . rawurlencode((string)$lat) . '/' . rawurlencode((string)$lon) . '/' .
            rawurlencode((string)$tilt) . '/' . rawurlencode((string)$azimuth) . '/' . rawurlencode((string)$kwp);
        $meta = ['Fläche'=>$surfaceName,'kWp'=>$kwp,'Azimut'=>$azimuth,'Neigung'=>$tilt];

        // Forecast.Solar bevorzugt über cURL abrufen. Das liefert bei HTTPS-/DNS-/
        // Verbindungsproblemen eine wesentlich aussagekräftigere Diagnose als
        // file_get_contents(). Falls cURL nicht verfügbar ist, bleibt der Stream-Fallback.
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS => 3,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT => 8,
                CURLOPT_USERAGENT => 'IP-Symcon-SmartBatteryOptimizer/1.9.20',
                CURLOPT_HTTPHEADER => ['Accept: application/json'],
                CURLOPT_HEADER => true
            ]);
            $started = microtime(true);
            $rawWithHeaders = curl_exec($ch);
            $duration = (microtime(true) - $started) * 1000.0;
            $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $headerSize = (int)curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $effectiveUrl = (string)curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
            $curlErrNo = curl_errno($ch);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($rawWithHeaders === false) {
                $detail = 'cURL Fehler ' . $curlErrNo . ($curlError !== '' ? ': ' . $curlError : '');
                $this->AddProviderDebug('Forecast.Solar', $url, $meta + ['Methode'=>'cURL','Effective-URL'=>$effectiveUrl], $detail, $status, $duration);
                throw new Exception('Forecast.Solar: ' . $detail, $status);
            }

            $headers = substr((string)$rawWithHeaders, 0, $headerSize);
            $raw = substr((string)$rawWithHeaders, $headerSize);

            // Forecast.Solar liefert bei HTTP 429 den exakten Freigabezeitpunkt.
            if ($status === 429 && preg_match('/^x-ratelimit-retry-at:\s*(.+)$/mi', $headers, $rm)) {
                $retryTs = strtotime(trim($rm[1]));
                if ($retryTs !== false && $retryTs > time()) {
                    $this->WriteAttributeInteger('ForecastSolarRetryAfterTs', $retryTs);
                }
            } elseif ($status >= 200 && $status < 300) {
                // Erfolgreicher Request hebt eine eventuell abgelaufene Sperre auf.
                $this->WriteAttributeInteger('ForecastSolarRetryAfterTs', 0);
            }
            $this->AddProviderDebug('Forecast.Solar', $url, $meta + ['Methode'=>'cURL','Effective-URL'=>$effectiveUrl,'Response-Header'=>$headers], $raw, $status, $duration);

            if ($status >= 400 || $status === 0) {
                throw new Exception('Forecast.Solar: HTTP ' . $status . ($raw !== '' ? ' – ' . substr($raw, 0, 300) : ''), $status);
            }
            $data = json_decode($raw, true);
            if (!is_array($data)) {
                throw new Exception('Forecast.Solar: Antwort ist kein gültiges JSON.', $status);
            }
        } else {
            $opts = ['http' => [
                'timeout' => 8,
                'ignore_errors' => true,
                'follow_location' => 1,
                'max_redirects' => 3,
                'header' => "User-Agent: IP-Symcon-SmartBatteryOptimizer/1.9.20\r\nAccept: application/json\r\n"
            ]];
            $ctx = stream_context_create($opts);
            $started = microtime(true);
            error_clear_last();
            $raw = @file_get_contents($url, false, $ctx);
            $duration = (microtime(true) - $started) * 1000.0;
            $lastError = error_get_last();
            $headers = isset($http_response_header) && is_array($http_response_header) ? implode("\n", $http_response_header) : '';
            $status = 0;
            if (isset($http_response_header) && is_array($http_response_header)) {
                foreach ($http_response_header as $line) {
                    if (preg_match('/^HTTP\/\S+\s+(\d{3})/', $line, $m)) $status = (int)$m[1];
                }
            }
            $errorText = is_array($lastError) ? (string)($lastError['message'] ?? '') : '';
            $debugResponse = $raw === false ? ('Stream-Fehler: ' . ($errorText !== '' ? $errorText : 'unbekannt')) : $raw;
            $this->AddProviderDebug('Forecast.Solar', $url, $meta + ['Methode'=>'PHP Stream','Response-Header'=>$headers], $debugResponse, $status, $duration);
            if ($raw === false) throw new Exception('Forecast.Solar HTTP-Abruf fehlgeschlagen' . ($errorText !== '' ? ': ' . $errorText : ''), $status);
            $data = json_decode($raw, true);
            if ($status >= 400) throw new Exception('Forecast.Solar: HTTP ' . $status, $status);
            if (!is_array($data)) throw new Exception('Forecast.Solar: Antwort ist kein gültiges JSON.', $status);
        }

        if (!isset($data['result']['watts']) || !is_array($data['result']['watts'])) {
            throw new Exception('Ungültige Forecast.Solar-Antwort.');
        }

        $points = [];
        foreach ($data['result']['watts'] as $timeStr => $watts) {
            $ts = strtotime((string)$timeStr);
            if ($ts === false) continue;
            $hourTs = strtotime(date('Y-m-d H:00:00', $ts));
            if (!isset($points[$hourTs])) $points[$hourTs] = [];
            $points[$hourTs][] = max(0.0, (float)$watts) / 1000.0;
        }
        $hours = [];
        foreach ($points as $ts => $values) $hours[$ts] = array_sum($values) / max(1, count($values));
        ksort($hours);
        return $hours;
    }

    private function GetPVNodeForecastLimited(string $apiKey, string $siteID): array
    {
        $maxPerDay = max(1, min(144, $this->ReadPropertyInteger('PVNodeMaxRequestsPerDay')));
        $today = date('Y-m-d');
        $storedDay = $this->ReadAttributeString('PVNodeRequestDay');
        $count = $this->ReadAttributeInteger('PVNodeRequestCount');
        if ($storedDay !== $today) {
            $storedDay = $today;
            $count = 0;
            $this->WriteAttributeString('PVNodeRequestDay', $today);
            $this->WriteAttributeInteger('PVNodeRequestCount', 0);
        }

        $cache = json_decode($this->ReadAttributeString('PVNodeForecastCacheJSON'), true);
        if (!is_array($cache)) $cache = [];
        $cachedHours = (($cache['siteID'] ?? '') === $siteID && isset($cache['hours']) && is_array($cache['hours'])) ? $cache['hours'] : [];
        $normalizedCache = [];
        foreach ($cachedHours as $ts => $value) $normalizedCache[(int)$ts] = (float)$value;
        ksort($normalizedCache);
        $cachedStringHours = (($cache['siteID'] ?? '') === $siteID && isset($cache['stringHours']) && is_array($cache['stringHours'])) ? $cache['stringHours'] : [];

        $nextPollTs = $this->ReadAttributeInteger('PVNodeNextPollTs');
        $now = time();
        $reason = '';
        if ($count >= $maxPerDay) {
            $reason = 'Tageslimit erreicht (' . $count . '/' . $maxPerDay . ')';
        } elseif ($nextPollTs > $now && count($normalizedCache) > 0) {
            $reason = 'neue Daten erst ab ' . date('d.m.Y H:i:s', $nextPollTs);
        }

        if ($reason !== '' && count($normalizedCache) > 0) {
            $this->DebugLog('pvnode', 'CACHE | ' . $reason . ' | Stunden=' . count($normalizedCache));
            return $normalizedCache;
        }
        if ($reason !== '' && count($normalizedCache) === 0) {
            $this->DebugLog('pvnode', 'Kein Cache vorhanden, obwohl ' . $reason . '. Kein zusätzlicher API-Abruf.', 0);
            return [];
        }

        // Der Zähler wird direkt vor dem HTTP-Aufruf erhöht. So kann ein Timeout oder
        // Serverfehler nicht zu mehreren automatischen Wiederholungen im selben Lauf führen.
        $count++;
        $this->WriteAttributeString('PVNodeRequestDay', $today);
        $this->WriteAttributeInteger('PVNodeRequestCount', $count);
        $this->DebugLog('pvnode', 'LIVE | API-Abruf ' . $count . '/' . $maxPerDay . ' START');

        try {
            $result = $this->FetchPVNodeForecastLive($apiKey, $siteID);
            $hours = $result['hours'];
            $stringHours = is_array($result['stringHours'] ?? null) ? $result['stringHours'] : [];
            $next = (int)$result['nextPollTs'];
            $this->WriteAttributeString('PVNodeForecastCacheJSON', json_encode([
                'siteID' => $siteID,
                'fetchedAt' => $now,
                'hours' => $hours,
                'stringHours' => $stringHours
            ]));
            $this->WriteAttributeInteger('PVNodeNextPollTs', $next);
            $this->WriteAttributeInteger('PVNodeConsecutiveRejects', 0);
            $this->WriteAttributeString('PVNodeLastError', '');
            $this->DebugLog('pvnode', 'LIVE | API-Abruf ' . $count . '/' . $maxPerDay . ' ENDE | Stunden=' . count($hours) . ($next > 0 ? ' | next_poll_at=' . date('d.m.Y H:i:s', $next) : ''));
            return $hours;
        } catch (Throwable $e) {
            $this->WriteAttributeString('PVNodeLastError', $e->getMessage());
            $this->DebugLog('pvnode', 'LIVE fehlgeschlagen | ' . $e->getMessage() . (count($normalizedCache) > 0 ? ' | verwende Cache' : ''), 0);
            if (count($normalizedCache) > 0) return $normalizedCache;
            throw $e;
        }
    }

    public function TestPVNodeAPI(): string
    {
        $apiKey = trim($this->ReadPropertyString('PVNodeAPIKey'));
        $siteID = trim($this->ReadPropertyString('PVNodeSiteID'));
        if ($apiKey === '' || $siteID === '') {
            return "FEHLER: pvnode API-Key und Site-ID müssen in der Instanzkonfiguration eingetragen und übernommen sein.";
        }

        $url = 'https://api.pvnode.com/v2/forecast/' . rawurlencode($siteID) . '?forecast_days=1&timezone=utc&include=strings';
        $headers = [
            'User-Agent: IP-Symcon-SmartBatteryOptimizer/1.9.88',
            'Authorization: Bearer ' . $apiKey,
            'Accept: application/json'
        ];
        $opts = [
            'http' => [
                'method' => 'GET',
                'timeout' => 15,
                'ignore_errors' => true,
                'header' => implode("\r\n", $headers) . "\r\n"
            ]
        ];
        $ctx = stream_context_create($opts);
        $started = microtime(true);
        $raw = @file_get_contents($url, false, $ctx);
        $elapsedMs = (microtime(true) - $started) * 1000.0;

        $status = 0;
        $responseHeaders = [];
        if (isset($http_response_header) && is_array($http_response_header)) {
            $responseHeaders = $http_response_header;
            foreach ($http_response_header as $line) {
                if (preg_match('/^HTTP\/\S+\s+(\d{3})/', $line, $m)) $status = (int)$m[1];
            }
        }

        $out = [];
        $out[] = 'pvnode API-Rohdatentest';
        $out[] = 'Zeit: ' . date('d.m.Y H:i:s');
        $out[] = 'URL: ' . $url;
        $out[] = 'Site-ID: ' . $siteID;
        $out[] = 'HTTP-Status: ' . ($status > 0 ? (string)$status : 'nicht ermittelbar');
        $out[] = 'Dauer: ' . number_format($elapsedMs, 0, ',', '.') . ' ms';
        $out[] = 'API-Key: [ausgeblendet]';
        if (count($responseHeaders) > 0) {
            $out[] = '';
            $out[] = '--- RESPONSE-HEADER ---';
            foreach ($responseHeaders as $line) $out[] = (string)$line;
        }
        $out[] = '';
        $out[] = '--- RESPONSE-BODY (RAW) ---';
        if ($raw === false) {
            $err = error_get_last();
            $out[] = 'HTTP-Abruf fehlgeschlagen.';
            if (is_array($err) && isset($err['message'])) $out[] = 'PHP: ' . (string)$err['message'];
        } else {
            $out[] = $raw;
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                $out[] = '';
                $out[] = '--- KURZAUSWERTUNG ---';
                $out[] = 'Top-Level-Felder: ' . implode(', ', array_keys($decoded));
                $out[] = 'values: ' . (is_array($decoded['values'] ?? null) ? count($decoded['values']) . ' Einträge' : 'nicht vorhanden');
                $out[] = 'strings: ' . (is_array($decoded['strings'] ?? null) ? count($decoded['strings']) . ' Einträge' : 'nicht vorhanden');
                if (isset($decoded['available'])) $out[] = 'available: ' . json_encode($decoded['available'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                if (isset($decoded['included'])) $out[] = 'included: ' . json_encode($decoded['included'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                if (is_array($decoded['strings'] ?? null) && count($decoded['strings']) > 0) {
                    $ids=[];
                    foreach ($decoded['strings'] as $row) {
                        if (!is_array($row)) continue;
                        $idx = array_key_exists('string_index',$row) ? (string)$row['string_index'] : '?';
                        $sid = array_key_exists('string_id',$row) ? (string)$row['string_id'] : '-';
                        $ids[$idx.'|'.$sid]=true;
                    }
                    $out[] = 'erkannte Strings (index|id): ' . implode(', ', array_keys($ids));
                }
            } else {
                $out[] = '';
                $out[] = 'JSON-Auswertung: Response ist kein gültiges JSON (' . json_last_error_msg() . ').';
            }
        }

        $result = implode("\n", $out);
        $this->DebugLog('pvnode API-Test', 'HTTP=' . $status . ' | Site-ID=' . $siteID . ' | Body=' . ($raw === false ? 'FEHLER' : strlen($raw) . ' Bytes'));
        return $result;
    }

    private function FetchPVNodeForecastLive(string $apiKey, string $siteID): array
    {
        $url = 'https://api.pvnode.com/v2/forecast/' . rawurlencode($siteID) . '?forecast_days=1&timezone=utc&include=strings';

        try {
            $data = $this->HttpGetJsonWithHeaders($url, [
                'Authorization: Bearer ' . $apiKey
            ], 'pvnode', ['Site-ID'=>$siteID,'Zeitzone'=>'utc']);
        } catch (Throwable $e) {
            $status = (int)$e->getCode();
            if (in_array($status, [400, 401, 403, 404, 422], true)) {
                $this->RegisterPVNodeRejection($status, $e->getMessage());
            }
            throw $e;
        }

        if (!isset($data['values']) || !is_array($data['values'])) {
            throw new Exception('pvnode: Antwort enthält keine Prognosewerte.');
        }

        $quarterValues = [];
        foreach ($data['values'] as $row) {
            if (!is_array($row) || !isset($row['timestamp'], $row['pv_power'])) continue;
            $ts = strtotime((string)$row['timestamp']);
            if ($ts === false) continue;
            $hourTs = strtotime(date('Y-m-d H:00:00', $ts));
            if (!isset($quarterValues[$hourTs])) $quarterValues[$hourTs] = [];
            $quarterValues[$hourTs][] = max(0.0, (float)$row['pv_power']) / 1000.0;
        }

        $hours = [];
        foreach ($quarterValues as $hourTs => $values) {
            if (count($values) === 0) continue;
            $hours[(int)$hourTs] = array_sum($values) / count($values);
        }
        ksort($hours);
        if (count($hours) === 0) throw new Exception('pvnode: Keine verwertbaren PV-Leistungswerte erhalten.');

        // Optional angeforderte pvnode-Stringdaten: pro Solarfläche dieselbe
        // 15-Minuten-Zeitreihe, zu Stundenmittelwerten in kW verdichtet.
        $stringQuarterValues = [];
        if (isset($data['strings']) && is_array($data['strings'])) {
            foreach ($data['strings'] as $row) {
                if (!is_array($row) || !isset($row['timestamp'], $row['pv_power'], $row['string_index'])) continue;
                $ts = strtotime((string)$row['timestamp']);
                if ($ts === false) continue;
                $idx = (int)$row['string_index'];
                $hourTs = strtotime(date('Y-m-d H:00:00', $ts));
                if (!isset($stringQuarterValues[$idx])) $stringQuarterValues[$idx] = [];
                if (!isset($stringQuarterValues[$idx][$hourTs])) $stringQuarterValues[$idx][$hourTs] = [];
                $stringQuarterValues[$idx][$hourTs][] = max(0.0, (float)$row['pv_power']) / 1000.0;
            }
        }
        $stringHours = [];
        foreach ($stringQuarterValues as $idx => $byHour) {
            foreach ($byHour as $hourTs => $values) {
                if (count($values) === 0) continue;
                $stringHours[(int)$idx][(int)$hourTs] = array_sum($values) / count($values);
            }
            if (isset($stringHours[(int)$idx])) ksort($stringHours[(int)$idx]);
        }
        ksort($stringHours, SORT_NUMERIC);

        $nextPollRaw = $data['next_poll_at'] ?? ($data['meta']['next_poll_at'] ?? ($data['metadata']['next_poll_at'] ?? null));
        $nextPollTs = 0;
        if (is_numeric($nextPollRaw)) {
            $n = (int)$nextPollRaw;
            $nextPollTs = $n > 20000000000 ? (int)floor($n / 1000) : $n;
        } elseif (is_string($nextPollRaw) && trim($nextPollRaw) !== '') {
            $parsed = strtotime($nextPollRaw);
            if ($parsed !== false) $nextPollTs = $parsed;
        }

        return ['hours' => $hours, 'stringHours' => $stringHours, 'nextPollTs' => $nextPollTs];
    }

    private function RegisterPVNodeRejection(int $status, string $message): void
    {
        $count = $this->ReadAttributeInteger('PVNodeConsecutiveRejects') + 1;
        $this->WriteAttributeInteger('PVNodeConsecutiveRejects', $count);
        $this->WriteAttributeString('PVNodeLastError', 'HTTP ' . $status . ': ' . $message);

        if ($count < 3) {
            $this->DebugLog('pvnode', 'Zugang/Site abgelehnt (' . $count . '/3, HTTP ' . $status . ').', 0);
            return;
        }

        $this->WriteAttributeBoolean('PVNodeAutoDisabled', true);
        $this->DebugLog('pvnode', 'Nach 3 aufeinanderfolgenden Ablehnungen automatisch deaktiviert. Erneutes Anhaken aktiviert pvnode wieder.', 0);

        // Konfigurationshaken tatsächlich entfernen. Erst wenn der Benutzer pvnode
        // später wieder anhakt und übernimmt, wird die Sperre in ApplyChanges aufgehoben.
        @IPS_SetProperty($this->InstanceID, 'UsePVNodeForecast', false);
        @IPS_ApplyChanges($this->InstanceID);
    }

    private function StorePVSourceForecastHistory(array $sourceHours, array $sources): void
    {
        $history = json_decode($this->ReadAttributeString('PVSourceForecastHistoryJSON'), true);
        if (!is_array($history)) $history = [];
        $now = time();

        foreach ($sources as $source) {
            foreach ($sourceHours[$source] as $ts => $value) {
                $ts = (int)$ts;
                $date = date('Y-m-d', $ts);
                $hour = (int)date('G', $ts);
                if (!isset($history[$source][$date])) $history[$source][$date] = array_fill(0, 24, null);

                // Vollständig vergangene Prognosestunden niemals nachträglich überschreiben.
                if (($ts + 3600) <= $now && $history[$source][$date][$hour] !== null) continue;
                $history[$source][$date][$hour] = round(max(0.0, (float)$value), 4);
            }
        }

        $cutoff = strtotime('-' . max(7, $this->ReadPropertyInteger('ForecastWeightLearningDays') + 2) . ' days 00:00:00');
        foreach ($history as $source => $days) {
            foreach (array_keys($days) as $date) {
                if (strtotime($date . ' 00:00:00') < $cutoff) unset($history[$source][$date]);
            }
        }
        $this->WriteAttributeString('PVSourceForecastHistoryJSON', json_encode($history));
        $this->DebugLog('PV-Historie', 'Quellenprognosen gespeichert/eingefroren | Quellen=' . implode(', ', $sources));
    }

    private function CalculatePVSourceWeights(array $sources): array
    {
        if (count($sources) === 1) return [$sources[0] => 1.0];

        $history = json_decode($this->ReadAttributeString('PVSourceForecastHistoryJSON'), true);
        if (!is_array($history)) $history = [];
        $days = max(1, min(30, $this->ReadPropertyInteger('ForecastWeightLearningDays')));
        $learningResetTs = $this->ReadAttributeInteger('PVSourceWeightLearningResetTs');
        $scores = [];

        foreach ($sources as $source) {
            $errors = [];
            for ($d = 1; $d <= $days; $d++) {
                $dayStart = strtotime('-' . $d . ' days 00:00:00');
                // Nach einem Gewichtsreset alte Vergleichstage nicht erneut zum Lernen
                // heranziehen. Die Daten bleiben aber für die Debug-Linien gespeichert.
                if ($learningResetTs > 0 && ($dayStart + 86400) <= $learningResetTs) continue;
                $date = date('Y-m-d', $dayStart);
                $forecast = $history[$source][$date] ?? null;
                if (!is_array($forecast)) continue;
                $actual = $this->GetActualPVHourlyForDay($dayStart);
                foreach ($forecast as $h => $pred) {
                    $act = $actual['hourlyKWh'][$h] ?? null;
                    if ($pred === null || $act === null) continue;
                    // Nachtstunden ohne Erzeugung tragen keine Information zur Quellenqualität bei.
                    if ((float)$pred < 0.02 && (float)$act < 0.02) continue;
                    $errors[] = abs((float)$pred - (float)$act);
                }
            }
            if (count($errors) >= 6) {
                $mae = array_sum($errors) / count($errors);
                $scores[$source] = 1.0 / max(0.05, $mae);
                $this->DebugLog('PV-Gewichtung', $this->SourceDisplayName($source) . ' | Vergleichswerte=' . count($errors) . ' | MAE=' . round($mae, 4) . ' kWh');
            } else {
                $scores[$source] = 1.0; // Noch keine belastbare Historie: zunächst gleich gewichten.
                $this->DebugLog('PV-Gewichtung', $this->SourceDisplayName($source) . ' | erst ' . count($errors) . ' Vergleichswerte -> Startgewicht');
            }
        }

        $sum = array_sum($scores);
        if ($sum <= 0.0) return array_fill_keys($sources, 1.0 / count($sources));
        foreach ($scores as $source => $score) $scores[$source] = $score / $sum;
        return $scores;
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
                $this->DebugLog('PVCalibration', 'Variable ' . $id . ' konnte nicht gelesen werden: ' . $e->getMessage(), 0);
            }
        }
        return $count > 0 ? $sum : null;
    }

    private function StartPVCalibrationExclusion(string $reason, ?int $fromTs = null): int
    {
        $fromTs = $fromTs ?? time();
        $activeFrom = $this->ReadAttributeInteger('PVCalibrationExclusionActiveFromTs');
        if ($activeFrom <= 0) {
            $activeFrom = max(1, $fromTs);
            $this->WriteAttributeInteger('PVCalibrationExclusionActiveFromTs', $activeFrom);
            $this->WriteAttributeString('PVCalibrationExclusionActiveReason', $reason);
        } elseif ($this->ReadAttributeString('PVCalibrationExclusionActiveReason') === '' && $reason !== '') {
            $this->WriteAttributeString('PVCalibrationExclusionActiveReason', $reason);
        }
        return $activeFrom;
    }

    private function FinishPVCalibrationExclusion(?int $toTs = null): void
    {
        $fromTs = $this->ReadAttributeInteger('PVCalibrationExclusionActiveFromTs');
        if ($fromTs <= 0) return;
        $toTs = $toTs ?? time();
        $reason = $this->ReadAttributeString('PVCalibrationExclusionActiveReason');
        $periods = json_decode($this->ReadAttributeString('PVCalibrationExcludedPeriodsJSON'), true);
        if (!is_array($periods)) $periods = [];
        $periods[] = ['fromTs'=>$fromTs, 'toTs'=>max($fromTs, $toTs), 'reason'=>$reason];
        // Nur die letzten 180 Sperrperioden behalten; die Kalibrierdaten selbst haben
        // ohnehin eine deutlich kuerzere Aufbewahrungszeit.
        if (count($periods) > 180) $periods = array_slice($periods, -180);
        $this->WriteAttributeString('PVCalibrationExcludedPeriodsJSON', json_encode($periods));
        $this->WriteAttributeInteger('PVCalibrationExclusionActiveFromTs', 0);
        $this->WriteAttributeString('PVCalibrationExclusionActiveReason', '');
    }

    private function GetFeedInFactorCalibrationBlock(): array
    {
        $variableID = $this->ReadPropertyInteger('FeedInFactorVariable');
        if ($variableID <= 0 || !@IPS_VariableExists($variableID)) {
            return ['blocked'=>false, 'configured'=>false, 'value'=>null, 'blockedFromTs'=>0, 'text'=>''];
        }
        try {
            $variable = @IPS_GetVariable($variableID);
            $type = is_array($variable) ? (int)($variable['VariableType'] ?? -1) : -1;
            if ($type !== 1 && $type !== 2) {
                return ['blocked'=>false, 'configured'=>true, 'value'=>null, 'blockedFromTs'=>0, 'text'=>'Einspeisefaktor nicht numerisch'];
            }
            $value = (float)GetValue($variableID);
        } catch (Throwable $e) {
            return ['blocked'=>false, 'configured'=>true, 'value'=>null, 'blockedFromTs'=>0, 'text'=>'Einspeisefaktor nicht lesbar'];
        }

        if ($value <= 0.0001) {
            $reason = $this->ReadAttributeBoolean('FeedInPriceLockActive')
                ? 'Mindestpreis Einspeisung – Einspeisefaktor 0 %'
                : 'Einspeisefaktor 0 %';
            $fromTs = $this->StartPVCalibrationExclusion($reason);
            return [
                'blocked'=>true, 'configured'=>true, 'value'=>$value,
                'blockedFromTs'=>$fromTs,
                'text'=>'Lernen pausiert – Einspeisefaktor 0 %'
                    . ($this->ReadAttributeBoolean('FeedInPriceLockActive') ? ' / Mindestpreis Einspeisung' : '')
            ];
        }

        // Ist keine Preis-Sperre mehr aktiv und der Faktor wieder groesser 0, endet
        // der automatisch protokollierte Ausschlusszeitraum.
        if (!$this->ReadAttributeBoolean('FeedInPriceLockActive') && $this->ReadAttributeInteger('PVCalibrationExclusionActiveFromTs') > 0) {
            $this->FinishPVCalibrationExclusion(time());
        }
        return ['blocked'=>false, 'configured'=>true, 'value'=>$value, 'blockedFromTs'=>0, 'text'=>''];
    }

    private function GetPVCalibrationFeedInGate(): array
    {
        // Eine auf 0 % gesetzte Einspeisefreigabe begrenzt die reale PV-Erzeugung.
        // Solche Werte duerfen niemals als Prognosefehler gelernt werden.
        $factorBlock = $this->GetFeedInFactorCalibrationBlock();
        if (!empty($factorBlock['blocked'])) {
            return [
                'blocked'=>true, 'configured'=>true, 'gridW'=>null, 'feedInW'=>null,
                'batteryPowerW'=>null, 'thresholdW'=>null,
                'blockedFromTs'=>(int)($factorBlock['blockedFromTs'] ?? time()),
                'windowHighPct'=>0.0, 'windowLowPct'=>0.0, 'majorityPct'=>100,
                'windowReady'=>true, 'text'=>(string)($factorBlock['text'] ?? 'Lernen pausiert – Einspeisefaktor 0 %')
            ];
        }

        $variableID = $this->ReadPropertyInteger('PVCalibrationFeedInVariable');
        if ($variableID <= 0 || !@IPS_VariableExists($variableID)) {
            return ['blocked'=>false,'configured'=>false,'gridW'=>null,'feedInW'=>null,'thresholdW'=>null,'text'=>''];
        }

        try {
            // Anlagenkonvention des Netz-Zählers: Bezug positiv, Einspeisung negativ.
            $gridW = (float)GetValue($variableID);
            $feedInW = max(0.0, -$gridW);
        } catch (Throwable $e) {
            $this->DebugLog('PVCalibration', 'Netzwert konnte nicht gelesen werden: '.$e->getMessage(), 0);
            return ['blocked'=>false,'configured'=>true,'gridW'=>null,'feedInW'=>null,'thresholdW'=>null,'text'=>'Netzwert nicht lesbar'];
        }

        $limitW = max(0.0, (float)$this->ReadPropertyInteger('PVCalibrationFeedInLimitW'));
        $toleranceW = max(0.0, (float)$this->ReadPropertyInteger('PVCalibrationFeedInToleranceW'));
        $thresholdW = max(0.0, $limitW - $toleranceW);
        $nearLimit = $limitW > 0.0 && $feedInW >= $thresholdW;

        $blocked = $this->ReadAttributeBoolean('PVCalibrationCurtailmentLatched');
        $blockedFromTs = $this->ReadAttributeInteger('PVCalibrationBlockedFromTs');
        $majorityPct = max(50, min(100, $this->ReadPropertyInteger('PVCalibrationCurtailmentMajorityPct')));
        $windowSec = 120;
        $now = time();

        // Rollendes 2-Minuten-Fenster. Jede lokale Kalibrierungsabfrage liefert
        // genau einen Messpunkt: oberhalb/gleich Sperre oder darunter.
        $samples = json_decode($this->ReadAttributeString('PVCalibrationCurtailmentSamplesJSON'), true);
        if (!is_array($samples)) $samples = [];
        $samples[] = ['ts'=>$now, 'high'=>$nearLimit ? 1 : 0];
        $cutoff = $now - $windowSec;
        $samples = array_values(array_filter($samples, function($x) use ($cutoff) {
            return is_array($x) && (int)($x['ts'] ?? 0) >= $cutoff;
        }));
        $this->WriteAttributeString('PVCalibrationCurtailmentSamplesJSON', json_encode($samples));

        $count = count($samples);
        $highCount = 0;
        foreach ($samples as $x) if (!empty($x['high'])) $highCount++;
        $lowCount = $count - $highCount;
        $highPct = $count > 0 ? 100.0 * $highCount / $count : 0.0;
        $lowPct = $count > 0 ? 100.0 * $lowCount / $count : 0.0;
        $oldestTs = $count > 0 ? (int)$samples[0]['ts'] : $now;
        // Entscheidung erst, wenn das Fenster annähernd vollständig beobachtet wurde.
        $windowReady = ($now - $oldestTs) >= max(1, $windowSec - max(10, min(120, $this->ReadPropertyInteger('PVCalibrationPollSeconds'))));

        if (!$blocked && $windowReady && $highPct >= $majorityPct) {
            $blocked = true;
            // Sicherheitsbereich: zwei Minuten VOR dem ersten hohen Wert im aktuellen
            // Fenster bis zum späteren Ende der Sperre werden nicht zum Lernen benutzt.
            $firstHighTs = $now;
            foreach ($samples as $x) {
                if (!empty($x['high'])) { $firstHighTs = (int)$x['ts']; break; }
            }
            $blockedFromTs = max(0, $firstHighTs - 120);
            $this->WriteAttributeBoolean('PVCalibrationCurtailmentLatched', true);
            $this->WriteAttributeInteger('PVCalibrationBlockedFromTs', $blockedFromTs);
        } elseif ($blocked && $windowReady && $lowPct >= $majorityPct) {
            $blocked = false;
            $blockedFromTs = 0;
            $this->WriteAttributeBoolean('PVCalibrationCurtailmentLatched', false);
            $this->WriteAttributeInteger('PVCalibrationBlockedFromTs', 0);
            // Ab jetzt dürfen neue Intervalle wieder lernen; alter Sperrbereich bleibt entfernt.
        }

        $belowSince = 0;
        $aboveSince = 0;
        $aboveCount = $highCount;
        $text = $blocked
            ? 'Lernen pausiert – Einspeisegrenze erreicht | Netzvariable '
                .number_format($gridW,0,',','.').' W | Einspeisung '
                .number_format($feedInW,0,',','.').' W | Sperre ab '
                .number_format($thresholdW,0,',','.').' W'
            : '';

        return [
            'blocked'=>$blocked, 'configured'=>true, 'gridW'=>$gridW,
            'feedInW'=>$feedInW, 'batteryPowerW'=>null, 'thresholdW'=>$thresholdW,
            'belowThresholdSince'=>$belowSince,
            'aboveThresholdSince'=>$aboveSince,
            'aboveThresholdCount'=>$aboveCount,
            'blockedFromTs'=>$blockedFromTs,
            'windowHighPct'=>$highPct,
            'windowLowPct'=>$lowPct,
            'majorityPct'=>$majorityPct,
            'windowReady'=>$windowReady,
            'releaseRemainingSec'=>($blocked && $belowSince>0) ? max(0,300-(time()-$belowSince)) : null,
            'text'=>$text
        ];
    }

    private function PVSeasonForTimestamp(int $ts): string
    {
        $month = (int)date('n', $ts);
        if ($month >= 3 && $month <= 5) return 'spring';
        if ($month >= 6 && $month <= 8) return 'summer';
        if ($month >= 9 && $month <= 11) return 'autumn';
        return 'winter';
    }

    private function MergePVSeasonArchive(array $archive, array $sample): array
    {
        $ts = (int)($sample['ts'] ?? 0);
        $exp = (float)($sample['expectedKWh'] ?? 0.0);
        $act = (float)($sample['actualKWh'] ?? 0.0);
        if ($ts <= 0 || $exp <= 0.0 || $act < 0.0) return $archive;
        $season = $this->PVSeasonForTimestamp($ts);
        $hour = (string)(isset($sample['hour']) ? (int)$sample['hour'] : (int)date('G', $ts));
        if (!isset($archive[$season]) || !is_array($archive[$season])) $archive[$season] = [];
        if (!isset($archive[$season][$hour]) || !is_array($archive[$season][$hour])) {
            $archive[$season][$hour] = ['expectedKWh'=>0.0,'actualKWh'=>0.0,'intervals'=>0,'days'=>[]];
        }
        $archive[$season][$hour]['expectedKWh'] += $exp;
        $archive[$season][$hour]['actualKWh'] += $act;
        $archive[$season][$hour]['intervals'] += max(1, (int)($sample['intervals'] ?? 1));
        if (!isset($archive[$season][$hour]['days']) || !is_array($archive[$season][$hour]['days'])) $archive[$season][$hour]['days'] = [];
        $archive[$season][$hour]['days'][date('Y-m-d', $ts)] = true;
        return $archive;
    }

    private function CompactPVCalibrationData(array $calibration, string $key): array
    {
        if (!isset($calibration[$key]) || !is_array($calibration[$key])) return $calibration;
        $samples = isset($calibration[$key]['energySamples']) && is_array($calibration[$key]['energySamples']) ? $calibration[$key]['energySamples'] : [];
        if (count($samples) === 0) return $calibration;

        // Rohmessungen werden pro Stunde zusammengefasst. Damit bleiben Energie und
        // Tages-/Stundenstruktur exakt erhalten, die JSON-Menge sinkt aber typischerweise
        // von zehntausenden Punkten auf höchstens 24 * Lerntage.
        $buckets = [];
        $auditRawExpected = 0.0;
        $auditRawActual = 0.0;
        $auditRawCount = 0;
        foreach ($samples as $sample) {
            $ts = (int)($sample['ts'] ?? 0);
            $exp = (float)($sample['expectedKWh'] ?? 0.0);
            $act = (float)($sample['actualKWh'] ?? 0.0);
            if ($ts <= 0 || $exp <= 0.0 || $act < 0.0) continue;
            $auditRawExpected += $exp;
            $auditRawActual += $act;
            $auditRawCount++;
            $hourStart = strtotime(date('Y-m-d H:00:00', $ts));
            $bucketKey = (string)$hourStart;
            if (!isset($buckets[$bucketKey])) {
                $buckets[$bucketKey] = ['ts'=>$hourStart,'endTs'=>(int)($sample['endTs'] ?? $ts),'expectedKWh'=>0.0,'actualKWh'=>0.0,'hour'=>(int)date('G',$ts),'intervals'=>0];
            }
            $buckets[$bucketKey]['expectedKWh'] += $exp;
            $buckets[$bucketKey]['actualKWh'] += $act;
            $buckets[$bucketKey]['endTs'] = max((int)$buckets[$bucketKey]['endTs'], (int)($sample['endTs'] ?? $ts));
            $buckets[$bucketKey]['intervals'] += max(1, (int)($sample['intervals'] ?? 1));
        }
        ksort($buckets, SORT_NUMERIC);
        $auditBucketExpected = 0.0;
        $auditBucketActual = 0.0;
        foreach ($buckets as $bucket) {
            $auditBucketExpected += (float)($bucket['expectedKWh'] ?? 0.0);
            $auditBucketActual += (float)($bucket['actualKWh'] ?? 0.0);
        }

        $retentionDays = max(1, $this->ReadPropertyInteger('PVCalibrationDays'), $this->ReadPropertyInteger('UnknownOrientationLearningDays'));
        $cutoff = time() - $retentionDays * 86400;
        $archive = isset($calibration[$key]['seasonalArchive']) && is_array($calibration[$key]['seasonalArchive']) ? $calibration[$key]['seasonalArchive'] : [];
        $recent = [];
        foreach ($buckets as $bucket) {
            if ((int)$bucket['ts'] < $cutoff) $archive = $this->MergePVSeasonArchive($archive, $bucket);
            else $recent[] = $bucket;
        }
        $calibration[$key]['energySamples'] = $recent;
        $calibration[$key]['seasonalArchive'] = $archive;
        $calibration[$key]['storageMode'] = 'hourly+seasonal';
        $calibration[$key]['compactedAt'] = time();
        $beforeFactor = $auditRawExpected > 0.0 ? $auditRawActual / $auditRawExpected : null;
        $afterFactor = $auditBucketExpected > 0.0 ? $auditBucketActual / $auditBucketExpected : null;
        $calibration[$key]['lastCompactionAudit'] = [
            'ts' => time(),
            'rawCount' => $auditRawCount,
            'bucketCount' => count($buckets),
            'expectedBeforeKWh' => $auditRawExpected,
            'expectedAfterKWh' => $auditBucketExpected,
            'actualBeforeKWh' => $auditRawActual,
            'actualAfterKWh' => $auditBucketActual,
            'factorBefore' => $beforeFactor,
            'factorAfter' => $afterFactor,
            'expectedDeltaKWh' => $auditBucketExpected - $auditRawExpected,
            'actualDeltaKWh' => $auditBucketActual - $auditRawActual
        ];
        return $calibration;
    }

    private function GetPVSeasonLabel(string $season): string
    {
        $labels = ['spring'=>'Frühling','summer'=>'Sommer','autumn'=>'Herbst','winter'=>'Winter'];
        return $labels[$season] ?? $season;
    }

    private function GetPVSeasonStats(array $calibration, string $key, int $ts): array
    {
        $season = $this->PVSeasonForTimestamp($ts);
        $expected = 0.0; $actual = 0.0; $intervals = 0; $days = [];
        $archive = isset($calibration[$key]['seasonalArchive']) && is_array($calibration[$key]['seasonalArchive']) ? $calibration[$key]['seasonalArchive'] : [];
        if (isset($archive[$season]) && is_array($archive[$season])) {
            foreach ($archive[$season] as $entry) {
                if (!is_array($entry)) continue;
                $expected += max(0.0, (float)($entry['expectedKWh'] ?? 0.0));
                $actual += max(0.0, (float)($entry['actualKWh'] ?? 0.0));
                $intervals += max(0, (int)($entry['intervals'] ?? 0));
                if (isset($entry['days']) && is_array($entry['days'])) foreach ($entry['days'] as $day => $_) $days[(string)$day] = true;
            }
        }
        foreach (($calibration[$key]['energySamples'] ?? []) as $sample) {
            $sampleTs = (int)($sample['ts'] ?? 0);
            if ($sampleTs <= 0 || $this->PVSeasonForTimestamp($sampleTs) !== $season) continue;
            $exp = (float)($sample['expectedKWh'] ?? 0.0); $act = (float)($sample['actualKWh'] ?? 0.0);
            if ($exp <= 0.0 || $act < 0.0) continue;
            $expected += $exp; $actual += $act;
            $intervals += max(1, (int)($sample['intervals'] ?? 1));
            $days[date('Y-m-d', $sampleTs)] = true;
        }
        return [
            'season'=>$season, 'label'=>$this->GetPVSeasonLabel($season),
            'expectedKWh'=>$expected, 'actualKWh'=>$actual,
            'factor'=>$expected > 0.0 ? $actual / $expected : null,
            'intervals'=>$intervals, 'days'=>count($days)
        ];
    }

    private function GetSeasonalPVFactor(array $calibration, string $key, int $ts, ?int $hour = null): ?float
    {
        if (!isset($calibration[$key]) || !is_array($calibration[$key])) return null;
        $min = $this->ReadPropertyFloat('PVCalibrationMinFactor');
        $max = $this->ReadPropertyFloat('PVCalibrationMaxFactor');
        $hour = $hour === null ? (int)date('G', $ts) : max(0, min(23, $hour));

        // Saisonzentren: 15.04 / 15.07 / 15.10 / 15.01. Zwischen zwei Zentren wird
        // linear überblendet, damit es an Monatsgrenzen keinen Faktorsprung gibt.
        $year = (int)date('Y', $ts);
        $centers = [
            ['winter', strtotime(($year-1).'-01-15 12:00:00')],
            ['spring', strtotime($year.'-04-15 12:00:00')],
            ['summer', strtotime($year.'-07-15 12:00:00')],
            ['autumn', strtotime($year.'-10-15 12:00:00')],
            ['winter', strtotime(($year+1).'-01-15 12:00:00')],
            ['spring', strtotime(($year+1).'-04-15 12:00:00')]
        ];
        if ($ts < $centers[1][1]) { $centers[0][1] = strtotime(($year-1).'-10-15 12:00:00'); $centers[0][0]='autumn'; $centers[1]=['winter',strtotime($year.'-01-15 12:00:00')]; $centers[2]=['spring',strtotime($year.'-04-15 12:00:00')]; }
        $left = $centers[0]; $right = $centers[1];
        for ($i=0; $i<count($centers)-1; $i++) {
            if ($ts >= $centers[$i][1] && $ts <= $centers[$i+1][1]) { $left=$centers[$i]; $right=$centers[$i+1]; break; }
        }
        $span = max(1, $right[1]-$left[1]);
        $wr = max(0.0, min(1.0, ($ts-$left[1])/$span));
        $wl = 1.0-$wr;

        $archive = isset($calibration[$key]['seasonalArchive']) && is_array($calibration[$key]['seasonalArchive']) ? $calibration[$key]['seasonalArchive'] : [];
        // Auch die aktuellen kompakten Lerndaten fließen saisonal ein.
        foreach (($calibration[$key]['energySamples'] ?? []) as $sample) $archive = $this->MergePVSeasonArchive($archive, $sample);
        $get = function(string $season) use ($archive, $hour, $min, $max) {
            $entry = $archive[$season][(string)$hour] ?? null;
            if (!is_array($entry) || (float)($entry['expectedKWh'] ?? 0.0) <= 0.0) return null;
            return max($min, min($max, (float)$entry['actualKWh'] / (float)$entry['expectedKWh']));
        };
        $fl=$get($left[0]); $fr=$get($right[0]);
        if ($fl !== null && $fr !== null) return $fl*$wl + $fr*$wr;
        return $fl ?? $fr;
    }

    private function InvalidatePVCalibrationFrom(array $calibration, string $key, int $fromTs): array
    {
        if (!isset($calibration[$key]) || !is_array($calibration[$key])) return $calibration;
        $samples = isset($calibration[$key]['energySamples']) && is_array($calibration[$key]['energySamples']) ? $calibration[$key]['energySamples'] : [];
        $kept = [];
        foreach ($samples as $sample) {
            $endTs = (int)($sample['endTs'] ?? $sample['ts'] ?? 0);
            if ($endTs >= $fromTs) continue;
            $kept[] = $sample;
        }
        $calibration[$key]['energySamples'] = $kept;
        unset($calibration[$key]['lastPointTs'], $calibration[$key]['lastPointExpectedW'], $calibration[$key]['lastPointActualW']);
        return $this->RecalculatePVCalibrationFactors($calibration, $key);
    }

    private function RecalculatePVCalibrationFactors(array $calibration, string $key): array
    {
        if (!isset($calibration[$key]) || !is_array($calibration[$key])) return $calibration;
        $samples = isset($calibration[$key]['energySamples']) && is_array($calibration[$key]['energySamples']) ? $calibration[$key]['energySamples'] : [];
        $requiredDays = max(1, $this->ReadPropertyInteger('PVCalibrationDays'));

        // Rollierendes Fenster: die neuesten N gültigen Lerntage verwenden.
        // Vor dem erstmaligen Erreichen von N Tagen bleibt der Faktor exakt 1,000.
        $byDay = [];
        foreach ($samples as $sample) {
            $ts = (int)($sample['ts'] ?? 0);
            $exp = (float)($sample['expectedKWh'] ?? 0.0);
            $act = (float)($sample['actualKWh'] ?? 0.0);
            if ($ts <= 0 || $exp <= 0.0 || $act < 0.0) continue;
            $day = date('Y-m-d', $ts);
            if (!isset($byDay[$day])) $byDay[$day] = ['expected'=>0.0,'actual'=>0.0,'samples'=>0,'firstTs'=>$ts,'lastTs'=>(int)($sample['endTs'] ?? $ts)];
            $byDay[$day]['expected'] += $exp;
            $byDay[$day]['actual'] += $act;
            $byDay[$day]['samples']++;
            $byDay[$day]['firstTs'] = min($byDay[$day]['firstTs'], $ts);
            $byDay[$day]['lastTs'] = max($byDay[$day]['lastTs'], (int)($sample['endTs'] ?? $ts));
        }
        ksort($byDay);
        $days = array_keys($byDay);
        $ready = count($days) >= $requiredDays;
        $selectedDays = $ready ? array_slice($days, -$requiredDays) : $days;
        $sumExpected = 0.0; $sumActual = 0.0; $count = 0; $firstTs = 0; $lastTs = 0;
        foreach ($selectedDays as $day) {
            $d = $byDay[$day];
            $sumExpected += $d['expected']; $sumActual += $d['actual']; $count += $d['samples'];
            if ($firstTs === 0 || $d['firstTs'] < $firstTs) $firstTs = $d['firstTs'];
            if ($d['lastTs'] > $lastTs) $lastTs = $d['lastTs'];
        }
        $min = $this->ReadPropertyFloat('PVCalibrationMinFactor');
        $max = $this->ReadPropertyFloat('PVCalibrationMaxFactor');
        $factorReady = $ready && $sumExpected > 0.0;
        $raw = $sumExpected > 0.0 ? ($sumActual / $sumExpected) : null;
        $calibration[$key]['factor'] = ($factorReady && $raw !== null) ? max($min, min($max, $raw)) : 1.0;
        $calibration[$key]['factorReady'] = $factorReady;
        $calibration[$key]['learningDayCount'] = count($days);
        $calibration[$key]['selectedLearningDays'] = $selectedDays;
        $calibration[$key]['factorSampleCount'] = $count;
        $calibration[$key]['factorExpectedKWh'] = $sumExpected;
        $calibration[$key]['factorActualKWh'] = $sumActual;
        $calibration[$key]['factorRawRatio'] = $raw;
        $calibration[$key]['factorFirstTs'] = $firstTs;
        $calibration[$key]['factorLastTs'] = $lastTs;
        $calibration[$key]['hourlyFactors'] = [];
        $calibration[$key]['updated'] = time();
        return $calibration;
    }

    private function GetPVForecastHourFactor(array $calibration, string $key, int $hour, float $overallFactor, ?bool $factorReadyOverride = null): float
    {
        $factorReady = $factorReadyOverride ?? !empty($calibration[$key]['factorReady']);
        if (!$factorReady) return 1.0;
        return max($this->ReadPropertyFloat('PVCalibrationMinFactor'), min($this->ReadPropertyFloat('PVCalibrationMaxFactor'), $overallFactor));
    }

    private function GetPVForecastHourWeight(array $calibration, string $key, int $hour): float
    {
        if (!isset($calibration[$key]) || !is_array($calibration[$key])) return 0.0;
        $hour = max(0, min(23, $hour));
        $weight = 0.0;
        $cutoff = time() - max(1, $this->ReadPropertyInteger('PVCalibrationDays')) * 86400;
        foreach (($calibration[$key]['energySamples'] ?? []) as $sample) {
            $ts = (int)($sample['ts'] ?? 0);
            if ($ts < $cutoff) continue;
            $h = isset($sample['hour']) ? (int)$sample['hour'] : (int)date('G', $ts);
            if ($h !== $hour) continue;
            $weight += max(0.0, (float)($sample['expectedKWh'] ?? 0.0));
        }
        // Falls im aktuellen Fenster für diese Stunde noch nichts vorhanden ist,
        // dient das saisonale Stundenarchiv als Gewicht (nicht als zusätzlicher Messwert).
        if ($weight <= 0.0) {
            $season = $this->PVSeasonForTimestamp(time());
            $entry = $calibration[$key]['seasonalArchive'][$season][(string)$hour] ?? null;
            if (is_array($entry)) $weight = max(0.0, (float)($entry['expectedKWh'] ?? 0.0));
        }
        return $weight;
    }

    private function AddPVCalibrationEnergySample(array $calibration, string $key, float $expectedW, float $actualW): array
    {
        if (!isset($calibration[$key]) || !is_array($calibration[$key])) {
            $calibration[$key] = ['factor' => 1.0, 'energySamples' => []];
        }
        if (!isset($calibration[$key]['energySamples']) || !is_array($calibration[$key]['energySamples'])) {
            $calibration[$key]['energySamples'] = [];
        }

        $calibration = $this->CompactPVCalibrationData($calibration, $key);
        $now = time();
        $lastTs = (int)($calibration[$key]['lastPointTs'] ?? 0);
        $lastExpectedW = (float)($calibration[$key]['lastPointExpectedW'] ?? 0.0);
        $lastActualW = (float)($calibration[$key]['lastPointActualW'] ?? 0.0);

        // Im konfigurierten Kalibrierungsintervall einen neuen Integrationspunkt bilden.
        // Zwischen zwei Punkten werden Leistungskurven trapezförmig integriert -> echte kWh.
        $pollSeconds = max(10, min(120, $this->ReadPropertyInteger('PVCalibrationPollSeconds')));
        if ($lastTs > 0 && $now - $lastTs >= $pollSeconds) {
            $dt = $now - $lastTs;
            // Große Datenlücken nicht als konstante Leistung interpretieren.
            if ($dt <= 3600 && $lastExpectedW >= $this->ReadPropertyInteger('PVCalibrationMinExpectedW')) {
                $expectedKWh = (($lastExpectedW + $expectedW) / 2.0) * ($dt / 3600.0) / 1000.0;
                $actualKWh = (($lastActualW + $actualW) / 2.0) * ($dt / 3600.0) / 1000.0;
                if ($expectedKWh > 0.0 && $actualKWh >= 0.0) {
                    $calibration[$key]['energySamples'][] = [
                        'ts' => $lastTs,
                        'endTs' => $now,
                        'expectedKWh' => $expectedKWh,
                        'actualKWh' => $actualKWh,
                        'hour' => (int)date('G', $lastTs)
                    ];
                }
            }
        }

        // Den aktuellen Punkt immer als Ausgangspunkt für das nächste Intervall merken.
        if ($lastTs === 0 || $now - $lastTs >= $pollSeconds) {
            $calibration[$key]['lastPointTs'] = $now;
            $calibration[$key]['lastPointExpectedW'] = $expectedW;
            $calibration[$key]['lastPointActualW'] = $actualW;
        }

        $retentionDays = max(1, $this->ReadPropertyInteger('PVCalibrationDays'), $this->ReadPropertyInteger('UnknownOrientationLearningDays'));
        $retentionCutoff = $now - $retentionDays * 86400;
        $samples = [];
        foreach ($calibration[$key]['energySamples'] as $sample) {
            $ts = (int)($sample['ts'] ?? 0);
            $exp = (float)($sample['expectedKWh'] ?? 0.0);
            $act = (float)($sample['actualKWh'] ?? 0.0);
            if ($ts < $retentionCutoff || $exp <= 0.0 || $act < 0.0) continue;
            $samples[] = ['ts' => $ts, 'endTs' => (int)($sample['endTs'] ?? $ts), 'expectedKWh' => $exp, 'actualKWh' => $act];
        }
        $calibration[$key]['energySamples'] = $samples;

        $factorDays = max(1, $this->ReadPropertyInteger('PVCalibrationDays'));
        $factorCutoff = $now - $factorDays * 86400;
        $sumExpectedKWh = 0.0;
        $sumActualKWh = 0.0;
        $count = 0;
        foreach ($samples as $sample) {
            if ((int)$sample['ts'] < $factorCutoff) continue;
            $sumExpectedKWh += (float)$sample['expectedKWh'];
            $sumActualKWh += (float)$sample['actualKWh'];
            $count++;
        }
        if ($sumExpectedKWh > 0.0) {
            $factor = $sumActualKWh / $sumExpectedKWh;
            $calibration[$key]['factor'] = max($this->ReadPropertyFloat('PVCalibrationMinFactor'), min($this->ReadPropertyFloat('PVCalibrationMaxFactor'), $factor));
        } else {
            $calibration[$key]['factor'] = 1.0;
        }
        $calibration[$key]['factorSampleCount'] = $count;

        // Stundenfaktoren in einem einzigen Durchlauf bilden (O(n) statt 24*n).
        $hourSums = [];
        foreach ($samples as $sample) {
            if ((int)$sample['ts'] < $factorCutoff) continue;
            $h = isset($sample['hour']) ? (int)$sample['hour'] : (int)date('G', (int)$sample['ts']);
            if (!isset($hourSums[$h])) $hourSums[$h] = ['e'=>0.0,'a'=>0.0,'c'=>0];
            $hourSums[$h]['e'] += (float)$sample['expectedKWh'];
            $hourSums[$h]['a'] += (float)$sample['actualKWh'];
            $hourSums[$h]['c'] += max(1, (int)($sample['intervals'] ?? 1));
        }
        $hourlyFactors = [];
        foreach ($hourSums as $h => $v) {
            if ($v['e'] <= 0.0) continue;
            $hourlyFactors[(string)$h] = ['factor'=>max($this->ReadPropertyFloat('PVCalibrationMinFactor'), min($this->ReadPropertyFloat('PVCalibrationMaxFactor'), $v['a']/$v['e'])),'samples'=>$v['c'],'expectedKWh'=>$v['e'],'actualKWh'=>$v['a']];
        }
        $calibration[$key]['hourlyFactors'] = $hourlyFactors;
        $calibration[$key]['updated'] = $now;
        return $calibration;
    }

    private function GetPVCalibrationDiagnostics(array $calibration, string $key): array
    {
        if (!isset($calibration[$key]) || !is_array($calibration[$key])) return ['factorReady'=>false,'learningDayCount'=>0,'sampleCount'=>0,'sumExpectedKWh'=>0.0,'sumActualKWh'=>0.0,'ratio'=>null,'firstSampleTs'=>0,'lastSampleTs'=>0];
        $entry = $calibration[$key];
        return [
            'sampleCount' => (int)($entry['factorSampleCount'] ?? 0),
            'sumExpectedKWh' => (float)($entry['factorExpectedKWh'] ?? 0.0),
            'sumActualKWh' => (float)($entry['factorActualKWh'] ?? 0.0),
            'ratio' => $entry['factorRawRatio'] ?? null,
            'learnedRatio' => $entry['factorRawRatio'] ?? null,
            'factorReady' => !empty($entry['factorReady']),
            'learningDayCount' => (int)($entry['learningDayCount'] ?? 0),
            'firstSampleTs' => (int)($entry['factorFirstTs'] ?? 0),
            'lastSampleTs' => (int)($entry['factorLastTs'] ?? 0)
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
        if (!is_array($calibration)) $calibration = [];
        if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') >= 1) $calibration = $this->BuildPVCalibrationFromArchive($calibration);
        if (!isset($calibration[$key]['energySamples']) || !is_array($calibration[$key]['energySamples'])) return 0;
        $days = [];
        foreach ($calibration[$key]['energySamples'] as $sample) {
            $ts = (int)($sample['ts'] ?? 0);
            $exp = (float)($sample['expectedKWh'] ?? 0.0);
            if ($ts <= 0 || $exp <= 0.0) continue;
            $days[date('Y-m-d', $ts)] = true;
        }
        return count($days);
    }

    private function FetchPrices(): array
    {
        $this->DebugLog('Preise', 'Preisquelle/Tarif Modus=' . $this->ReadPropertyInteger('PriceProvider'));
        // Ein einziges Auswahlfeld bestimmt Datenquelle und Tariflogik.
        // 0 = EPEX SPOT AT 60 min, 1 = aWATTar SUNNY Spot,
        // 2 = eigene JSON-Quelle, 3 = benutzerdefiniert auf EPEX-Basis.
        switch ($this->ReadPropertyInteger('PriceProvider')) {
            case 1:
                return $this->FetchEPEXHourlyPrices(1);

            case 2:
                return $this->FetchCustomJSONPrices();

            case 3:
                return $this->FetchEPEXHourlyPrices(3);

            case 0:
            default:
                return $this->FetchEPEXHourlyPrices(0);
        }
    }

    private function FetchEPEXHourlyPrices(int $tariffMode): array
    {
        // smartENERGY liefert EPEX SPOT AT derzeit in 15-Minuten-Werten.
        // Für dieses Modul werden zunächst echte arithmetische 60-Minuten-Mittel
        // gebildet. Erst danach wird der gewählte Tarif auf den Stundenpreis angewandt.
        $url = 'https://apis.smartenergy.at/market/v1/price';
        $data = $this->HttpGetJson($url);
        if (!isset($data['data']) || !is_array($data['data'])) {
            throw new Exception('Ungültige smartENERGY EPEX-SPOT-AT-Antwort.');
        }

        $hourly = [];
        foreach ($data['data'] as $row) {
            if (!isset($row['date'], $row['value'])) continue;
            $start = strtotime((string)$row['date']);
            if ($start === false) continue;
            $hourStart = strtotime(date('Y-m-d H:00:00', $start));
            if (!isset($hourly[$hourStart])) {
                $hourly[$hourStart] = ['sum' => 0.0, 'count' => 0];
            }
            $hourly[$hourStart]['sum'] += (float)$row['value'];
            $hourly[$hourStart]['count']++;
        }

        ksort($hourly);
        $prices = [];
        foreach ($hourly as $hourStart => $bucket) {
            if (($bucket['count'] ?? 0) <= 0) continue;
            $marketCt = (float)$bucket['sum'] / (int)$bucket['count'];
            $prices[] = [
                'start' => (int)$hourStart,
                'end' => (int)$hourStart + 3600,
                'marketCt' => $marketCt,
                'priceCt' => $this->CalculateSelectedTariff($marketCt, $tariffMode)
            ];
        }

        if (count($prices) === 0) {
            throw new Exception('smartENERGY liefert keine EPEX-SPOT-AT-Preisdaten.');
        }

        // Die Batterieplanung arbeitet weiterhin in 15-Minuten-Slots. Innerhalb
        // einer Stunde gilt dabei viermal derselbe 60-Minuten-Preis.
        return $this->ExpandPricesToQuarterHour($prices);
    }

    private function FetchCustomJSONPrices(): array
    {
        $vid = $this->ReadPropertyInteger('PriceJSONVariable');
        if ($vid <= 0) throw new Exception('JSON-Preisvariable nicht gewählt.');
        $data = json_decode((string)GetValue($vid), true);
        if (!is_array($data)) throw new Exception('JSON-Preisvariable enthält kein gültiges JSON.');
        return $this->NormalizeCustomPrices($data);
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

    private function CalculateSelectedTariff(float $marketCt, int $tariffMode): float
    {
        switch ($tariffMode) {
            case 1: // aWATTar SUNNY Spot 60min
                return $marketCt - (abs($marketCt) * 0.19);

            case 3: // Benutzerdefiniert auf EPEX-60min-Basis
                $factor = $marketCt >= 0
                    ? $this->ReadPropertyFloat('PositivePriceFactor')
                    : $this->ReadPropertyFloat('NegativePriceFactor');
                return $marketCt * $factor + $this->ReadPropertyFloat('PriceAdjustmentCt');

            case 0: // EPEX SPOT AT 60min, Marktpreis 1:1
            default:
                return $marketCt;
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

    private function AnalyzeGridLimitRisk(array $forecast, array $consumptionProfile): array
    {
        $gridLimitW = max(0, $this->GetRuntimeInteger('RuntimeGridFeedInLimitW', $this->ReadPropertyInteger('GridFeedInLimitW')));
        $safetyW = max(0, min($gridLimitW, $this->GetRuntimeInteger('RuntimeGridLimitSafetyW', $this->ReadPropertyInteger('GridLimitSafetyW'))));
        $effectiveGridLimitW = max(0, $gridLimitW - $safetyW);
        $maxChargeW = max(0, $this->GetRuntimeInteger('RuntimeMaxBatteryChargePowerW', $this->ReadPropertyInteger('MaxBatteryChargePowerW')));

        $hourlyLoad = isset($consumptionProfile['hourlyKWh']) && is_array($consumptionProfile['hourlyKWh'])
            ? $consumptionProfile['hourlyKWh']
            : array_fill(0, 24, 0.0);

        $tomorrowStart = strtotime('tomorrow 00:00:00');
        $tomorrowEnd = $tomorrowStart + 86400;

        $peakPVW = 0.0;
        $peakRawExportW = 0.0;
        $firstCriticalTs = 0;
        $lastCriticalTs = 0;
        $criticalEnergyKWh = 0.0;
        $unavoidableCurtailmentKWh = 0.0;

        // Headroom required at the start of the PV day if the battery normally
        // absorbs surplus PV before exporting it. We therefore accumulate all
        // chargeable surplus up to each critical grid-limit interval and keep
        // the largest cumulative value reached at such a critical interval.
        $cumulativeChargeKWh = 0.0;
        $requiredHeadroomKWh = 0.0;

        $slots = [];
        for ($ts = $tomorrowStart; $ts < $tomorrowEnd; $ts += 900) {
            $hourTs = strtotime(date('Y-m-d H:00:00', $ts));
            $hour = (int)date('G', $ts);

            // Forecast values are kW averages for the hour. Internally the
            // optimizer repeats this level in four 15-minute planning slots.
            $pvKW = isset($forecast['hours'][$hourTs])
                ? max(0.0, (float)($forecast['hours'][$hourTs]['totalKW'] ?? 0.0))
                : 0.0;
            $pvW = $pvKW * 1000.0;

            // hourlyKWh is energy for one hour -> numerically equal to average kW.
            $loadW = max(0.0, (float)($hourlyLoad[$hour] ?? 0.0)) * 1000.0;
            $rawExportW = max(0.0, $pvW - $loadW);

            $peakPVW = max($peakPVW, $pvW);
            $peakRawExportW = max($peakRawExportW, $rawExportW);

            // Potential battery charging if PV surplus is present.
            $chargePotentialW = min($maxChargeW, $rawExportW);
            $cumulativeChargeKWh += $chargePotentialW * 0.25 / 1000.0;

            $overLimitW = max(0.0, $rawExportW - $effectiveGridLimitW);
            $absorbableOverLimitW = min($maxChargeW, $overLimitW);
            $unavoidableW = max(0.0, $overLimitW - $maxChargeW);

            if ($overLimitW > 1.0) {
                if ($firstCriticalTs === 0) $firstCriticalTs = $ts;
                $lastCriticalTs = $ts + 900;
                $criticalEnergyKWh += $absorbableOverLimitW * 0.25 / 1000.0;
                $unavoidableCurtailmentKWh += $unavoidableW * 0.25 / 1000.0;
                $requiredHeadroomKWh = max($requiredHeadroomKWh, $cumulativeChargeKWh);
            }

            $slots[] = [
                'start' => $ts,
                'pvW' => $pvW,
                'loadW' => $loadW,
                'rawExportW' => $rawExportW,
                'overLimitW' => $overLimitW
            ];
        }

        $this->DebugLog(
            'Netzlimit-Prognose',
            'PV Spitze=' . round($peakPVW) . ' W'
            . ' | max. Roh-Einspeisung=' . round($peakRawExportW) . ' W'
            . ' | Netzlimit=' . $gridLimitW . ' W'
            . ' | Sicherheitsabstand=' . $safetyW . ' W'
            . ' | effektives Limit=' . $effectiveGridLimitW . ' W'
            . ' | max. Batterieladung=' . $maxChargeW . ' W'
            . ' | erster kritischer Slot=' . ($firstCriticalTs > 0 ? date('d.m. H:i', $firstCriticalTs) : '-')
            . ' | Headroom=' . round($requiredHeadroomKWh, 3) . ' kWh'
            . ' | davon direkt Netzlimit=' . round($criticalEnergyKWh, 3) . ' kWh'
            . ' | unvermeidbar=' . round($unavoidableCurtailmentKWh, 3) . ' kWh'
        );

        return [
            'gridLimitW' => $gridLimitW,
            'safetyW' => $safetyW,
            'effectiveGridLimitW' => $effectiveGridLimitW,
            'maxChargeW' => $maxChargeW,
            'peakPVW' => $peakPVW,
            'peakRawExportW' => $peakRawExportW,
            'firstCriticalTs' => $firstCriticalTs,
            'lastCriticalTs' => $lastCriticalTs,
            'requiredHeadroomKWh' => $requiredHeadroomKWh,
            'criticalEnergyKWh' => $criticalEnergyKWh,
            'unavoidableCurtailmentKWh' => $unavoidableCurtailmentKWh,
            'slots' => $slots
        ];
    }

    private function GetRuntimeMinimumSOC(): float
    {
        return max(0.0, min(100.0, $this->GetRuntimeFloat('RuntimeMinimumSOC', $this->ReadPropertyFloat('MinimumSOC'))));
    }

    private function BuildPlan(array $forecast, array $prices, float $nightKWh, array $consumptionProfile): array
    {
        $socVar = $this->ReadPropertyInteger('SOCVariable');
        if ($socVar <= 0) throw new Exception('SoC-Variable fehlt.');
        $soc = max(0.0, min(100.0, (float)GetValue($socVar)));
        $capacity = max(0.1, $this->ReadPropertyFloat('BatteryCapacityKWh'));
        $stored = $capacity * $soc / 100.0;
        $minimumSOC = $this->GetRuntimeMinimumSOC();
        $minEnergy = $capacity * $minimumSOC / 100.0;
        $nightReserve = $nightKWh * (1.0 + $this->ReadPropertyFloat('SafetyReservePct') / 100.0);

        $tomorrowPV = (float)$forecast['tomorrowKWh'];
        $tomorrowConsumption = (float)($forecast['consumptionTomorrowKWh'] ?? 0.0);
        $pvOverlapConsumption = (float)($forecast['consumptionDuringPVTomorrowKWh'] ?? 0.0);
        $pvSurplusTomorrow = max(0.0, (float)($forecast['pvSurplusTomorrowKWh'] ?? ($tomorrowPV - $pvOverlapConsumption)));
        $gridRisk = $this->AnalyzeGridLimitRisk($forecast, $consumptionProfile);

        // Ziel: Der Speicher soll trotz geplanter Einspeisung am nächsten PV-Tag
        // wieder bis zum konfigurierten Ziel-SoC geladen werden können. Dafür wird
        // zuerst der gelernte Eigenverbrauch während der PV-Stunden abgezogen.
        $targetSOC = max($minimumSOC, min(100.0, $this->ReadPropertyFloat('BatteryTargetSOC')));
        $targetEnergy = $capacity * $targetSOC / 100.0;
        $requiredMorningStored = max($minEnergy, $targetEnergy - $pvSurplusTomorrow);
        $reserve = $nightReserve + $requiredMorningStored;

        if ($tomorrowPV < $this->ReadPropertyFloat('MinimumTomorrowPVKWh')) {
            $reserve = $requiredMorningStored + ($nightReserve * (1.0 + $this->ReadPropertyFloat('PoorForecastExtraReservePct') / 100.0));
        }

        // Für spätere Einspeisefenster am heutigen Abend darf nicht nur der
        // aktuelle Speicherstand betrachtet werden. Bis zum Nachtbeginn kann
        // die heutige PV-Produktion den Speicher noch deutlich nachladen.
        $now = time();
        $todayStart = strtotime('today 00:00:00');
        $nightStartToday = $this->DetermineNightStart(0, $todayStart);
        if ($nightStartToday <= $now) {
            $nightStartToday = $now;
        }

        $remainingPVToday = 0.0;
        $remainingLoadToday = 0.0;
        $hourlyLoad = isset($consumptionProfile['hourlyKWh']) && is_array($consumptionProfile['hourlyKWh'])
            ? $consumptionProfile['hourlyKWh']
            : array_fill(0, 24, 0.0);

        if ($nightStartToday > $now) {
            for ($h = 0; $h < 24; $h++) {
                $hourStart = $todayStart + $h * 3600;
                $hourEnd = $hourStart + 3600;
                $overlap = $this->OverlapSeconds($hourStart, $hourEnd, $now, $nightStartToday);
                if ($overlap <= 0) continue;

                $fraction = $overlap / 3600.0;
                $pvHour = isset($forecast['hours'][$hourStart])
                    ? max(0.0, (float)($forecast['hours'][$hourStart]['totalKW'] ?? 0.0))
                    : 0.0;
                $remainingPVToday += $pvHour * $fraction;
                $remainingLoadToday += max(0.0, (float)($hourlyLoad[$h] ?? 0.0)) * $fraction;
            }
        }

        $projectedStoredAtNightStart = min(
            $capacity,
            max($minEnergy, $stored + max(0.0, $remainingPVToday - $remainingLoadToday))
        );

        $status = 'Optimierung aktiv';
        if ($this->ReadPropertyBoolean('DisableFeedInOnVeryPoorForecast') && $tomorrowPV < $this->ReadPropertyFloat('VeryPoorForecastKWh')) {
            $availableNow = 0.0;
            $availableAtNightStart = 0.0;
            $available = 0.0;
            $status = 'Einspeisung gesperrt: PV-Prognose sehr schlecht';
        } else {
            $availableNow = max(0.0, $stored - $reserve);
            $availableAtNightStart = max(0.0, $projectedStoredAtNightStart - $reserve);
            // Für die Plananzeige ist die maximal im Planungshorizont erwartete
            // Einspeiseenergie relevant. Vor Nachtbeginn darf davon jedoch nur
            // $availableNow verwendet werden.
            $available = max($availableNow, $availableAtNightStart);
        }

        // Speicherplatz für den erwarteten PV-Überschuss freihalten. Der lernende
        // Verbrauch wird vorab von der PV-Prognose abgezogen.
        $pvSpaceRequired = 0.0;
        $pvTargetSOC = max($this->GetRuntimeMinimumSOC(), min(100.0, $this->GetRuntimeFloat('RuntimePVHeadroomTargetSOC', $this->ReadPropertyFloat('PVHeadroomTargetSOC'))));
        $expectedMorningStored = max($minEnergy, $projectedStoredAtNightStart - max(0.0, $nightReserve));
        $targetMaxEnergy = $capacity * $pvTargetSOC / 100.0;
        $expectedPVToBattery = $pvSurplusTomorrow * max(0.0, min(100.0, $this->GetRuntimeFloat('RuntimePVStorageSharePct', $this->ReadPropertyFloat('PVStorageSharePct')))) / 100.0;
        $morningHeadroom = max(0.0, $targetMaxEnergy - $expectedMorningStored);

        $normalPVSpaceRequired = max(0.0, $expectedPVToBattery - $morningHeadroom);
        $gridLimitSpaceRequired = max(0.0, (float)($gridRisk['requiredHeadroomKWh'] ?? 0.0));

        // Dynamische Nachregelung: Wird der eingestellte maximale PV-Ziel-SoC
        // früher als prognostiziert erreicht/überschritten, muss dieser reale
        // Überschuss zusätzlich wieder als Speicherplatz freigemacht werden.
        // Beispiel: Ziel 80 %, Ist 86 % -> 6 % der Batteriekapazität werden als
        // zusätzlicher Headroom eingeplant (begrenzt durch Mindest-SoC/Reserve).
        $currentTargetExcessKWh = max(0.0, $stored - $targetMaxEnergy);

        if ($this->GetRuntimeBoolean('PVCurtailmentProtectionEnabled', $this->ReadPropertyBoolean('PreventPVCurtailment')) && $available > 0.0) {
            // Der jeweils größere Bedarf gilt: normale PV-Aufnahme, Netzlimit-Risiko
            // oder bereits real zu früh erreichter Ziel-SoC.
            $pvSpaceRequired = min(
                $available,
                max($normalPVSpaceRequired, $gridLimitSpaceRequired, $currentTargetExcessKWh)
            );
            if ($currentTargetExcessKWh > 0.001) {
                $this->DebugLog(
                    'PV-Abregelung',
                    'Ziel-SoC früher erreicht: Ist=' . round($soc, 1) . ' %'
                    . ' | Ziel=' . round($pvTargetSOC, 1) . ' %'
                    . ' | zusätzlicher Headroom=' . round($currentTargetExcessKWh, 3) . ' kWh'
                );
            }
        }

        // Ohne Netzlimit-Risiko reicht die bisherige Planung bis zum PV-Morgen.
        // Bei drohender Abregelung muss der nötige Speicherplatz spätestens vor
        // dem ersten kritischen 15-Minuten-Slot geschaffen sein.
        $forecastCriticalDeadline = (int)($gridRisk['firstCriticalTs'] ?? 0);
        $targetSOCReachedNow = $currentTargetExcessKWh > 0.001;

        // Ist der PV-Ziel-SoC bereits erreicht/überschritten, beginnt der
        // Abregelungsschutz JETZT und wartet nicht auf den prognostizierten
        // kritischen PV-Zeitpunkt. Für die Slot-Auswahl bleibt mindestens die
        // nächste Stunde offen, damit unmittelbar verfügbare Preis-Slots
        // verwendet werden können.
        $criticalDeadline = $targetSOCReachedNow ? time() : $forecastCriticalDeadline;
        $horizonEnd = $targetSOCReachedNow
            ? time() + 3600
            : ($criticalDeadline > time()
                ? max(time() + 3600, $criticalDeadline)
                : max(time() + 3600, (int)$forecast['morningTs']));
        // Einspeiseslots ausschließlich innerhalb der kommenden/aktuellen Nacht.
        // Der Speicher wird tagsüber nicht für PV-Headroom entladen.
        $nightWindowStart = $this->DetermineNightStart(0, $todayStart);
        $nightWindowEnd = $this->DetermineMorningEnd(1, $todayStart + 86400);
        if ($now >= $nightWindowEnd) {
            $nightWindowStart = $this->DetermineNightStart(1, $todayStart + 86400);
            $nightWindowEnd = $this->DetermineMorningEnd(2, $todayStart + 2 * 86400);
        }
        $allSlots = [];
        foreach ($prices as $p) {
            if ($p['end'] <= max(time(), $nightWindowStart) || $p['start'] >= $nightWindowEnd) continue;
            $allSlots[] = $p;
        }

        $minimumFeedInPrice = $this->GetMinimumFeedInPriceCt();
        $economic = array_values(array_filter($allSlots, fn($p) => $p['priceCt'] >= $minimumFeedInPrice));
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
            $slotAvailability = ($slotStart >= $nightStartToday) ? $availableAtNightStart : $availableNow;
            $slotRemaining = max(0.0, $slotAvailability - $scheduledEnergy);
            if ($slotRemaining <= 0.001) continue;
            $batteryPowerW = $this->GetPlannedBatteryPowerW($consumptionProfile, $slotStart);
            $expectedExportKW = $this->GetExpectedGridExportPowerW($consumptionProfile, $slotStart) / 1000.0;
            if ($expectedExportKW <= 0.001 || $batteryPowerW <= 0.0) continue;
            $energy = min($remaining, $slotRemaining, $expectedExportKW * $durationH);
            // Die Verkaufsdauer basiert auf der erwartbaren NETZEINSPEISUNG, also
            // Batterieentladung minus gelerntem Eigenverbrauch. Die Batterie selbst
            // darf dafür höher fahren, um den zeitgleichen Hausverbrauch mitzuversorgen.
            $requiredSeconds = (int)ceil(($energy / $expectedExportKW) * 3600.0);
            $actualEnd = min($p['end'], $slotStart + max(1, $requiredSeconds));
            $key = $p['start'] . ':' . $p['end'];
            $selected[] = [
                'start' => $slotStart,
                'priceIntervalStart' => $p['start'],
                // plannedEnd berücksichtigt bereits das gelernte Lastprofil und die erwartbare Netzeinspeisung.
                // Die reale Beendigung steuert Control anhand der gemessenen Netzeinspeisung.
                'end' => $actualEnd,
                'priceIntervalEnd' => $p['end'],
                'planKey' => $key,
                'priceCt' => $p['priceCt'],
                'marketCt' => $p['marketCt'],
                'energyKWh' => $energy,
                'powerW' => $maxKW * 1000.0,
                'expectedGridExportW' => $expectedExportKW * 1000.0,
                'expectedLoadW' => $this->GetExpectedLoadPowerW($consumptionProfile, $slotStart),
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
        // PV-Abregelungsschutz ist von der preisoptimierten Nachtplanung getrennt.
        // Tagsüber wird erforderlicher Headroom direkt durch Control() geschaffen;
        // deshalb erzwingt pvSpaceRequired keine zusätzlichen Nacht-Preisfenster.
        $mandatoryMissing = 0.0;
        if ($mandatoryMissing > 0.001 && $remaining > 0.001 && $maxKW > 0) {
            $pvFloor = $this->GetMinimumFeedInPriceCt();
            $fallbackSlots = array_values(array_filter($allSlots, function ($p) use ($usedKeys, $pvFloor) {
                $key = $p['start'] . ':' . $p['end'];
                return !isset($usedKeys[$key]) && $p['priceCt'] >= $pvFloor;
            }));
            usort($fallbackSlots, fn($a, $b) => $b['priceCt'] <=> $a['priceCt']);
            $this->DebugLog(
                'PV-Speicherfreihaltung',
                'Zusätzlicher Bedarf=' . round($mandatoryMissing, 3) . ' kWh'
                . ' | Mindestpreis=' . round($pvFloor, 2) . ' ct/kWh'
                . ' | verfügbare Zusatz-Slots=' . count($fallbackSlots)
            );

            foreach ($fallbackSlots as $p) {
                if ($mandatoryMissing <= 0.001 || $remaining <= 0.001) break;
                $slotStart = max($p['start'], time());
                $durationH = max(0.0, ($p['end'] - $slotStart) / 3600.0);
                if ($durationH <= 0) continue;
                $slotAvailability = ($slotStart >= $nightStartToday) ? $availableAtNightStart : $availableNow;
                $slotRemaining = max(0.0, $slotAvailability - $scheduledEnergy);
                if ($slotRemaining <= 0.001) continue;
                $batteryPowerW = $this->GetPlannedBatteryPowerW($consumptionProfile, $slotStart);
                $expectedExportKW = $this->GetExpectedGridExportPowerW($consumptionProfile, $slotStart) / 1000.0;
                if ($expectedExportKW <= 0.001 || $batteryPowerW <= 0.0) continue;
                $energy = min($remaining, $mandatoryMissing, $slotRemaining, $expectedExportKW * $durationH);
                $selected[] = [
                    'start' => $slotStart,
                    'end' => $p['end'],
                    'priceCt' => $p['priceCt'],
                    'marketCt' => $p['marketCt'],
                    'energyKWh' => $energy,
                    'powerW' => $maxKW * 1000.0,
                    'expectedGridExportW' => $expectedExportKW * 1000.0,
                    'expectedLoadW' => $this->GetExpectedLoadPowerW($consumptionProfile, $slotStart),
                    'reason' => 'pv_space_required'
                ];
                $revenue += $energy * $p['priceCt'] / 100.0;
                $remaining -= $energy;
                $scheduledEnergy += $energy;
                $mandatoryMissing -= $energy;
            }
        }

        usort($selected, fn($a, $b) => $a['start'] <=> $b['start']);

        // Preisquelle arbeitet intern mit 15-Minuten-Slots, obwohl im Diagramm und für
        // die Vergütung Stundenmittel gelten. Werden aus einer Stunde nur z.B. 17 Minuten
        // benötigt und die direkt folgende Stunde ist ebenfalls ausgewählt, müssen diese
        // 17 Minuten AN DAS ENDE der ersten Stunde gelegt werden. Sonst entstünde z.B.
        // 18:00-18:17 + 19:00-20:00 mit unnötiger Pause statt 18:43-20:00.
        $selectedByHour = [];
        foreach ($selected as $slot) {
            $hourStart = strtotime(date('Y-m-d H:00:00', (int)($slot['priceIntervalStart'] ?? $slot['start'])));
            if (!isset($selectedByHour[$hourStart])) $selectedByHour[$hourStart] = [];
            $selectedByHour[$hourStart][] = $slot;
        }
        ksort($selectedByHour);
        $packedSelected = [];
        $selectedHours = array_keys($selectedByHour);
        foreach ($selectedHours as $hourIndex => $hourStart) {
            $hourSlots = $selectedByHour[$hourStart];
            $hourEnd = $hourStart + 3600;
            $duration = 0;
            $energy = 0.0;
            $revenueEnergy = 0.0;
            foreach ($hourSlots as $slot) {
                $duration += max(0, (int)$slot['end'] - (int)$slot['start']);
                $energy += (float)($slot['energyKWh'] ?? 0.0);
                $revenueEnergy += (float)($slot['energyKWh'] ?? 0.0) * (float)($slot['priceCt'] ?? 0.0);
            }
            if ($duration <= 0) continue;

            $nextHourSelected = isset($selectedByHour[$hourEnd]);
            $isPartialHour = $duration < 3599;
            $packedStart = min((int)$hourSlots[0]['start'], $hourStart);
            $packedEnd = $packedStart + $duration;
            if ($isPartialHour && $nextHourSelected) {
                $packedEnd = $hourEnd;
                $packedStart = max(time(), $hourEnd - $duration);
            }

            $first = $hourSlots[0];
            $first['start'] = $packedStart;
            $first['end'] = $packedEnd;
            $first['priceIntervalStart'] = $hourStart;
            $first['priceIntervalEnd'] = $hourEnd;
            $first['planKey'] = $hourStart . ':' . $hourEnd;
            $first['energyKWh'] = $energy;
            if ($energy > 0.0) $first['priceCt'] = $revenueEnergy / $energy;
            $first['powerW'] = max(array_map(static fn($x) => (float)($x['powerW'] ?? 0.0), $hourSlots));
            $first['expectedGridExportW'] = $duration > 0 ? ($energy / ($duration / 3600.0)) * 1000.0 : 0.0;
            $packedSelected[] = $first;
        }
        $selected = $packedSelected;
        usort($selected, fn($a, $b) => $a['start'] <=> $b['start']);

        // Erwarteten SoC am Beginn jedes geplanten Fensters festschreiben. Dieser
        // Referenzwert bleibt mit dem verbindlichen Plan erhalten und wird beim
        // tatsächlichen Start mit dem realen SoC verglichen.
        $plannedExportBeforeKWh = 0.0;
        foreach ($selected as $i => $slot) {
            $slotStartTs = (int)($slot['start'] ?? $now);
            if ($slotStartTs >= $nightStartToday) {
                $expectedEnergyAtStart = $projectedStoredAtNightStart;
                $fromTs = $nightStartToday;
            } else {
                $expectedEnergyAtStart = $stored;
                $fromTs = $now;
            }
            if ($slotStartTs > $fromTs) {
                $expectedEnergyAtStart -= $this->EstimateConsumptionEnergyBetween($consumptionProfile, $fromTs, $slotStartTs);
            }
            $expectedEnergyAtStart -= $plannedExportBeforeKWh;
            $expectedEnergyAtStart = max($minEnergy, min($capacity, $expectedEnergyAtStart));
            $selected[$i]['expectedSOCPct'] = max(0.0, min(100.0, ($expectedEnergyAtStart / $capacity) * 100.0));
            $plannedExportBeforeKWh += max(0.0, (float)($slot['energyKWh'] ?? 0.0));
        }

        $next = '-';
        $nowForNext = time();
        foreach ($selected as $idx => $slot) {
            if ($slot['end'] <= $nowForNext) continue;

            $windowStart = $slot['start'];
            $windowEnd = $slot['end'];

            // Direkt anschließende 15-Minuten-Slots gehören für die Anzeige zu
            // einem Einspeisefenster. Intern bleiben sie für die Preissteuerung getrennt.
            for ($j = $idx + 1; $j < count($selected); $j++) {
                $candidate = $selected[$j];
                if ($candidate['start'] > $windowEnd + 1) break;
                if ($candidate['start'] <= $windowEnd + 1) {
                    $windowEnd = max($windowEnd, $candidate['end']);
                }
            }

            $next = date('d.m. H:i', $windowStart) . '–' . date('H:i', $windowEnd);
            break;
        }
        $highest = count($selected) ? max(array_column($selected, 'priceCt')) : 0.0;

        if ($targetSOCReachedNow) {
            $status .= ' | Netzlimit-Schutz JETZT'
                . ' (SoC ' . number_format($soc, 1, ',', '.') . ' %'
                . ' ≥ Ziel ' . number_format($pvTargetSOC, 1, ',', '.') . ' %)';
            if ($forecastCriticalDeadline > time()) {
                $status .= ' | prognostiziertes Netzlimit ' . date('d.m. H:i', $forecastCriticalDeadline);
            }
        } elseif ($forecastCriticalDeadline > 0) {
            $status .= ' | Netzlimit-Schutz ab ' . date('d.m. H:i', $forecastCriticalDeadline);
        }

        if ($pvSpaceRequired > 0.05) {
            $pvFloor = $this->GetMinimumFeedInPriceCt();
            $status .= ' | PV-Speicherfreihaltung ' . number_format($pvSpaceRequired, 2, ',', '.') . ' kWh'
                . ' | Preisuntergrenze ' . number_format($pvFloor, 2, ',', '.') . ' ct/kWh';
            if ($mandatoryMissing > 0.05) {
                $status .= ' (noch ' . number_format($mandatoryMissing, 2, ',', '.') . ' kWh ungeplant – unter Preisgrenze oder keine Slots)';
            }
        }

        $this->DebugLog(
            'Plan-Berechnung',
            'SoC=' . round($soc,1) . '%'
            . ' | Speicher jetzt=' . round($stored,3) . ' kWh'
            . ' | Rest-PV heute=' . round($remainingPVToday,3) . ' kWh'
            . ' | Rest-Verbrauch bis Nacht=' . round($remainingLoadToday,3) . ' kWh'
            . ' | Speicher bei Nachtbeginn=' . round($projectedStoredAtNightStart,3) . ' kWh'
            . ' | Nachtreserve inkl. Sicherheit=' . round($nightReserve,3) . ' kWh'
            . ' | Morgenreserve=' . round($requiredMorningStored,3) . ' kWh'
            . ' | Gesamtreserve=' . round($reserve,3) . ' kWh'
            . ' | verfügbar jetzt=' . round($availableNow,3) . ' kWh'
            . ' | verfügbar ab Nachtbeginn=' . round($availableAtNightStart,3) . ' kWh'
            . ' | PV morgen=' . round($tomorrowPV,3) . ' kWh'
            . ' | Überschuss=' . round($pvSurplusTomorrow,3) . ' kWh'
            . ' | PV Spitze=' . round((float)($gridRisk['peakPVW'] ?? 0)) . ' W'
            . ' | Roh-Netzeinspeisung max=' . round((float)($gridRisk['peakRawExportW'] ?? 0)) . ' W'
            . ' | Netzlimit-Headroom=' . round((float)($gridRisk['requiredHeadroomKWh'] ?? 0),3) . ' kWh'
            . ' | Slots=' . count($selected)
        );

        return [
            'soc' => $soc,
            'storedKWh' => $stored,
            'reserveKWh' => $reserve,
            'nightReserveKWh' => $nightReserve,
            'morningReserveKWh' => $requiredMorningStored,
            'minimumEnergyKWh' => $minEnergy,
            'availableKWh' => $available,
            'requiredMorningStoredKWh' => $requiredMorningStored,
            'nightReserveKWh' => $nightReserve,
            'availableNowKWh' => $availableNow,
            'availableAtNightStartKWh' => $availableAtNightStart,
            'remainingPVTodayKWh' => $remainingPVToday,
            'remainingLoadUntilNightKWh' => $remainingLoadToday,
            'projectedStoredAtNightStartKWh' => $projectedStoredAtNightStart,
            'nightStartTodayTs' => $nightStartToday,
            'pvSpaceRequiredKWh' => $pvSpaceRequired,
            'normalPVSpaceRequiredKWh' => $normalPVSpaceRequired,
            'gridLimitSpaceRequiredKWh' => $gridLimitSpaceRequired,
            'currentTargetExcessKWh' => $currentTargetExcessKWh,
            'gridLimitFirstCriticalTs' => (int)($gridRisk['firstCriticalTs'] ?? 0),
            'gridLimitLastCriticalTs' => (int)($gridRisk['lastCriticalTs'] ?? 0),
            'gridLimitW' => (float)($gridRisk['gridLimitW'] ?? 0),
            'gridLimitEffectiveW' => (float)($gridRisk['effectiveGridLimitW'] ?? 0),
            'pvPeakPowerTomorrowW' => (float)($gridRisk['peakPVW'] ?? 0),
            'predictedMaxGridExportTomorrowW' => (float)($gridRisk['peakRawExportW'] ?? 0),
            'gridLimitCriticalEnergyKWh' => (float)($gridRisk['criticalEnergyKWh'] ?? 0),
            'unavoidableCurtailmentKWh' => (float)($gridRisk['unavoidableCurtailmentKWh'] ?? 0),
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

    private function PreserveCommittedFeedInPlan(array $newPlan, array $previousPlan): array
    {
        $now = time();
        $oldSlots = isset($previousPlan['slots']) && is_array($previousPlan['slots']) ? $previousPlan['slots'] : [];
        if (empty($oldSlots)) return $newPlan;

        $completed = json_decode($this->ReadAttributeString('CompletedFeedInPlanKeysJSON'), true);
        if (!is_array($completed)) $completed = [];
        $committed = [];
        foreach ($oldSlots as $slot) {
            $key = (string)($slot['planKey'] ?? ((int)($slot['start'] ?? 0) . ':' . (int)($slot['priceIntervalEnd'] ?? ($slot['end'] ?? 0))));
            $intervalEnd = (int)($slot['priceIntervalEnd'] ?? ($slot['end'] ?? 0));
            if ($intervalEnd <= $now || isset($completed[$key])) continue;
            $slot['planKey'] = $key;
            $committed[] = $slot;
        }
        if (empty($committed)) return $newPlan;

        usort($committed, fn($a, $b) => ((int)$a['start']) <=> ((int)$b['start']));
        $newPlan['slots'] = $committed;
        $newPlan['nextWindow'] = date('d.m. H:i', (int)$committed[0]['start']) . '–' . date('H:i', (int)$committed[0]['end']);
        $newPlan['highestPriceCt'] = max(array_map(static fn($x) => (float)($x['priceCt'] ?? 0.0), $committed));
        $newPlan['expectedRevenueEUR'] = array_sum(array_map(static fn($x) => (float)($x['energyKWh'] ?? 0.0) * (float)($x['priceCt'] ?? 0.0) / 100.0, $committed));
        $newPlan['status'] = 'Verbindlicher Einspeiseplan aktiv – geplante Fenster bleiben bis zur Ausführung erhalten';
        $this->DebugLog('Einspeiseplan', 'Verbindlichen bestehenden Plan beibehalten | offene Slots=' . count($committed));
        return $newPlan;
    }

    private function EstimateConsumptionEnergyBetween(array $consumptionProfile, int $fromTs, int $toTs): float
    {
        if ($toTs <= $fromTs) return 0.0;
        $hourly = isset($consumptionProfile['hourlyKWh']) && is_array($consumptionProfile['hourlyKWh'])
            ? $consumptionProfile['hourlyKWh'] : array_fill(0, 24, 0.0);
        $energy = 0.0;
        $cursor = $fromTs;
        while ($cursor < $toTs) {
            $hourStart = strtotime(date('Y-m-d H:00:00', $cursor));
            $hourEnd = $hourStart + 3600;
            $segmentEnd = min($toTs, $hourEnd);
            $fraction = max(0, $segmentEnd - $cursor) / 3600.0;
            $hour = max(0, min(23, (int)date('G', $cursor)));
            $energy += max(0.0, (float)($hourly[$hour] ?? 0.0)) * $fraction;
            $cursor = $segmentEnd;
        }
        return $energy;
    }

    private function GetExpectedLoadPowerW(array $consumptionProfile, int $timestamp): float
    {
        $hourly = isset($consumptionProfile['hourlyKWh']) && is_array($consumptionProfile['hourlyKWh'])
            ? $consumptionProfile['hourlyKWh'] : array_fill(0, 24, 0.0);
        $hour = max(0, min(23, (int)date('G', $timestamp)));
        // kWh pro Stunde entspricht der mittleren Leistung in kW für diese Stunde.
        return max(0.0, (float)($hourly[$hour] ?? 0.0)) * 1000.0;
    }

    private function GetPlannedBatteryPowerW(array $consumptionProfile, int $timestamp): float
    {
        $maxDischargeW = max(0.0, (float)$this->ReadPropertyInteger('MaxDischargePowerW'));
        $loadW = $this->GetExpectedLoadPowerW($consumptionProfile, $timestamp);
        $gridLimitW = max(0.0, (float)$this->GetRuntimeInteger('RuntimeGridFeedInLimitW', $this->ReadPropertyInteger('GridFeedInLimitW')));
        $safetyW = max(0.0, (float)$this->GetRuntimeInteger('RuntimeGridLimitSafetyW', $this->ReadPropertyInteger('GridLimitSafetyW')));
        $effectiveGridLimitW = $gridLimitW > 0.0 ? max(0.0, $gridLimitW - $safetyW) : $maxDischargeW;
        // Batterie muss Eigenverbrauch + gewünschte Netzeinspeisung liefern, darf aber weder
        // ihre Entladegrenze noch die effektive Netzeinspeisegrenze überschreiten.
        return max(0.0, min($maxDischargeW, $effectiveGridLimitW + $loadW));
    }

    private function GetExpectedGridExportPowerW(array $consumptionProfile, int $timestamp): float
    {
        $batteryW = $this->GetPlannedBatteryPowerW($consumptionProfile, $timestamp);
        $loadW = $this->GetExpectedLoadPowerW($consumptionProfile, $timestamp);
        return max(0.0, $batteryW - $loadW);
    }

    private function EstimateFeedInDurationSeconds(float $remainingKWh, int $startTs, int $hardEndTs, array $consumptionProfile): int
    {
        if ($remainingKWh <= 0.0 || $hardEndTs <= $startTs) return 0;
        $cursor = $startTs;
        $remaining = $remainingKWh;
        $seconds = 0;
        while ($cursor < $hardEndTs && $remaining > 0.0001) {
            $hourEnd = strtotime(date('Y-m-d H:00:00', $cursor)) + 3600;
            $segmentEnd = min($hardEndTs, $hourEnd);
            $segmentSeconds = max(0, $segmentEnd - $cursor);
            if ($segmentSeconds <= 0) break;
            $exportW = $this->GetExpectedGridExportPowerW($consumptionProfile, $cursor);
            if ($exportW > 1.0) {
                $segmentKWh = $exportW * ($segmentSeconds / 3600.0) / 1000.0;
                if ($segmentKWh >= $remaining) {
                    $needSeconds = (int)ceil(($remaining * 1000.0 / $exportW) * 3600.0);
                    $seconds += min($segmentSeconds, max(1, $needSeconds));
                    $remaining = 0.0;
                    break;
                }
                $remaining -= $segmentKWh;
            }
            $seconds += $segmentSeconds;
            $cursor = $segmentEnd;
        }
        return max(0, $seconds);
    }

    private function UpdateActivePlanWindowEnd(string $planKey, int $newEnd): void
    {
        if ($planKey === '' || $newEnd <= 0) return;
        $plan = json_decode($this->ReadAttributeString('PlanJSON'), true);
        if (!is_array($plan) || !isset($plan['slots']) || !is_array($plan['slots'])) return;
        $changed = false;
        foreach ($plan['slots'] as &$slot) {
            $key = (string)($slot['planKey'] ?? ((int)($slot['priceIntervalStart'] ?? $slot['start']) . ':' . (int)($slot['priceIntervalEnd'] ?? $slot['end'])));
            if ($key !== $planKey) continue;
            $slot['end'] = $newEnd;
            $changed = true;
            break;
        }
        unset($slot);
        if (!$changed) return;
        $plan['nextWindow'] = date('d.m. H:i', time()) . '–' . date('H:i', $newEnd);
        $this->WriteAttributeString('PlanJSON', json_encode($plan));
        SetValue($this->GetIDForIdent('NextFeedInWindow'), $plan['nextWindow']);
        $forecast = json_decode($this->ReadAttributeString('ForecastJSON'), true);
        if (!is_array($forecast)) $forecast = [];
        $prices = json_decode($this->ReadAttributeString('PricesJSON'), true);
        if (!is_array($prices)) $prices = [];
        SetValue($this->GetIDForIdent('PlanHTML'), $this->RenderPlanHTML($forecast, $prices, $plan));
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
                $this->DebugLog('ConsumptionProfile', 'Logging-Status konnte nicht geprüft werden: ' . $e->getMessage(), 0);
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

        $minimumConsumptionDays = max(1, min($days, $this->ReadPropertyInteger('MinimumValidConsumptionDays')));
        if ($validDays < $minimumConsumptionDays) {
            if (is_array($cached) && isset($cached['hourlyKWh']) && count($cached['hourlyKWh']) === 24) {
                $source = 'Letztes Verbrauchsprofil – nur ' . $validDays . '/' . $minimumConsumptionDays . ' gültige Tage';
                $cached['source'] = $source;
                $this->WriteAttributeString('ConsumptionLearningSource', $source);
                return $cached;
            }
            return $this->BuildFallbackConsumptionProfile($fallbackDaily, 'Fallback – nur ' . $validDays . '/' . $minimumConsumptionDays . ' gültige Verbrauchstage');
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
        $this->DebugLog('ConsumptionProfile', $source . ', Prognose ' . round($result['dailyKWh'], 3) . ' kWh', 0);
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
        // Für den aktuellen Tag niemals über "jetzt" hinaus integrieren.
        // Sonst würde der letzte archivierte Leistungswert künstlich bis Mitternacht
        // fortgeschrieben und die aktuelle/zukünftige Stunde als voller Ist-Verbrauch erscheinen.
        $integrationEnd = min($dayEnd, time());
        if ($integrationEnd <= $dayStart) return null;
        $values = @AC_GetLoggedValues($archiveID, $varID, $dayStart, $integrationEnd, 0);
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
            $segmentEnd = ($i + 1 < count($values)) ? min($integrationEnd, (int)$values[$i + 1]['TimeStamp']) : $integrationEnd;
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

    private function StorePVForecastHistory(array $forecast): void
    {
        $history = json_decode($this->ReadAttributeString('PVForecastHistoryJSON'), true);
        if (!is_array($history)) $history = [];

        $hours = is_array($forecast['hours'] ?? null) ? $forecast['hours'] : [];
        $now = time();
        $todayDate = date('Y-m-d', $now);
        $tomorrowDate = date('Y-m-d', strtotime('tomorrow', $now));

        foreach ([$todayDate, $tomorrowDate] as $date) {
            $dayStart = strtotime($date . ' 00:00:00');
            $existing = is_array($history[$date]['hourlyKWh'] ?? null)
                ? array_values($history[$date]['hourlyKWh'])
                : array_fill(0, 24, null);

            // Immer exakt 24 Stunden vorhalten.
            $existing = array_pad(array_slice($existing, 0, 24), 24, null);
            $hourlyKWh = $existing;

            for ($h = 0; $h < 24; $h++) {
                $hourStart = $dayStart + $h * 3600;
                $hourEnd = $hourStart + 3600;

                // Abgelaufene Stunden werden nie wieder verändert.
                // Die aktuelle Stunde und alle zukünftigen Stunden dürfen durch
                // neuere Open-Meteo-Prognosen aktualisiert werden.
                if ($date === $todayDate && $hourEnd <= $now && $hourlyKWh[$h] !== null) {
                    continue;
                }

                $hourlyKWh[$h] = round(
                    max(0.0, (float)($hours[$hourStart]['totalKW'] ?? 0.0)),
                    4
                );
            }

            $history[$date] = [
                'hourlyKWh' => $hourlyKWh,
                'totalKWh' => array_sum(array_map(
                    static fn($v) => $v === null ? 0.0 : (float)$v,
                    $hourlyKWh
                )),
                'savedAt' => $now,
                'dayAhead' => ($date === $tomorrowDate)
            ];
        }

        ksort($history);
        $cutoff = strtotime('-14 days 00:00:00', $now);
        foreach (array_keys($history) as $date) {
            $ts = strtotime($date . ' 00:00:00');
            if ($ts !== false && $ts < $cutoff) unset($history[$date]);
        }

        $this->WriteAttributeString('PVForecastHistoryJSON', json_encode($history));
    }

    private function GetActualPVHourlyForDay(int $dayStart): array
    {
        $result = [
            'hourlyKWh' => array_fill(0, 24, null),
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

        $dayEnd = $dayStart + 86400;
        if ($dayStart > time()) return $result;
        $end = min(time(), $dayEnd);
        if ($end <= $dayStart) return $result;

        $hourlyWh = array_fill(0, 24, 0.0);
        $hasData = false;
        foreach ($variableIDs as $varID) {
            if (function_exists('AC_GetLoggingStatus')) {
                try {
                    if (!AC_GetLoggingStatus($archiveID, $varID)) continue;
                } catch (Throwable $e) {
                    $this->DebugLog('PVActualChart', 'Logging-Status konnte nicht geprüft werden: ' . $e->getMessage(), 0);
                }
            }
            $values = @AC_GetLoggedValues($archiveID, $varID, $dayStart, $end, 0);
            if (!is_array($values)) $values = [];
            $values = array_reverse($values);
            $prev = @AC_GetLoggedValues($archiveID, $varID, 0, $dayStart - 1, 1);
            if (is_array($prev) && count($prev) > 0) {
                array_unshift($values, ['TimeStamp' => $dayStart, 'Value' => $prev[0]['Value']]);
            } elseif (count($values) > 0 && (int)$values[0]['TimeStamp'] > $dayStart) {
                array_unshift($values, ['TimeStamp' => $dayStart, 'Value' => $values[0]['Value']]);
            }
            if (count($values) === 0) continue;
            $hasData = true;

            for ($i = 0; $i < count($values); $i++) {
                $segmentStart = max($dayStart, (int)$values[$i]['TimeStamp']);
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
        for ($h = 0; $h < 24; $h++) {
            $hourStart = $dayStart + $h * 3600;
            if ($hourStart >= $end) {
                $result['hourlyKWh'][$h] = null;
            } else {
                $result['hourlyKWh'][$h] = round($hourlyWh[$h] / 1000.0, 4);
            }
        }
        $result['energyKWh'] = array_sum($hourlyWh) / 1000.0;
        return $result;
    }

    private function ApplyConsumptionForecastToPV(array $forecast, array $profile, float $learnedNightKWh): array
    {
        $hourly = isset($profile['hourlyKWh']) && is_array($profile['hourlyKWh'])
            ? $profile['hourlyKWh']
            : array_fill(0, 24, 0.0);

        $tomorrowStart = strtotime('tomorrow 00:00:00');
        $tomorrowEnd = $tomorrowStart + 86400;
        $nightEnd = $this->DetermineMorningEnd(0, $tomorrowStart);
        $nightStart = $this->DetermineNightStart(0, $tomorrowStart);
        $thresholdKW = max(0.0, $this->ReadPropertyInteger('MorningPVThresholdW') / 1000.0);

        $totalConsumption = 0.0;
        for ($h = 0; $h < 24; $h++) {
            $totalConsumption += max(0.0, (float)($hourly[$h] ?? 0.0));
        }

        $nightConsumption = min($totalConsumption, max(0.0, $learnedNightKWh));
        $dayConsumption = max(0.0, $totalConsumption - $nightConsumption);

        $rawDayProfile = 0.0;
        $dayFractions = [];
        $pvKWhByHour = [];

        for ($h = 0; $h < 24; $h++) {
            $hourStart = $tomorrowStart + $h * 3600;
            $hourEnd = $hourStart + 3600;
            $loadKWh = max(0.0, (float)($hourly[$h] ?? 0.0));

            $nightSeconds = 0;
            $nightSeconds += $this->OverlapSeconds($hourStart, $hourEnd, $tomorrowStart, min($tomorrowEnd, $nightEnd));
            $nightSeconds += $this->OverlapSeconds($hourStart, $hourEnd, max($tomorrowStart, $nightStart), $tomorrowEnd);
            $nightFraction = max(0.0, min(1.0, $nightSeconds / 3600.0));
            $dayFraction = 1.0 - $nightFraction;
            $dayFractions[$h] = $dayFraction;

            $rawDayProfile += $loadKWh * $dayFraction;

            $pvKWhByHour[$h] = isset($forecast['hours'][$hourStart])
                ? max(0.0, (float)$forecast['hours'][$hourStart]['totalKW'])
                : 0.0;
        }

        $dayScale = $rawDayProfile > 0.000001 ? ($dayConsumption / $rawDayProfile) : 0.0;
        $consumptionDuringPV = 0.0;
        $otherDayConsumption = 0.0;
        $netPVSurplus = 0.0;

        for ($h = 0; $h < 24; $h++) {
            $loadKWh = max(0.0, (float)($hourly[$h] ?? 0.0));
            $dayLoadKWh = $loadKWh * ($dayFractions[$h] ?? 0.0) * $dayScale;
            $pvKWh = $pvKWhByHour[$h] ?? 0.0;

            if (($dayFractions[$h] ?? 0.0) > 0.0 && $pvKWh >= $thresholdKW) {
                $consumptionDuringPV += $dayLoadKWh;
                $netPVSurplus += max(0.0, $pvKWh - $dayLoadKWh);
            } else {
                $otherDayConsumption += $dayLoadKWh;
            }
        }

        $consumptionDuringPV = min($consumptionDuringPV, max(0.0, $totalConsumption - $nightConsumption));
        $otherDayConsumption = max(0.0, $totalConsumption - $nightConsumption - $consumptionDuringPV);

        $forecast['consumptionTomorrowKWh'] = $totalConsumption;
        $forecast['nightConsumptionTomorrowKWh'] = $nightConsumption;
        $forecast['dayConsumptionTomorrowKWh'] = $dayConsumption;
        $forecast['consumptionDuringPVTomorrowKWh'] = $consumptionDuringPV;
        $forecast['otherDayConsumptionTomorrowKWh'] = $otherDayConsumption;
        $forecast['pvSurplusTomorrowKWh'] = $netPVSurplus;
        $forecast['consumptionProfile'] = $profile;

        $this->DebugLog(
            'PV/Eigenverbrauch',
            'Morgen gesamt=' . round($totalConsumption, 3)
            . ' kWh | Nacht=' . round($nightConsumption, 3)
            . ' kWh | PV-Zeit=' . round($consumptionDuringPV, 3)
            . ' kWh | übriger Tag=' . round($otherDayConsumption, 3)
            . ' kWh | Summe=' . round($nightConsumption + $consumptionDuringPV + $otherDayConsumption, 3)
            . ' kWh | PV-Überschuss=' . round($netPVSurplus, 3) . ' kWh'
        );

        return $forecast;
    }

    private function OverlapSeconds(int $startA, int $endA, int $startB, int $endB): int
    {
        if ($endA <= $startA || $endB <= $startB) {
            return 0;
        }
        return max(0, min($endA, $endB) - max($startA, $startB));
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
                $this->DebugLog('NightArchive', 'Logging-Status konnte nicht geprüft werden: ' . $e->getMessage(), 0);
            }
        }

        $days = max(3, $this->ReadPropertyInteger('LearningDays'));
        $minimumSamples = max(1, min($days, $this->ReadPropertyInteger('MinimumValidNights')));
        $samples = [];
        for ($d = 1; $d <= $days; $d++) {
            $day = strtotime('-' . $d . ' days 00:00');
            $start = $this->DetermineNightStart($archiveID, $day);
            $end = $this->DetermineMorningEnd($archiveID, $day + 86400);
            if ($end <= $start) continue;
            $kwh = $this->IntegratePowerVariable($archiveID, $varID, $start, $end);
            $durationH = max(0.0, ($end - $start) / 3600.0);
            $avgW = $durationH > 0 ? ($kwh / $durationH) * 1000.0 : 0.0;
            $this->DebugLog(
                'NightWindow',
                date('d.m.Y', $day)
                . ' | ' . date('H:i', $start) . '–' . date('H:i', $end)
                . ' | Dauer=' . number_format($durationH, 2, '.', '') . ' h'
                . ' | Verbrauch=' . number_format($kwh, 2, '.', '') . ' kWh'
                . ' | Ø=' . number_format($avgW, 0, '.', '') . ' W'
                . ' | ' . ($this->ReadPropertyBoolean('AutomaticDayNight') ? 'automatisch' : 'manuell')
            );
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
                $this->DebugLog('NightConsumption', $source, 0);
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
        $this->DebugLog('NightConsumption', $source . ', Prognose ' . round($learned, 3) . ' kWh', 0);
        return $learned;
    }

    private function UseNightFallback(float $fallback, string $source, int $samples): float
    {
        $this->WriteAttributeString('NightLearningSource', $source);
        $this->WriteAttributeInteger('NightSampleCount', $samples);
        $this->DebugLog('NightConsumption', $source . ', Wert ' . round($fallback, 3) . ' kWh', 0);
        return $fallback;
    }

    private function DetermineNightStart(int $archiveID, int $dayTs): int
    {
        $manual = strtotime(date('Y-m-d', $dayTs) . ' ' . str_pad((string)$this->ReadPropertyInteger('NightStartHour'), 2, '0', STR_PAD_LEFT) . ':00');
        if (!$this->ReadPropertyBoolean('AutomaticDayNight')) return $manual;

        $sunset = $this->GetSolarEventForDate($this->ReadPropertyInteger('SunsetVariable'), $dayTs, $archiveID);
        if ($sunset === null) {
            $this->DebugLog('DayNight', 'Sonnenuntergang nicht lesbar -> manueller Nachtbeginn ' . date('H:i', $manual));
            return $manual;
        }

        // Nacht beginnt exakt: Sonnenuntergang des Tages - konfigurierbarer Vorlauf.
        $offset = max(0, min(360, $this->ReadPropertyInteger('NightBeforeSunsetMinutes')));
        $nightStart = $sunset - $offset * 60;
        $this->DebugLog(
            'DayNight',
            date('Y-m-d', $dayTs)
            . ' Sonnenuntergang=' . date('H:i', $sunset)
            . ' | Vorlauf=' . $offset . ' min'
            . ' | Nachtbeginn=' . date('H:i', $nightStart)
        );
        return $nightStart;
    }

    private function DetermineMorningEnd(int $archiveID, int $morningDayTs): int
    {
        $manual = strtotime(date('Y-m-d', $morningDayTs) . ' ' . str_pad((string)$this->ReadPropertyInteger('FallbackMorningHour'), 2, '0', STR_PAD_LEFT) . ':00');
        if (!$this->ReadPropertyBoolean('AutomaticDayNight')) return $manual;

        $sunrise = $this->GetSolarEventForDate($this->ReadPropertyInteger('SunriseVariable'), $morningDayTs, $archiveID);
        if ($sunrise === null) {
            $this->DebugLog('DayNight', 'Sonnenaufgang nicht lesbar -> manuelles Nachtende ' . date('H:i', $manual));
            return $manual;
        }

        // Nacht endet exakt: Sonnenaufgang des Folgetages + konfigurierbarer Nachlauf.
        $offset = max(0, min(360, $this->ReadPropertyInteger('NightAfterSunriseMinutes')));
        $nightEnd = $sunrise + $offset * 60;
        $this->DebugLog(
            'DayNight',
            date('Y-m-d', $morningDayTs)
            . ' Sonnenaufgang=' . date('H:i', $sunrise)
            . ' | Nachlauf=' . $offset . ' min'
            . ' | Nachtende=' . date('H:i', $nightEnd)
        );
        return $nightEnd;
    }

    private function GetSolarEventForDate(int $variableID, int $dayTs, int $archiveID = 0): ?int
    {
        if ($variableID <= 0 || !@IPS_VariableExists($variableID)) {
            return null;
        }

        $dayStart = strtotime(date('Y-m-d', $dayTs) . ' 00:00:00');
        $dayNoon = $dayStart + 12 * 3600;

        if ($archiveID > 0) {
            // Gesucht ist nicht irgendein Änderungswert innerhalb des Tages,
            // sondern der Sonnenzeitwert, der an diesem Kalendertag gültig war.
            // AC_GetLoggedValues liefert bei Limit 1 den letzten bekannten Wert
            // bis zum angegebenen Zeitpunkt. 12:00 Uhr ist bewusst gewählt:
            // tägliche Sonnenzeitvariablen sind dann normalerweise bereits
            // aktualisiert, aber noch nicht auf den Folgetag weitergeschaltet.
            $valueAtDay = @AC_GetLoggedValues($archiveID, $variableID, 0, $dayNoon, 1);
            if (is_array($valueAtDay) && count($valueAtDay) > 0 && array_key_exists('Value', $valueAtDay[0])) {
                $parsed = $this->ParseSolarEventValueForDate($valueAtDay[0]['Value'], $dayTs);
                if ($parsed !== null) {
                    return $parsed;
                }
            }
        }

        // Für heute / morgen bzw. falls kein Archivwert verfügbar ist:
        // Die Uhrzeit aus dem aktuellen Variablenwert verwenden und auf den
        // angefragten Kalendertag übertragen.
        return $this->ParseSolarEventValueForDate(@GetValue($variableID), $dayTs);
    }


    private function ParseSolarEventValueForDate($value, int $dayTs): ?int
    {
        $date = date('Y-m-d', $dayTs);

        if (is_int($value) || is_float($value) || (is_string($value) && is_numeric(trim($value)))) {
            $n = (float)$value;
            if ($n > 100000000) {
                $ts = (int)round($n);
                return strtotime($date . ' ' . date('H:i:s', $ts));
            }
            if ($n >= 0 && $n < 86400) {
                return strtotime($date . ' 00:00:00') + (int)round($n);
            }
        }

        if (is_string($value)) {
            $v = trim($value);
            if ($v === '') return null;

            if (preg_match('/^(\d{1,2}):(\d{2})(?::(\d{2}))?$/', $v, $m)) {
                $h = max(0, min(23, (int)$m[1]));
                $min = max(0, min(59, (int)$m[2]));
                $sec = isset($m[3]) ? max(0, min(59, (int)$m[3])) : 0;
                return strtotime(sprintf('%s %02d:%02d:%02d', $date, $h, $min, $sec));
            }

            $ts = strtotime($v);
            if ($ts !== false) return strtotime($date . ' ' . date('H:i:s', $ts));
        }

        return null;
    }

    private function GetCurrentDayNightStatus(): array
    {
        $now = time();
        $today = strtotime('today 00:00:00');
        $morningEnd = $this->DetermineMorningEnd(0, $today);
        $nightStart = $this->DetermineNightStart(0, $today);

        if ($now < $morningEnd) {
            return [
                'isNight' => true,
                'start' => $this->DetermineNightStart(0, strtotime('yesterday 00:00:00')),
                'end' => $morningEnd
            ];
        }

        if ($now >= $nightStart) {
            return [
                'isNight' => true,
                'start' => $nightStart,
                'end' => $this->DetermineMorningEnd(0, strtotime('tomorrow 00:00:00'))
            ];
        }

        return ['isNight' => false, 'start' => $morningEnd, 'end' => $nightStart];
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
        if ($enable) {
            $priceLock = $this->GetFeedInPriceLockInfo();
            if (!empty($priceLock['blocked'])) {
                $this->DebugLog('Batterie', 'Einspeisebefehl verworfen: Mindestpreis Einspeisung unterschritten (' . round((float)$priceLock['priceCt'], 2) . ' < ' . round((float)$priceLock['thresholdCt'], 2) . ' ct/kWh)');
                $enable = false;
                $powerW = 0.0;
            }
        }
        $this->DebugLog('Batterie', ($enable ? 'Einspeisung AN' : 'Einspeisung AUS') . ' | Soll=' . round($powerW) . ' W' . ($slotEnd > 0 ? ' | bis ' . date('H:i:s', $slotEnd) : ''));
        // Older configurations may still use the default generic mode despite
        // having configured only AlphaESS. Never silently discard the command.
        $genericID = $this->ReadPropertyInteger('DischargePowerVariable');
        $alphaIDs = $this->GetAlphaDispatchIDs();
        $alphaConfigured = true;
        foreach ($alphaIDs as $id) {
            if ($id <= 0 || !@IPS_VariableExists($id)) $alphaConfigured = false;
        }
        $useAlpha = $this->ReadPropertyInteger('BatteryControlMode') === 1
            || (($genericID <= 0 || !@IPS_VariableExists($genericID)) && $alphaConfigured);
        if ($useAlpha) {
            $this->DebugLog('Batterie', 'Steuerweg=AlphaESS Dispatch');
            $this->SetAlphaESSDispatch($enable, $powerW, $slotEnd);
        } else {
            $powerID = $this->ReadPropertyInteger('DischargePowerVariable');
            if ($powerID > 0 && @IPS_VariableExists($powerID)) {
                $setpoint = $this->ReadPropertyBoolean('InvertPowerSetpoint') ? -abs($powerW) : abs($powerW);
                if (!$enable) $setpoint = 0;
                $this->WriteVariableSmart($powerID, $setpoint);
            } elseif ($enable) {
                throw new Exception('Keine gültige Batteriesteuerung konfiguriert.');
            }
        }
        SetValue($this->GetIDForIdent('FeedInActive'), $enable);
        SetValue($this->GetIDForIdent('PlannedPower'), $enable ? abs($powerW) : 0.0);
    }

    private function GetAlphaDispatchIDs(): array
    {
        return [
            'start' => $this->ReadPropertyInteger('AlphaDispatchStartVariable'),
            'power' => $this->ReadPropertyInteger('AlphaDispatchPowerVariable'),
            'mode'  => $this->ReadPropertyInteger('AlphaDispatchModeVariable'),
            'soc'   => $this->ReadPropertyInteger('AlphaDispatchSOCVariable'),
            'time'  => $this->ReadPropertyInteger('AlphaDispatchTimeVariable')
        ];
    }

    private function StartAlphaESSDiagnosticTest(int $powerW): void
    {
        $this->WriteAttributeInteger('AlphaTestStage', 0);
        $this->WriteAttributeInteger('AlphaTestNextTs', 0);
        $this->WriteAttributeString('AlphaTestTrace', '');

        $ids = $this->GetAlphaDispatchIDs();
        $powerW = max(0, min($powerW, $this->ReadPropertyInteger('MaxDischargePowerW')));
        $socRaw = (int)round(max(0.0, min(100.0, $this->GetRuntimeMinimumSOC())) / 0.4);

        $this->AppendAlphaTestTrace('Start Mode-2-Test ' . $powerW . ' W | Start=1 -> Power -> Mode=2 -> SOC -> Time');

        $steps = [
            ['Start', $ids['start'], 1],
            ['ActivePower', $ids['power'], 32000 + $powerW],
            ['Mode', $ids['mode'], 2],
            ['SOC', $ids['soc'], $socRaw],
            ['Time', $ids['time'], 156]
        ];

        foreach ($steps as $index => $step) {
            [$name, $id, $value] = $step;
            $before = @GetValue($id);
            $this->WriteAlphaDispatchValue($name, $id, $value);
            usleep(250000);
            $after = @GetValue($id);
            $this->AppendAlphaTestTrace(
                ($index + 1) . '/5 ' . $name
                . ': vorher=' . $before
                . ' | Soll=' . $value
                . ' | danach=' . $after
            );

            if ($index < count($steps) - 1) {
                sleep(3);
            }
        }

        $this->AppendAlphaTestTrace(
            'Sequenz fertig: Power=' . @GetValue($ids['power'])
            . ' | Mode=' . @GetValue($ids['mode'])
            . ' | SOC=' . @GetValue($ids['soc'])
            . ' | Time=' . @GetValue($ids['time'])
            . ' | Start=' . @GetValue($ids['start'])
        );
    }

    private function RunAlphaESSDiagnosticTest(): void
    {
        // Die komplette Testsequenz wird bereits beim Einschalten synchron
        // ausgeführt. Control darf während des Tests keine Dispatchwerte nachschreiben.
    }

    private function AppendAlphaTestTrace(string $line): void
    {
        $trace = $this->ReadAttributeString('AlphaTestTrace');
        $trace .= ($trace !== '' ? "\n" : '') . date('H:i:s') . ' ' . $line;
        $lines = explode("\n", $trace);
        if (count($lines) > 12) $lines = array_slice($lines, -12);
        $trace = implode("\n", $lines);
        $this->WriteAttributeString('AlphaTestTrace', $trace);
        SetValue($this->GetIDForIdent('TestDischargeStatus'), $trace);
        $this->DebugLog('AlphaESS Test', $line);
    }

    private function SetAlphaESSDispatch(bool $enable, float $powerW, int $slotEnd): void
    {
        $ids = $this->GetAlphaDispatchIDs();
        foreach ($ids as $name => $id) {
            if ($id <= 0 || !@IPS_VariableExists($id)) {
                throw new Exception('AlphaESS Dispatch: Variable ' . $name . ' ungültig (ID ' . $id . ').');
            }
        }

        if (!$enable) {
            $this->WriteAlphaDispatchValue('Start', $ids['start'], 0);
            $this->WriteAttributeBoolean('AlphaDispatchActive', false);
            $this->WriteAttributeString('AlphaDispatchCommandKey', '');
            return;
        }

        $powerW = max(0.0, min((float)$this->ReadPropertyInteger('MaxDischargePowerW'), abs($powerW)));
        if ($powerW < 1.0) {
            throw new Exception('AlphaESS Dispatch: Entladeleistung ist 0 W.');
        }

        $activePowerRaw = (int)round(32000 + $powerW);
        $dispatchMode = 2;
        $socTargetRaw = (int)round(max(0.0, min(100.0, $this->GetRuntimeMinimumSOC())) / 0.4);
        $baseDuration = $slotEnd > time() ? ($slotEnd - time()) : 120;
        // Dispatch Time wird im bestehenden AlphaESS-Register in Sekunden verwendet.
        // 30 % Reserve verhindert, dass der Inverter vor dem berechneten Fensterende zurücksetzt.
        $duration = (int)ceil(max(60, $baseDuration) * 1.30);
        $duration = max(60, min(86400, $duration));

        $this->DebugLog(
            'AlphaESS Dispatch',
            'VOLLE SEQUENZ | Power=' . $activePowerRaw
            . ' | Mode=2 | SOC=' . $socTargetRaw
            . ' | Time=' . $duration . ' s (+30%) | Start=1'
        );

        // Vom Nutzer bestätigte Reihenfolge:
        // Start -> ActivePower -> Mode=2 -> SOC -> Dispatch Time.
        $this->WriteAlphaDispatchValue('Start', $ids['start'], 1);
        IPS_Sleep(3000);
        $this->WriteAlphaDispatchValue('ActivePower', $ids['power'], $activePowerRaw);
        IPS_Sleep(3000);
        $this->WriteAlphaDispatchValue('Mode', $ids['mode'], $dispatchMode);
        IPS_Sleep(3000);
        $this->WriteAlphaDispatchValue('SOC', $ids['soc'], $socTargetRaw);
        IPS_Sleep(3000);
        $this->WriteAlphaDispatchValue('Time', $ids['time'], $duration);

        $this->WriteAttributeBoolean('AlphaDispatchActive', true);
        $this->WriteAttributeString(
            'AlphaDispatchCommandKey',
            $activePowerRaw . ':' . $dispatchMode . ':' . $socTargetRaw . ':' . $duration
        );
    }

    private function WriteAlphaDispatchValue(string $name, int $variableID, $value): void
    {
        if ($variableID <= 0 || !@IPS_VariableExists($variableID)) {
            throw new Exception('AlphaESS ' . $name . ': ungültige Variable ID ' . $variableID);
        }

        // Modbusvariablen sind für direkte Wertänderungen read-only.
        // Der Geräte-Schreibbefehl läuft ausschließlich über deren Aktion.
        try {
            RequestAction($variableID, $value);
        } catch (Throwable $e) {
            $this->DebugLog(
                'AlphaESS Dispatch',
                $name . ' ID=' . $variableID . ' Soll=' . $value
                . ' | RequestAction FEHLER: ' . $e->getMessage()
            );
            throw new Exception('AlphaESS ' . $name . ' konnte nicht geschrieben werden: ' . $e->getMessage());
        }

        $this->DebugLog(
            'AlphaESS Dispatch',
            $name . ' ID=' . $variableID . ' | Schreibbefehl=' . $value . ' | RequestAction OK'
        );
    }

    private function WriteVariableSmart(int $variableID, $value)
    {
        if ($variableID <= 0 || !@IPS_VariableExists($variableID)) {
            throw new Exception('Schreibvariable ungültig: ID ' . $variableID);
        }

        try {
            RequestAction($variableID, $value);
            $this->DebugLog('WriteVariable', 'RequestAction ID=' . $variableID . ' Wert=' . $value . ' erfolgreich');
        } catch (Throwable $e) {
            $this->DebugLog('WriteVariable', 'RequestAction ID=' . $variableID . ' Wert=' . $value . ' FEHLER: ' . $e->getMessage());
            throw new Exception('Schreiben auf Variable ' . $variableID . ' fehlgeschlagen: ' . $e->getMessage());
        }
    }

    private function FindCurrentPrice(array $prices): float
    {
        $now = time();
        foreach ($prices as $p) if ($now >= $p['start'] && $now < $p['end']) return (float)$p['priceCt'];
        return 0.0;
    }

    private function EnsureArchiveStorageAndMigration(): void
    {
        $archiveID = $this->FindArchive();
        if ($archiveID <= 0) {
            $text = 'Archive Control nicht gefunden – bisheriger JSON-Datenspeicher bleibt aktiv.';
            $this->WriteAttributeString('ArchiveStorageStatus', $text);
            $id = @$this->GetIDForIdent('ArchiveStorageStatus'); if ($id > 0) SetValue($id, $text);
            return;
        }

        $surfaces = json_decode($this->ReadPropertyString('PVSurfaces'), true);
        if (!is_array($surfaces)) $surfaces = [];
        foreach ($surfaces as $idx => $surface) {
            $name = trim((string)($surface['Name'] ?? 'PV'));
            if ($name === '') $name = 'PV ' . ($idx + 1);
            // Prognose wird als Stundenenergie (kWh) archiviert. Die Ist-Seite kommt
            // direkt aus den in der PV-Fläche zugewiesenen PV-String-Variablen.
            $this->MaintainVariable('PVCalExpected_' . $idx, 'PV Kalibrierung Prognose ' . $name, VARIABLETYPE_FLOAT, '~Electricity', 300 + $idx * 2, true);
            $forecastVarID = (int)@$this->GetIDForIdent('PVCalExpected_' . $idx);
            if ($forecastVarID > 0) {
                @IPS_SetHidden($forecastVarID, true);
                try {
                    if (!AC_GetLoggingStatus($archiveID, $forecastVarID)) AC_SetLoggingStatus($archiveID, $forecastVarID, true);
                    if (AC_GetAggregationType($archiveID, $forecastVarID) !== 0) AC_SetAggregationType($archiveID, $forecastVarID, 0);
                    if (function_exists('AC_SetGraphStatus')) @AC_SetGraphStatus($archiveID, $forecastVarID, false);
                } catch (Throwable $e) { $this->DebugLog('ArchiveStorage', $e->getMessage(), 0); }
            }
            foreach (['PVVariable1','PVVariable2','PVVariable3'] as $field) {
                $pvVarID = (int)($surface[$field] ?? 0);
                if ($pvVarID <= 0 || !@IPS_VariableExists($pvVarID)) continue;
                try {
                    if (!AC_GetLoggingStatus($archiveID, $pvVarID)) AC_SetLoggingStatus($archiveID, $pvVarID, true);
                    if (AC_GetAggregationType($archiveID, $pvVarID) !== 0) AC_SetAggregationType($archiveID, $pvVarID, 0);
                } catch (Throwable $e) { $this->DebugLog('ArchiveStorage', 'PV-String ' . $pvVarID . ': ' . $e->getMessage(), 0); }
            }
            // Alte doppelte Ist-Kalibriervariable nicht mehr verwenden.
            $oldActualID = (int)@$this->GetIDForIdent('PVCalActual_' . $idx);
            if ($oldActualID > 0) @IPS_SetHidden($oldActualID, true);
        }

        $feedVars = [
            'FeedInArchiveKWh' => ['Einspeiseautomatik Energie je Fenster', '~Electricity', 360],
            'FeedInArchiveEUR' => ['Einspeiseautomatik Erlös je Fenster', '', 361],
            'FeedInArchiveTargetKWh' => ['Einspeiseautomatik Planmenge je Fenster', '~Electricity', 362],
            'FeedInArchiveWindow' => ['Einspeiseautomatik Fenster', '', 363]
        ];
        foreach ($feedVars as $ident => $cfg) {
            $this->MaintainVariable($ident, $cfg[0], VARIABLETYPE_FLOAT, $cfg[1], $cfg[2], true);
            $varID = @$this->GetIDForIdent($ident);
            if ($varID <= 0) continue;
            @IPS_SetHidden($varID, true);
            try {
                if (!AC_GetLoggingStatus($archiveID, $varID)) AC_SetLoggingStatus($archiveID, $varID, true);
                if (AC_GetAggregationType($archiveID, $varID) !== 0) AC_SetAggregationType($archiveID, $varID, 0);
                if (function_exists('AC_SetGraphStatus')) @AC_SetGraphStatus($archiveID, $varID, false);
            } catch (Throwable $e) { $this->DebugLog('ArchiveStorage', $e->getMessage(), 0); }
        }

        $migrationVersion = $this->ReadAttributeInteger('ArchiveStorageMigrationVersion');
        // v1.9.84: fehlerhafte Prognosearchive aus 1.9.83 (W/1000 statt echte
        // Stunden-kWh, unregelmäßige Zeitpunkte) einmalig vollständig verwerfen.
        if ($migrationVersion < 3) {
            foreach ($surfaces as $idxClean => $_surfaceClean) {
                $idClean = (int)@$this->GetIDForIdent('PVCalExpected_' . $idxClean);
                if ($idClean > 0) @AC_DeleteVariableData($archiveID, $idClean, 0, time() + 10 * 365 * 86400);
            }
            $this->WriteAttributeString('PVCalibrationJSON', '{}');
            $this->WriteAttributeInteger('ArchiveStorageMigrationVersion', 3);
            $migrationVersion = 3;
            $this->DebugLog('ArchiveStorage', 'v1.9.84: fehlerhafte Prognose-Kalibrierdaten verworfen; Neuaufbau aus echten Stunden-kWh.');
        }
        if ($migrationVersion < 1) {
            try {
                // Ab 1.9.80 wird Open-Meteo korrekt dem vorhergehenden Stundenintervall
                // zugeordnet. Die Erstübernahme schreibt die Prognose-Zeitreihe daher bereits
                // mit korrigierter Stundenlage ins Archiv.
                $pvCount = $this->MigratePVCalibrationJSONToArchive($archiveID, $surfaces);
                $feedCount = $this->MigrateFeedInStatisticsJSONToArchive($archiveID);
                $this->MigrateOpenMeteoSourceHistoryToIntervalStart();
                $this->WriteAttributeInteger('ArchiveStorageMigrationVersion', 2);
                $text = 'Archiv aktiv – vorhandene Daten übernommen: PV ' . $pvCount . ' Intervalle, Einspeisung ' . $feedCount . ' Fenster; Open-Meteo Stundenlage korrigiert.';
                $this->WriteAttributeString('ArchiveStorageStatus', $text);
                $id = @$this->GetIDForIdent('ArchiveStorageStatus'); if ($id > 0) SetValue($id, $text);
            } catch (Throwable $e) {
                $text = 'Archiv-Migration fehlgeschlagen – JSON bleibt als Sicherheitskopie: ' . $e->getMessage();
                $this->WriteAttributeString('ArchiveStorageStatus', $text);
                $id = @$this->GetIDForIdent('ArchiveStorageStatus'); if ($id > 0) SetValue($id, $text);
                $this->DebugLog('ArchiveMigration', $text, 0);
            }
        } elseif ($migrationVersion < 2) {
            try {
                // Einmalige Korrektur für Installationen, die 1.9.79 bereits genutzt haben:
                // JSON ist weiterhin die Sicherheitskopie der gelernten Energieintervalle.
                // Daraus werden die PV-Archivvariablen neu aufgebaut; nur die Open-Meteo-
                // Prognose wird um eine Stunde auf den tatsächlichen Intervallbeginn gelegt,
                // die gemessene Ist-Zeitreihe bleibt zeitlich unverändert.
                $pvCount = $this->MigratePVCalibrationJSONToArchive($archiveID, $surfaces);
                $this->MigrateOpenMeteoSourceHistoryToIntervalStart();
                $this->WriteAttributeInteger('ArchiveStorageMigrationVersion', 2);
                $text = 'Archiv aktiv – Open-Meteo Stundenlage korrigiert; ' . $pvCount . ' PV-Kalibrierintervalle übernommen.';
                $this->WriteAttributeString('ArchiveStorageStatus', $text);
                $id = @$this->GetIDForIdent('ArchiveStorageStatus'); if ($id > 0) SetValue($id, $text);
            } catch (Throwable $e) {
                $text = 'Open-Meteo Archivkorrektur fehlgeschlagen – vorhandene Daten bleiben erhalten: ' . $e->getMessage();
                $this->WriteAttributeString('ArchiveStorageStatus', $text);
                $id = @$this->GetIDForIdent('ArchiveStorageStatus'); if ($id > 0) SetValue($id, $text);
                $this->DebugLog('ArchiveMigration', $text, 0);
            }
        } else {
            $text = 'Archiv aktiv – Prognose-kWh und Einspeise-Statistik im Archiv; PV-Istwerte werden direkt aus den zugeordneten PV-String-Archiven gelesen.';
            $this->WriteAttributeString('ArchiveStorageStatus', $text);
            $id = @$this->GetIDForIdent('ArchiveStorageStatus'); if ($id > 0) SetValue($id, $text);
        }
    }

    private function GetPVArchiveVariableIDs(string $key): array
    {
        $surfaces = json_decode($this->ReadPropertyString('PVSurfaces'), true);
        if (!is_array($surfaces)) return [0, 0];
        foreach ($surfaces as $idx => $surface) {
            $name = trim((string)($surface['Name'] ?? 'PV'));
            if ($name === '') $name = 'PV ' . ($idx + 1);
            if ($this->SurfaceKey($name, $idx) !== $key) continue;
            return [(int)@$this->GetIDForIdent('PVCalExpected_' . $idx), 0];
        }
        return [0, 0];
    }

    private function AddArchiveLoggedValues(int $archiveID, int $variableID, array $values): void
    {
        if ($archiveID <= 0 || $variableID <= 0 || count($values) === 0 || !function_exists('AC_AddLoggedValues')) return;
        ksort($values);
        $rows = [];
        foreach ($values as $ts => $value) $rows[] = ['TimeStamp'=>(int)$ts, 'Value'=>(float)$value];
        foreach (array_chunk($rows, 2000) as $chunk) AC_AddLoggedValues($archiveID, $variableID, $chunk);
        if (function_exists('AC_ReAggregateVariable')) @AC_ReAggregateVariable($archiveID, $variableID);
    }

    private function MigratePVCalibrationJSONToArchive(int $archiveID, array $surfaces): int
    {
        $legacy = json_decode($this->ReadAttributeString('PVCalibrationJSON'), true);
        if (!is_array($legacy)) return 0;
        $migrated = 0;
        foreach ($surfaces as $idx => $surface) {
            $name = trim((string)($surface['Name'] ?? 'PV'));
            if ($name === '') $name = 'PV ' . ($idx + 1);
            $key = $this->SurfaceKey($name, $idx);
            if (!isset($legacy[$key]) || !is_array($legacy[$key])) continue;
            $expectedID = (int)@$this->GetIDForIdent('PVCalExpected_' . $idx);
            $actualID = (int)@$this->GetIDForIdent('PVCalActual_' . $idx);
            if ($expectedID <= 0 || $actualID <= 0) continue;
            // Migration idempotent halten: bei einem abgebrochenen ersten Versuch
            // vorhandene Zielwerte dieser neuen Archivvariablen vor dem Neuimport entfernen.
            @AC_DeleteVariableData($archiveID, $expectedID, 0, time());
            @AC_DeleteVariableData($archiveID, $actualID, 0, time());
            @AC_SetLoggingStatus($archiveID, $expectedID, true);
            @AC_SetLoggingStatus($archiveID, $actualID, true);
            $evE = []; $evA = [];
            $samples = isset($legacy[$key]['energySamples']) && is_array($legacy[$key]['energySamples']) ? $legacy[$key]['energySamples'] : [];
            usort($samples, function($a,$b){ return ((int)($a['ts']??0)) <=> ((int)($b['ts']??0)); });
            foreach ($samples as $sample) {
                $start = (int)($sample['ts'] ?? 0); $end = (int)($sample['endTs'] ?? 0);
                $exp = (float)($sample['expectedKWh'] ?? 0); $act = (float)($sample['actualKWh'] ?? 0);
                $dt = $end - $start;
                if ($start <= 0 || $dt <= 0 || $exp <= 0 || $act < 0) continue;
                $expectedStart = $start - 3600;
                $expectedEnd = $end - 3600;
                if ($expectedStart > 0) {
                    $evE[$expectedEnd] = 0.0;
                    $evE[$expectedStart] = $exp * 1000.0 * 3600.0 / $dt;
                }
                // Istwerte bleiben an ihrem real gemessenen Zeitpunkt.
                $evA[$end] = 0.0;
                $evA[$start] = $act * 1000.0 * 3600.0 / $dt;
                $migrated++;
            }
            // Ältere, bereits saisonal verdichtete Daten besitzen keine exakten Tagesenergien mehr.
            // Die Gesamtenergie wird deshalb gleichmäßig auf die gespeicherten Lerntage verteilt.
            // Dadurch bleiben Saison-/Stundenfaktor und Anzahl der Lerntage exakt erhalten.
            $seasonal = isset($legacy[$key]['seasonalArchive']) && is_array($legacy[$key]['seasonalArchive']) ? $legacy[$key]['seasonalArchive'] : [];
            foreach ($seasonal as $season => $hours) {
                if (!is_array($hours)) continue;
                foreach ($hours as $hour => $entry) {
                    if (!is_array($entry)) continue;
                    $days = isset($entry['days']) && is_array($entry['days']) ? array_keys($entry['days']) : [];
                    $n = count($days); $exp = (float)($entry['expectedKWh'] ?? 0); $act = (float)($entry['actualKWh'] ?? 0);
                    if ($n <= 0 || $exp <= 0 || $act < 0) continue;
                    $expPerDay = $exp / $n; $actPerDay = $act / $n;
                    foreach ($days as $day) {
                        $start = strtotime((string)$day . ' ' . sprintf('%02d:00:00', (int)$hour));
                        if ($start === false || $start <= 0) continue;
                        $end = $start + 3600;
                        $expectedStart = $start - 3600;
                        $expectedEnd = $end - 3600;
                        if ($expectedStart > 0 && !isset($evE[$expectedStart])) { $evE[$expectedStart] = $expPerDay * 1000.0; $migrated++; }
                        if ($expectedEnd > 0 && !isset($evE[$expectedEnd])) $evE[$expectedEnd] = 0.0;
                        if (!isset($evA[$start])) $evA[$start] = $actPerDay * 1000.0;
                        if (!isset($evA[$end])) $evA[$end] = 0.0;
                    }
                }
            }
            $this->AddArchiveLoggedValues($archiveID, $expectedID, $evE);
            $this->AddArchiveLoggedValues($archiveID, $actualID, $evA);
        }
        return $migrated;
    }

    private function MigrateOpenMeteoSourceHistoryToIntervalStart(): void
    {
        $history = json_decode($this->ReadAttributeString('PVSourceForecastHistoryJSON'), true);
        if (!is_array($history) || !isset($history['openmeteo']) || !is_array($history['openmeteo'])) return;

        $shifted = [];
        foreach ($history['openmeteo'] as $date => $hours) {
            if (!is_array($hours)) continue;
            foreach ($hours as $hour => $value) {
                if ($value === null) continue;
                $ts = strtotime((string)$date . ' ' . sprintf('%02d:00:00', (int)$hour));
                if ($ts === false) continue;
                $targetTs = $ts - 3600;
                $targetDate = date('Y-m-d', $targetTs);
                $targetHour = (int)date('G', $targetTs);
                if (!isset($shifted[$targetDate])) $shifted[$targetDate] = array_fill(0, 24, null);
                $shifted[$targetDate][$targetHour] = $value;
            }
        }
        ksort($shifted);
        $history['openmeteo'] = $shifted;
        $this->WriteAttributeString('PVSourceForecastHistoryJSON', json_encode($history));
        // Nach Änderung der Zeitbasis alte automatisch gelernte Provider-Gewichte nicht
        // weiterverwenden; ab jetzt werden sie auf der korrigierten Stundenlage neu gelernt.
        $this->WriteAttributeInteger('PVSourceWeightLearningResetTs', time());
        $this->WriteAttributeString('PVSourceWeightsJSON', '{}');
        $this->DebugLog('Open-Meteo', 'Gespeicherte Quellenhistorie um 1 Stunde auf den Intervallbeginn verschoben; Provider-Gewichte lernen neu.');
    }

    private function MigrateFeedInStatisticsJSONToArchive(int $archiveID): int
    {
        $stats = json_decode($this->ReadAttributeString('FeedInStatisticsJSON'), true);
        if (!is_array($stats)) return 0;
        $ids = [
            'kwh'=>(int)@$this->GetIDForIdent('FeedInArchiveKWh'),
            'eur'=>(int)@$this->GetIDForIdent('FeedInArchiveEUR'),
            'target'=>(int)@$this->GetIDForIdent('FeedInArchiveTargetKWh'),
            'window'=>(int)@$this->GetIDForIdent('FeedInArchiveWindow')
        ];
        // Auch die Einspeise-Migration ist wiederholbar, falls der erste Import abbricht.
        foreach ($ids as $id) { if ($id > 0) { @AC_DeleteVariableData($archiveID, $id, 0, time()); @AC_SetLoggingStatus($archiveID, $id, true); } }
        $rows = ['kwh'=>[],'eur'=>[],'target'=>[],'window'=>[]]; $count = 0;
        foreach ($stats as $r) {
            if (!is_array($r) || (($r['reason'] ?? 'price') !== 'price')) continue;
            $ts = (int)($r['end'] ?? $r['start'] ?? 0); if ($ts <= 0) continue;
            // Bei identischen Sekunden nicht überschreiben, sondern minimal versetzen.
            while (isset($rows['window'][$ts])) $ts++;
            $rows['kwh'][$ts] = max(0.0, (float)($r['deliveredKWh'] ?? 0));
            $rows['eur'][$ts] = (float)($r['revenueEUR'] ?? 0);
            $rows['target'][$ts] = max(0.0, (float)($r['targetKWh'] ?? 0));
            $rows['window'][$ts] = 1.0; $count++;
        }
        foreach ($ids as $k => $id) $this->AddArchiveLoggedValues($archiveID, $id, $rows[$k]);
        return $count;
    }

    private function StorePVCalibrationHourlyForecast(array $surfaceForecastHours, array $surfaces): void
    {
        if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') < 1) return;
        $archiveID = $this->FindArchive(); if ($archiveID <= 0) return;
        $currentHour = strtotime(date('Y-m-d H:00:00'));
        $maxTs = $currentHour;
        foreach ($surfaceForecastHours as $m) if (is_array($m)) foreach ($m as $ts => $_) $maxTs = max($maxTs, (int)$ts);
        foreach ($surfaces as $idx => $surface) {
            if (empty($surface['Active'])) continue;
            $name = trim((string)($surface['Name'] ?? 'PV')); if ($name === '') $name = 'PV ' . ($idx + 1);
            $id = (int)@$this->GetIDForIdent('PVCalExpected_' . $idx); if ($id <= 0) continue;
            $map = is_array($surfaceForecastHours[$name] ?? null) ? $surfaceForecastHours[$name] : [];
            try {
                // Laufende Stunde: den zuerst vorhandenen Wert einfrieren. Nur zukünftige
                // Stunden werden bei einem neuen Forecast ersetzt. Vergangenheit bleibt unverändert.
                $existingCurrent = @AC_GetLoggedValues($archiveID, $id, $currentHour, $currentHour, 1);
                $rows = [];
                foreach ($map as $ts => $kWh) {
                    $ts = (int)$ts; $kWh = max(0.0, (float)$kWh);
                    if ($ts < $currentHour) continue;
                    if ($ts === $currentHour && is_array($existingCurrent) && count($existingCurrent) > 0) continue;
                    $rows[$ts] = $kWh;
                }
                // Ab der nächsten vollen Stunde ist die jüngste Prognose maßgeblich.
                $futureStart = $currentHour + 3600;
                if ($maxTs >= $futureStart) @AC_DeleteVariableData($archiveID, $id, $futureStart, $maxTs + 3599);
                $this->AddArchiveLoggedValues($archiveID, $id, $rows);
                $this->DebugLog('PV-Kalibrierarchiv', $name . ' | ' . count($rows) . ' Stunden-kWh gespeichert | ab ' . date('d.m.Y H:i', $currentHour));
            } catch (Throwable $ex) { $this->DebugLog('PV-Kalibrierarchiv', $name . ': ' . $ex->getMessage(), 0); }
        }
    }

    private function GetArchiveFirstTime(int $archiveID, int $variableID): int
    {
        try {
            $vars = AC_GetAggregationVariables($archiveID, true);
            foreach ($vars as $v) if ((int)($v['VariableID'] ?? 0) === $variableID) return (int)($v['FirstTime'] ?? 0);
        } catch (Throwable $e) {}
        return 0;
    }

    private function GetArchiveHourlyMap(int $archiveID, int $variableID, int $startTs, int $endTs): array
    {
        $out = [];
        if ($archiveID <= 0 || $variableID <= 0 || $endTs <= $startTs) return $out;
        $cursor = $startTs;
        while ($cursor <= $endTs) {
            $chunkEnd = min($endTs, strtotime('+300 days', $cursor));
            $rows = @AC_GetAggregatedValues($archiveID, $variableID, 0, $cursor, $chunkEnd, 0);
            if (is_array($rows)) foreach ($rows as $r) {
                $ts = (int)($r['TimeStamp'] ?? 0); if ($ts <= 0) continue;
                $out[$ts] = ['avg'=>(float)($r['Avg'] ?? 0.0),'duration'=>max(0,(int)($r['Duration'] ?? 3600))];
            }
            if ($chunkEnd >= $endTs) break;
            $cursor = $chunkEnd + 1;
        }
        ksort($out); return $out;
    }

    private function BuildPVCalibrationFromArchive(array $legacyCalibration = []): array
    {
        if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') < 1) return $legacyCalibration;
        $archiveID = $this->FindArchive(); if ($archiveID <= 0) return $legacyCalibration;
        $surfaces = json_decode($this->ReadPropertyString('PVSurfaces'), true); if (!is_array($surfaces)) return $legacyCalibration;
        $result = []; $days = max(1, $this->ReadPropertyInteger('PVCalibrationDays'));
        $startWindow = strtotime(date('Y-m-d 00:00:00', time() - ($days + 2) * 86400));
        $excluded = json_decode($this->ReadAttributeString('PVCalibrationExcludedPeriodsJSON'), true); if (!is_array($excluded)) $excluded=[];
        foreach ($surfaces as $idx => $surface) {
            $name=trim((string)($surface['Name']??'PV')); if($name==='')$name='PV '.($idx+1); $key=$this->SurfaceKey($name,$idx);
            $expectedID=(int)@$this->GetIDForIdent('PVCalExpected_'.$idx); if($expectedID<=0) continue;
            $eRows=@AC_GetLoggedValues($archiveID,$expectedID,$startWindow,time(),0); if(!is_array($eRows))$eRows=[];
            $forecastByHour=[];
            foreach($eRows as $r){ $ts=(int)($r['TimeStamp']??0); $v=(float)($r['Value']??0); if($ts<=0||$v<=0)continue; $h=strtotime(date('Y-m-d H:00:00',$ts)); if(!isset($forecastByHour[$h]))$forecastByHour[$h]=$v; }
            $pvIDs=[]; foreach(['PVVariable1','PVVariable2','PVVariable3'] as $f){$id=(int)($surface[$f]??0); if($id>0&&@IPS_VariableExists($id))$pvIDs[]=$id;}
            $entry=['factor'=>1.0,'energySamples'=>[],'seasonalArchive'=>[],'storageMode'=>'forecast-kwh + pv-string-archive'];
            foreach($forecastByHour as $h=>$expKWh){
                if($h+3600>time()) continue; $blocked=false;
                foreach($excluded as $p){ if(!is_array($p))continue; $a=(int)($p['fromTs']??0);$b=(int)($p['toTs']??0); if($a<$h+3600&&$b>$h){$blocked=true;break;} }
                if($blocked)continue;
                $actKWh=0.0; $have=false;
                foreach($pvIDs as $id){
                    $agg=@AC_GetAggregatedValues($archiveID,$id,0,$h,$h+3599,0); if(!is_array($agg)||count($agg)===0)continue;
                    foreach($agg as $r){$dur=max(0,(int)($r['Duration']??3600));$actKWh+=max(0.0,(float)($r['Avg']??0))*$dur/3600.0/1000.0;$have=true;}
                }
                if(!$have)continue;
                $entry['energySamples'][]=['ts'=>$h,'endTs'=>$h+3600,'expectedKWh'=>(float)$expKWh,'actualKWh'=>$actKWh,'hour'=>(int)date('G',$h),'intervals'=>1];
            }
            $tmp=$this->RecalculatePVCalibrationFactors([$key=>$entry],$key); $result[$key]=$tmp[$key]??$entry;
        }
        return $result;
    }

    private function StoreFeedInStatisticArchive(float $delivered, float $revenue, float $target, int $ts): void
    {
        $archiveID = $this->FindArchive(); if ($archiveID <= 0 || $this->ReadAttributeInteger('ArchiveStorageMigrationVersion') < 1) return;
        $map = ['FeedInArchiveKWh'=>$delivered,'FeedInArchiveEUR'=>$revenue,'FeedInArchiveTargetKWh'=>$target,'FeedInArchiveWindow'=>1.0];
        foreach ($map as $ident=>$value) {
            $id=(int)@$this->GetIDForIdent($ident); if($id<=0) continue;
            try { AC_AddLoggedValues($archiveID,$id,[['TimeStamp'=>$ts,'Value'=>(float)$value]]); } catch(Throwable $e){ $this->DebugLog('FeedInArchive',$e->getMessage(),0); }
        }
    }

    private function ReadFeedInStatisticsFromArchive(): array
    {
        if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') < 1) return [];
        $archiveID=$this->FindArchive(); if($archiveID<=0) return [];
        $ids=['kwh'=>(int)@$this->GetIDForIdent('FeedInArchiveKWh'),'eur'=>(int)@$this->GetIDForIdent('FeedInArchiveEUR'),'target'=>(int)@$this->GetIDForIdent('FeedInArchiveTargetKWh'),'window'=>(int)@$this->GetIDForIdent('FeedInArchiveWindow')];
        if(min($ids)<=0) return [];
        $maps=[];
        foreach($ids as $k=>$id){ $rows=@AC_GetLoggedValues($archiveID,$id,0,time(),0); $maps[$k]=[]; if(is_array($rows)) foreach($rows as $r)$maps[$k][(int)$r['TimeStamp']]=(float)$r['Value']; }
        $out=[]; foreach($maps['window'] as $ts=>$one){ $kwh=(float)($maps['kwh'][$ts]??0); $eur=(float)($maps['eur'][$ts]??0); $out[]=['start'=>$ts,'end'=>$ts,'targetKWh'=>(float)($maps['target'][$ts]??0),'deliveredKWh'=>$kwh,'priceCt'=>$kwh>0?$eur/$kwh*100.0:0.0,'revenueEUR'=>$eur,'completed'=>true,'reason'=>'price','finishReason'=>'Archiv']; }
        usort($out,function($a,$b){return ((int)$a['start'])<=>((int)$b['start']);}); return $out;
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

    private function AddProviderDebug(string $provider, string $request, array $meta, $response, int $status = 200, float $durationMs = 0.0): void
    {
        if (!$this->ReadPropertyBoolean('DebugMode')) return;
        $entries = json_decode($this->ReadAttributeString('ProviderDebugLogJSON'), true);
        if (!is_array($entries)) $entries = [];
        // Zugangsdaten niemals in der HTMLBox anzeigen.
        $safeRequest = preg_replace('~(Authorization:\s*Bearer\s+)[^\s]+~i', '$1***', $request);
        $entries[] = [
            'time' => time(), 'provider' => $provider, 'request' => $safeRequest,
            'meta' => $meta, 'status' => $status, 'durationMs' => round($durationMs, 1),
            'response' => $response
        ];
        if (count($entries) > 40) $entries = array_slice($entries, -40);
        $this->WriteAttributeString('ProviderDebugLogJSON', json_encode($entries));
        SetValue($this->GetIDForIdent('ProviderDebugHTML'), $this->RenderProviderDebugHTML($entries));
    }

    private function RenderProviderForecastStatusHTML(array $forecast): string
    {
        $sources = is_array($forecast['forecastSources'] ?? null) ? $forecast['forecastSources'] : [];
        $surfaceData = is_array($forecast['providerSurfaceTomorrow'] ?? null) ? $forecast['providerSurfaceTomorrow'] : [];
        $surfaces = json_decode($this->ReadPropertyString('PVSurfaces'), true);
        if (!is_array($surfaces)) $surfaces = [];
        $surfaceNames = [];
        foreach ($surfaces as $idx => $surface) {
            if (empty($surface['Active'])) continue;
            $name = trim((string)($surface['Name'] ?? 'PV')); if ($name === '') $name = 'PV ' . ($idx + 1);
            $surfaceNames[] = $name;
        }
        $history = json_decode($this->ReadAttributeString('PVSourceForecastHistoryJSON'), true);
        if (!is_array($history)) $history = [];
        $tomorrow = date('Y-m-d', strtotime('tomorrow'));
        $labels = ['openmeteo'=>'Open-Meteo','forecastsolar'=>'Forecast.Solar','pvnode'=>'pvnode'];
        $body = '<table style="width:100%;border-collapse:collapse;font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px"><tr style="border-bottom:1px solid #666"><th style="text-align:left;padding:4px">Anbieter</th>';
        foreach ($surfaceNames as $name) $body .= '<th style="text-align:right;padding:4px">' . htmlspecialchars($name) . ' morgen</th>';
        $body .= '<th style="text-align:right;padding:4px">Gesamt morgen</th><th style="text-align:left;padding:4px">Status</th></tr>';
        foreach ($labels as $source => $label) {
            if (!in_array($source, $sources, true) && empty($history[$source][$tomorrow])) continue;
            $total = 0.0;
            if (isset($history[$source][$tomorrow]) && is_array($history[$source][$tomorrow])) foreach ($history[$source][$tomorrow] as $v) if ($v !== null) $total += max(0.0,(float)$v);
            $body .= '<tr style="border-bottom:1px solid #333"><td style="padding:5px 4px"><b>' . htmlspecialchars($label) . '</b></td>';
            foreach ($surfaceNames as $name) {
                $v = $surfaceData[$source][$name] ?? null;
                $body .= '<td style="text-align:right;padding:5px 4px">' . ($v === null ? '–' : number_format((float)$v,2,',','.') . ' kWh') . '</td>';
            }
            $status = 'Live';
            if ($source === 'pvnode') {
                $cache = json_decode($this->ReadAttributeString('PVNodeForecastCacheJSON'), true);
                $fetched = is_array($cache) ? (int)($cache['fetchedAt'] ?? 0) : 0;
                $hasStrings = is_array($cache['stringHours'] ?? null) && count($cache['stringHours']) > 0;
                $status = ($hasStrings ? 'Flächen getrennt' : 'Standort gesamt') . ' · ' . ($fetched > 0 ? 'Cache ' . date('d.m. H:i', $fetched) : 'Live/kein Cache');
            }
            $body .= '<td style="text-align:right;padding:5px 4px"><b>' . number_format($total,2,',','.') . ' kWh</b></td><td style="padding:5px 4px">' . htmlspecialchars($status) . '</td></tr>';
        }
        $body .= '</table>';
        return $this->RenderPersistentDetailsHTML('sbo_provider_status', 'PV-Prognose Anbieter', $body, 'Prognose für morgen je Anbieter');
    }

    private function RenderProviderDebugHTML(array $entries): string
    {
        if (!$this->ReadPropertyBoolean('DebugMode')) return '';
        $e = static function ($v): string { return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); };
        $html = '<div style="margin-top:3px">';
        // Diagnosezeilen direkt sichtbar darstellen. Provider-Rohantworten bleiben aufklappbar.
        $diagRows = [];
        $providerRows = [];
        foreach ($entries as $row) {
            if (($row['provider'] ?? '') === 'DIAG') {
                $diagRows[] = $row;
            } else {
                $providerRows[] = $row;
            }
        }
        if ($diagRows) {
            $html .= '<div style="margin:8px 0;padding:8px;background:#101010;border:1px solid #555;max-height:420px;overflow:auto">';
            $html .= '<div style="font-weight:bold;margin-bottom:5px">DIAG – Ablaufprotokoll</div>';
            foreach (array_reverse($diagRows) as $row) {
                $step = (string)($row['request'] ?? $row['response'] ?? '');
                $html .= '<div style="font-family:Consolas,monospace;white-space:pre-wrap;padding:2px 0;border-bottom:1px solid #292929">'
                    .$e(date('H:i:s',(int)($row['time'] ?? 0))).' | '.$e($step).'</div>';
            }
            $html .= '</div>';
        }
        foreach (array_reverse($providerRows) as $row) {
            $meta = is_array($row['meta'] ?? null) ? $row['meta'] : [];
            $html .= '<details style="margin-top:8px;border-top:1px solid #555;padding-top:6px"><summary style="cursor:pointer"><b>'.$e($row['provider'] ?? '').'</b> | '.$e(date('d.m.Y H:i:s',(int)($row['time'] ?? 0))).' | HTTP '.$e($row['status'] ?? '').' | '.$e($row['durationMs'] ?? 0).' ms</summary>';
            if ($meta) $html .= '<div style="margin:5px 0"><b>Parameter:</b> '.$e(implode(' | ', array_map(static fn($k,$v)=>$k.'='.$v,array_keys($meta),array_values($meta)))).'</div>';
            $html .= '<div style="margin:5px 0;word-break:break-all"><b>Request:</b> '.$e($row['request'] ?? '').'</div>';
            $raw = is_string($row['response'] ?? null) ? $row['response'] : json_encode($row['response'] ?? null, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            $html .= '<details><summary style="cursor:pointer">Antwort anzeigen</summary><pre style="white-space:pre-wrap;word-break:break-word;background:#101010;padding:6px;max-height:500px;overflow:auto">'.$e($raw).'</pre></details></details>';
        }
        return $this->RenderPersistentDetailsHTML('sbo_provider_debug', 'Prognose Provider Debug', $html . '</div>', 'Neueste Abfrage oben | Rohantworten aufklappbar');
    }

    private function HttpGetJsonWithHeaders(string $url, array $headers = [], string $debugProvider = '', array $debugMeta = []): array
    {
        $allHeaders = array_merge(
            ['User-Agent: IP-Symcon-SmartBatteryOptimizer/1.5.6'],
            $headers
        );

        $opts = [
            'http' => [
                'timeout' => 8,
                'ignore_errors' => true,
                'header' => implode("\r\n", $allHeaders) . "\r\n"
            ]
        ];
        $ctx = stream_context_create($opts);
        $debugStart = microtime(true);
        $raw = @file_get_contents($url, false, $ctx);

        $status = 0;
        if (isset($http_response_header) && is_array($http_response_header)) {
            foreach ($http_response_header as $line) {
                if (preg_match('/^HTTP\/\S+\s+(\d{3})/', $line, $m)) {
                    $status = (int)$m[1];
                }
            }
        }

        if ($debugProvider !== '') $this->AddProviderDebug($debugProvider, $url, $debugMeta, $raw === false ? 'HTTP-Abruf fehlgeschlagen' : $raw, $status, (microtime(true)-$debugStart)*1000.0);
        if ($raw === false) {
            throw new Exception('HTTP-Abruf fehlgeschlagen.', $status);
        }

        $data = json_decode($raw, true);

        if ($status >= 400) {
            $detail = '';
            if (is_array($data)) {
                $detail = (string)($data['detail'] ?? $data['message'] ?? $data['error'] ?? '');
            }
            $text = 'HTTP ' . $status . ($detail !== '' ? ' – ' . $detail : '');
            throw new Exception($text, $status);
        }

        if (!is_array($data)) {
            throw new Exception('Antwort ist kein gültiges JSON.', $status);
        }

        return $data;
    }

    private function HttpGetJson(string $url, string $debugProvider = '', array $debugMeta = []): array
    {
        $opts = ['http' => ['timeout' => 8, 'header' => "User-Agent: IP-Symcon-SmartBatteryOptimizer/1.2.7\r\n"]];
        $ctx = stream_context_create($opts);
        $debugStart = microtime(true);
        $raw = @file_get_contents($url, false, $ctx);
        if ($debugProvider !== '') $this->AddProviderDebug($debugProvider, $url, $debugMeta, $raw === false ? 'HTTP-Abruf fehlgeschlagen' : $raw, $raw === false ? 0 : 200, (microtime(true)-$debugStart)*1000.0);
        if ($raw === false) throw new Exception('HTTP-Abruf fehlgeschlagen.');
        $data = json_decode($raw, true);
        if (!is_array($data)) throw new Exception('Antwort ist kein gültiges JSON.');
        return $data;
    }


    private function RenderPlanHTML(array $forecast, array $prices, array $plan): string
    {
        $html = '<div style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px">';
        $html .= '<details><summary style="cursor:pointer;font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;font-weight:bold;padding:6px 0">Einspeiseplan anzeigen / ausblenden</summary>';

        $displayHours = max(24, min(72, $this->ReadPropertyInteger('PriceDisplayHours')));
        $now = time();
        $displayStart = strtotime(date('Y-m-d H:00:00', $now));
        $displayEnd = $displayStart + $displayHours * 3600;

        $hours = [];
        for ($i = 0; $i < $displayHours; $i++) {
            $hStart = $displayStart + $i * 3600;
            $hours[$hStart] = [
                'start' => $hStart,
                'end' => $hStart + 3600,
                'marketWeighted' => 0.0,
                'tariffWeighted' => 0.0,
                'priceSeconds' => 0,
                'energyKWh' => 0.0,
                'reasonPrice' => false,
                'reasonPVSpace' => false
            ];
        }

        // Preiswerte auf volle Stunden zusammenfassen. Bei 15-Minuten-Daten entsteht
        // daraus der zeitgewichtete Stundenmittelwert.
        foreach ($prices as $p) {
            foreach ($hours as $hStart => &$h) {
                $overlapStart = max((int)$p['start'], $h['start']);
                $overlapEnd = min((int)$p['end'], $h['end']);
                if ($overlapEnd <= $overlapStart) continue;
                $seconds = $overlapEnd - $overlapStart;
                $h['marketWeighted'] += (float)$p['marketCt'] * $seconds;
                $h['tariffWeighted'] += (float)$p['priceCt'] * $seconds;
                $h['priceSeconds'] += $seconds;
            }
            unset($h);
        }

        // Interne 15-Minuten-Einspeiseslots für die Anzeige zu Stundenwerten addieren.
        foreach (($plan['slots'] ?? []) as $slot) {
            $slotStart = (int)$slot['start'];
            $slotEnd = isset($slot['end']) ? (int)$slot['end'] : ($slotStart + 900);
            foreach ($hours as $hStart => &$h) {
                $overlapStart = max($slotStart, $h['start']);
                $overlapEnd = min($slotEnd, $h['end']);
                if ($overlapEnd <= $overlapStart) continue;

                $slotDuration = max(1, $slotEnd - $slotStart);
                $fraction = ($overlapEnd - $overlapStart) / $slotDuration;
                $h['energyKWh'] += (float)($slot['energyKWh'] ?? 0.0) * $fraction;

                if (($slot['reason'] ?? 'price') === 'pv_space') {
                    $h['reasonPVSpace'] = true;
                } else {
                    $h['reasonPrice'] = true;
                }
            }
            unset($h);
        }

        $html .= '<div style="padding-top:6px"><b>Einspeiseplan / Preise – nächste ' . $displayHours . ' Stunden (Stundenwerte)</b><br>';
        $html .= '<span style="font-size:11px">Die Anzeige ist auf volle Stunden zusammengefasst. Die Batteriesteuerung arbeitet intern weiterhin im feineren Raster.</span><br><br>';
        $html .= '<table style="border-collapse:collapse;width:100%"><tr><th style="text-align:left">Zeit</th><th>Markt</th><th>Tarif</th><th>Leistung Ø</th><th>Energie</th><th>Grund</th></tr>';

        foreach ($hours as $h) {
            if ($h['end'] <= $now) continue;

            $hasPrice = $h['priceSeconds'] > 0;
            $marketCt = $hasPrice ? $h['marketWeighted'] / $h['priceSeconds'] : null;
            $tariffCt = $hasPrice ? $h['tariffWeighted'] / $h['priceSeconds'] : null;
            $energy = (float)$h['energyKWh'];
            $hasPlan = $energy > 0.0001;

            // kWh innerhalb einer Stunde entsprechen der über die ganze Stunde
            // gemittelten geplanten Leistung in kW.
            $avgPowerKW = $energy;

            if ($h['reasonPVSpace'] && $h['reasonPrice']) {
                $reason = 'Preis + PV-Speicher';
            } elseif ($h['reasonPVSpace']) {
                $reason = 'PV-Speicher';
            } elseif ($h['reasonPrice']) {
                $reason = 'Preis';
            } else {
                $reason = '-';
            }

            $html .= '<tr style="border-top:1px solid #555"><td>' . date('d.m. H:i', $h['start']) . '–' . date('H:i', $h['end']) . '</td>';
            $html .= '<td style="text-align:right">' . ($marketCt === null ? '-' : number_format($marketCt, 2, ',', '.') . ' ct') . '</td>';
            $html .= '<td style="text-align:right"><b>' . ($tariffCt === null ? '-' : number_format($tariffCt, 2, ',', '.') . ' ct') . '</b></td>';
            $html .= '<td style="text-align:right">' . ($hasPlan ? number_format($avgPowerKW, 2, ',', '.') . ' kW' : '-') . '</td>';
            $html .= '<td style="text-align:right">' . ($hasPlan ? number_format($energy, 2, ',', '.') . ' kWh' : '-') . '</td>';
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
        $total = (float)($forecast['consumptionTomorrowKWh'] ?? 0.0);
        $nightPart = (float)($forecast['nightConsumptionTomorrowKWh'] ?? $night);
        $pvPart = (float)($forecast['consumptionDuringPVTomorrowKWh'] ?? 0.0);
        $otherPart = (float)($forecast['otherDayConsumptionTomorrowKWh'] ?? 0.0);

        // Konkretes Zeitfenster der nächsten Nacht anzeigen.
        $nightStartTs = $this->DetermineNightStart(0, strtotime('today 00:00:00'));
        $nightEndTs = $this->DetermineMorningEnd(0, strtotime('tomorrow 00:00:00'));
        $nightWindowClock = date('H:i', $nightStartTs) . ' – ' . date('H:i', $nightEndTs) . ' Uhr';

        $cellLabel = 'padding:4px 8px 4px 0;color:#b9c0c8;white-space:nowrap;vertical-align:top';
        $cellValue = 'padding:4px 0;color:#fff;font-weight:bold;vertical-align:top';
        $sectionStyle = 'font-size:12px;font-weight:bold;color:#fff;padding:8px 0 3px 0;border-bottom:1px solid rgba(255,255,255,.16)';

        $html = '<div style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;color:#fff;font-size:12px;line-height:1.35">';
        $html .= '<div style="font-size:15px;font-weight:bold;margin-bottom:6px">Börsenpreis-Speicheroptimierung</div>';
        $html .= '<table style="border-collapse:collapse;width:100%;max-width:760px;font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;color:#fff">';

        $html .= '<tr><td colspan="4" style="' . $sectionStyle . '">Batterie</td></tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">SoC</td><td style="' . $cellValue . '">' . number_format((float)$plan['soc'], 1, ',', '.') . ' %</td>';
        $html .= '<td style="' . $cellLabel . '">Speicherinhalt</td><td style="' . $cellValue . '">' . number_format((float)$plan['storedKWh'], 2, ',', '.') . ' kWh</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Reserve bis PV-Morgen</td><td style="' . $cellValue . '">' . number_format((float)$plan['reserveKWh'], 2, ',', '.') . ' kWh</td>';
        $html .= '<td style="' . $cellLabel . '">davon Nacht / Morgenreserve</td><td style="' . $cellValue . '">' . number_format((float)($plan['nightReserveKWh'] ?? 0), 2, ',', '.') . ' / ' . number_format((float)($plan['morningReserveKWh'] ?? 0), 2, ',', '.') . ' kWh</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Bedarf am PV-Morgen</td><td style="' . $cellValue . '">' . number_format((float)($plan['requiredMorningStoredKWh'] ?? 0), 2, ',', '.') . ' kWh</td>';
        $html .= '<td></td><td></td>';
        $html .= '</tr>';

        $html .= '<tr><td colspan="4" style="' . $sectionStyle . '">Verbrauch morgen</td></tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Gesamt</td><td style="' . $cellValue . '">' . number_format($total, 2, ',', '.') . ' kWh</td>';
        $html .= '<td style="' . $cellLabel . '">Nacht</td><td style="' . $cellValue . '">' . number_format($nightPart, 2, ',', '.') . ' kWh</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Während PV-Zeit</td><td style="' . $cellValue . '">' . number_format($pvPart, 2, ',', '.') . ' kWh</td>';
        $html .= '<td style="' . $cellLabel . '">Übriger Tag</td><td style="' . $cellValue . '">' . number_format($otherPart, 2, ',', '.') . ' kWh</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Nachtfenster</td><td colspan="3" style="padding:4px 0;color:#fff"><b>' . htmlspecialchars($nightWindowClock) . '</b></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Lernbasis</td><td colspan="3" style="padding:4px 0;color:#d8dde3">Nachtverbrauch: ' . htmlspecialchars($this->HumanizeLearningSource($this->ReadAttributeString('NightLearningSource'), true)) . ' &nbsp;|&nbsp; Tagesprofil: ' . htmlspecialchars($this->HumanizeLearningSource($this->ReadAttributeString('ConsumptionLearningSource'), false)) . '</td>';
        $html .= '</tr>';

        $html .= '<tr><td colspan="4" style="' . $sectionStyle . '">PV-Prognose</td></tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Heute</td><td style="' . $cellValue . '">' . number_format((float)($forecast['todayKWh'] ?? 0), 2, ',', '.') . ' kWh</td>';
        $html .= '<td style="' . $cellLabel . '">Morgen</td><td style="' . $cellValue . '">' . number_format((float)($forecast['tomorrowKWh'] ?? 0), 2, ',', '.') . ' kWh</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Überschuss nach Eigenverbrauch</td><td style="' . $cellValue . '">' . number_format((float)($forecast['pvSurplusTomorrowKWh'] ?? 0), 2, ',', '.') . ' kWh</td>';
        $html .= '<td style="' . $cellLabel . '">PV ausreichend ab</td><td style="' . $cellValue . '">' . (!empty($forecast['morningTs']) ? date('H:i', (int)$forecast['morningTs']) : '-') . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Max. prognostizierte PV-Leistung</td><td style="' . $cellValue . '">' . number_format((float)($plan['pvPeakPowerTomorrowW'] ?? 0) / 1000.0, 2, ',', '.') . ' kW</td>';
        $html .= '<td style="' . $cellLabel . '">Max. Einspeisung ohne Batterie</td><td style="' . $cellValue . '">' . number_format((float)($plan['predictedMaxGridExportTomorrowW'] ?? 0) / 1000.0, 2, ',', '.') . ' kW</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Netzlimit</td><td style="' . $cellValue . '">' . number_format((float)($plan['gridLimitW'] ?? 0) / 1000.0, 2, ',', '.') . ' kW</td>';
        $html .= '<td style="' . $cellLabel . '">Speicherbedarf Netzlimit-Schutz</td><td style="' . $cellValue . '">' . number_format((float)($plan['gridLimitSpaceRequiredKWh'] ?? 0), 2, ',', '.') . ' kWh</td>';
        $html .= '</tr>';
        if (!empty($plan['gridLimitFirstCriticalTs'])) {
            $html .= '<tr>';
            $html .= '<td style="' . $cellLabel . '">Kritischer Zeitraum ab</td><td style="' . $cellValue . '">' . date('d.m. H:i', (int)$plan['gridLimitFirstCriticalTs']) . '</td>';
            $html .= '<td style="' . $cellLabel . '">Unvermeidbare Abregelung</td><td style="' . $cellValue . '">' . number_format((float)($plan['unavoidableCurtailmentKWh'] ?? 0), 2, ',', '.') . ' kWh</td>';
            $html .= '</tr>';
        }

        $html .= '<tr><td colspan="4" style="' . $sectionStyle . '">Optimierung</td></tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Einspeisung verfügbar</td><td style="' . $cellValue . '">' . number_format((float)$plan['availableKWh'], 2, ',', '.') . ' kWh</td>';
        $html .= '<td style="' . $cellLabel . '">Speicher für PV freizugeben</td><td style="' . $cellValue . '">' . number_format((float)$plan['pvSpaceRequiredKWh'], 2, ',', '.') . ' kWh</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Speicher bei Nachtbeginn erwartet</td><td style="' . $cellValue . '">' . number_format((float)($plan['projectedStoredAtNightStartKWh'] ?? $plan['storedKWh']), 2, ',', '.') . ' kWh</td>';
        $html .= '<td style="' . $cellLabel . '">davon für Einspeisung frei</td><td style="' . $cellValue . '">' . number_format((float)($plan['availableAtNightStartKWh'] ?? 0), 2, ',', '.') . ' kWh</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Mindestpreis Einspeisung</td><td style="' . $cellValue . '">' . number_format($this->GetMinimumFeedInPriceCt(), 2, ',', '.') . ' ct/kWh</td>';
        $lockStatusID = @$this->GetIDForIdent('FeedInPriceLockStatus');
        $lockStatus = $lockStatusID > 0 ? (string)GetValue($lockStatusID) : '';
        $html .= '<td style="' . $cellLabel . '">Preissperre</td><td style="' . $cellValue . '">' . htmlspecialchars($lockStatus !== '' ? $lockStatus : 'wird mit nächster Steuerprüfung aktualisiert') . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="' . $cellLabel . '">Erwarteter Erlös</td><td style="' . $cellValue . '">' . number_format((float)$plan['expectedRevenueEUR'], 2, ',', '.') . ' €</td>';
        $html .= '<td style="' . $cellLabel . '">Status</td><td style="' . $cellValue . '">' . htmlspecialchars((string)$plan['status']) . '</td>';
        $html .= '</tr>';

        $html .= '</table></div>';
        return $html;
    }

    private function HumanizeLearningSource(string $source, bool $night): string
    {
        $source = trim($source);
        if ($source === '') {
            return 'keine Lernwerte';
        }

        // Bestehende interne Texte nur für die Anzeige verständlicher formulieren.
        if (preg_match('/Archiv gelernt\\s*[–-]\\s*(\\d+)\\s+gültige Nächte/ui', $source, $m)) {
            return 'aus Archiv · ' . (int)$m[1] . ' gültige Nächte';
        }

        if (preg_match('/Archiv gelernt\\s*[–-]\\s*(\\d+)\\s+Tage,\\s*Stundenprofil/ui', $source, $m)) {
            return 'aus Archiv · ' . (int)$m[1] . ' gültige Tage · stündliches Profil';
        }

        if (preg_match('/Archiv gelernt\\s*[–-]\\s*(\\d+)\\s+Tage/ui', $source, $m)) {
            return 'aus Archiv · ' . (int)$m[1] . ' gültige Tage';
        }

        if (stripos($source, 'Fallback') !== false) {
            return $night ? 'Fallback-Nachtverbrauch' : 'Fallback-Tagesprofil';
        }

        return $source;
    }


    private function RenderFeedInStatisticsHTML(): string
    {
        $stats = $this->ReadAttributeInteger('ArchiveStorageMigrationVersion') >= 1 ? $this->ReadFeedInStatisticsFromArchive() : [];
        if (!is_array($stats) || count($stats) === 0) { $stats=json_decode($this->ReadAttributeString('FeedInStatisticsJSON'),true); if(!is_array($stats))$stats=[]; }
        $totalDaily=json_decode($this->ReadAttributeString('GridExportDailyJSON'),true); if(!is_array($totalDaily))$totalDaily=[];
        $autoByDay=[];
        foreach($stats as $r){$ts=(int)($r['start']??$r['end']??0);if($ts<=0)continue;$d=date('Y-m-d',$ts);if(!isset($autoByDay[$d]))$autoByDay[$d]=['kWh'=>0.0,'eur'=>0.0,'target'=>0.0,'windows'=>0];$autoByDay[$d]['kWh']+=max(0.0,(float)($r['deliveredKWh']??0));$autoByDay[$d]['eur']+=(float)($r['revenueEUR']??0);$autoByDay[$d]['target']+=max(0.0,(float)($r['targetKWh']??0));$autoByDay[$d]['windows']++;}
        $dates=array_unique(array_merge(array_keys($autoByDay),array_keys($totalDaily),[date('Y-m-d')])); sort($dates); $first=strtotime($dates[0].' 00:00:00'); $last=strtotime(end($dates).' 00:00:00');
        $startMonth=strtotime(date('Y-m-01 00:00:00',$first)); $endMonth=strtotime(date('Y-m-01 00:00:00',$last)); $monthNames=[1=>'Januar',2=>'Februar',3=>'März',4=>'April',5=>'Mai',6=>'Juni',7=>'Juli',8=>'August',9=>'September',10=>'Oktober',11=>'November',12=>'Dezember']; $months=[];
        for($m=$startMonth;$m<=$endMonth;$m=strtotime('+1 month',$m)){$year=(int)date('Y',$m);$mon=(int)date('n',$m);$n=(int)date('t',$m);$rows=[];$sum=['autoKWh'=>0.0,'autoEUR'=>0.0,'otherKWh'=>0.0,'otherEUR'=>0.0];for($d=1;$d<=$n;$d++){$key=sprintf('%04d-%02d-%02d',$year,$mon,$d);$a=$autoByDay[$key]??['kWh'=>0,'eur'=>0,'target'=>0,'windows'=>0];$t=$totalDaily[$key]??['kWh'=>0,'eur'=>0];$otherK=max(0.0,(float)$t['kWh']-(float)$a['kWh']);$otherE=max(0.0,(float)$t['eur']-(float)$a['eur']);$row=['label'=>str_pad((string)$d,2,'0',STR_PAD_LEFT),'date'=>sprintf('%02d.%02d.%04d',$d,$mon,$year),'autoKWh'=>round((float)$a['kWh'],3),'autoEUR'=>round((float)$a['eur'],3),'otherKWh'=>round($otherK,3),'otherEUR'=>round($otherE,3),'targetKWh'=>round((float)$a['target'],3),'windows'=>(int)$a['windows']];$rows[]=$row;foreach($sum as $k=>$_)$sum[$k]+=$row[$k];}$months[]=['key'=>date('Y-m',$m),'label'=>$monthNames[$mon].' '.$year,'isCurrent'=>date('Y-m',$m)===date('Y-m'),'rows'=>$rows,'sum'=>$sum];}
        $highchartsJS=$this->GetHighchartsJavaScript();$id='sbo_feed_stats_'.$this->InstanceID;$html='<div style="font-family:Tahoma,Arial,-apple-system,BlinkMacSystemFont,Segoe UI,sans-serif;color:#fff;width:100%"><b>Einspeise-Statistik</b><br><span style="font-size:11px">Blau: Einspeiseautomatik · Grün: übrige gemessene Netzeinspeisung. Transparente Balken zeigen den jeweiligen Erlös.</span><br>';if($highchartsJS==='')return $html.'<div style="margin-top:8px">Highcharts lokal nicht verfügbar.</div></div>';
        $html.='<div id="'.$id.'" style="width:100%;height:430px;margin-top:8px"></div><div style="display:flex;justify-content:center;align-items:center;gap:12px;margin:4px 0 8px"><button id="'.$id.'_prev" type="button">&#8592;</button><span id="'.$id.'_date" style="min-width:190px;text-align:center;font-weight:bold"></span><button id="'.$id.'_next" type="button">&#8594;</button><button id="'.$id.'_today" type="button">Heute</button></div><div id="'.$id.'_summary" style="font-size:11px;text-align:center"></div><script>'.$highchartsJS.'</script><script>(function(){';
        $html.='var months='.json_encode($months,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES).',id='.json_encode($id).',idx=Math.max(0,months.length-1);function e(s){return document.getElementById(id+s)}function f(v,n){return Highcharts.numberFormat(Number(v)||0,n,",",".")}function draw(){var m=months[idx],a=[],o=[],ae=[],oe=[],c=[];m.rows.forEach(function(r){c.push(r.label);a.push({y:r.autoKWh,custom:r});o.push({y:r.otherKWh,custom:r});ae.push({y:r.autoEUR,custom:r});oe.push({y:r.otherEUR,custom:r})});Highcharts.chart(e(""),{chart:{type:"column",backgroundColor:"transparent",animation:false,style:{fontFamily:"Tahoma,Arial,-apple-system,BlinkMacSystemFont,Segoe UI,sans-serif"}},title:{text:null},credits:{enabled:false},legend:{itemStyle:{color:"#fff",fontWeight:"normal",fontSize:"10px"}},xAxis:{categories:c,labels:{style:{color:"#fff",fontSize:"10px"}}},yAxis:[{min:0,title:{text:"kWh",style:{color:"#fff"}},labels:{style:{color:"#fff"}},gridLineColor:"rgba(255,255,255,.18)"},{min:0,opposite:true,title:{text:"€",style:{color:"#ffe082"}},labels:{format:"{value:.2f} €",style:{color:"#ffe082"}},gridLineWidth:0}],tooltip:{shared:true,useHTML:true,formatter:function(){var r=this.points&&this.points[0]?this.points[0].point.custom:{};return "<b>"+(r.date||"")+"</b><br>Automatik: <b>"+f(r.autoKWh,2)+" kWh</b> / "+f(r.autoEUR,2)+" €<br><span style=\"color:#7bdc8a\">Sonstige: <b>"+f(r.otherKWh,2)+" kWh</b> / "+f(r.otherEUR,2)+" €</span><br>Gesamt: <b>"+f(Number(r.autoKWh)+Number(r.otherKWh),2)+" kWh / "+f(Number(r.autoEUR)+Number(r.otherEUR),2)+" €</b>"+(r.targetKWh>0?"<br>Automatik geplant: "+f(r.targetKWh,2)+" kWh":"")}},plotOptions:{column:{borderWidth:0,grouping:false}},series:[{name:"Automatik kWh",data:a,color:"#4d9de0",pointPlacement:-0.18,pointWidth:12,yAxis:0},{name:"Sonstige kWh",data:o,color:"#45b96b",pointPlacement:0.18,pointWidth:12,yAxis:0},{name:"Automatik Erlös",data:ae,color:"rgba(255,213,79,.42)",pointPlacement:-0.18,pointWidth:7,yAxis:1},{name:"Sonstiger Erlös",data:oe,color:"rgba(69,185,107,.38)",pointPlacement:0.18,pointWidth:7,yAxis:1}]});e("_date").innerHTML=m.label+(m.isCurrent?" &ndash; Heute":"");var s=m.sum;e("_summary").innerHTML="Monat · Automatik: <b>"+f(s.autoKWh,2)+" kWh / "+f(s.autoEUR,2)+" €</b> &middot; Sonstige: <b>"+f(s.otherKWh,2)+" kWh / "+f(s.otherEUR,2)+" €</b> &middot; Gesamt: <b>"+f(Number(s.autoKWh)+Number(s.otherKWh),2)+" kWh / "+f(Number(s.autoEUR)+Number(s.otherEUR),2)+" €</b>";e("_prev").disabled=idx<=0;e("_next").disabled=idx>=months.length-1}e("_prev").onclick=function(){if(idx>0){idx--;draw()}};e("_next").onclick=function(){if(idx<months.length-1){idx++;draw()}};e("_today").onclick=function(){idx=months.length-1;draw()};draw()})();</script></div>';return $html;
    }

    private function RenderConsumptionProfileChartHTML(array $profile): string
    {
        $highchartsJS = $this->GetHighchartsJavaScript();
        $chartId = 'sbo_consumption_profile_' . $this->InstanceID;
        $learned = isset($profile['hourlyKWh']) && is_array($profile['hourlyKWh']) ? array_values($profile['hourlyKWh']) : array_fill(0, 24, 0.0);
        $days = []; $archiveID = $this->FindArchive(); $varID = $this->ReadPropertyInteger('HousePowerVariable');
        for ($age = 6; $age >= 0; $age--) {
            $dayStart = strtotime('-' . $age . ' days 00:00:00');
            $actual = ($archiveID > 0 && $varID > 0 && @IPS_VariableExists($varID)) ? $this->GetHourlyConsumptionForDay($archiveID, $varID, $dayStart) : null;
            $rows = [];
            $actualTotal = 0.0;
            $actualHasValues = false;
            $now = time();
            for ($h=0;$h<24;$h++) {
                $hourStart = $dayStart + $h * 3600;
                // Für heute darf ein Ist-Balken erst erscheinen, wenn die betreffende
                // Stunde begonnen hat. Zukünftige Stunden sind ausdrücklich null und
                // werden damit von Highcharts nicht gezeichnet.
                $actualValue = null;
                if (is_array($actual) && $hourStart <= $now) {
                    $actualValue = round(max(0.0,(float)($actual[$h]??0)),3);
                    $actualTotal += $actualValue;
                    $actualHasValues = true;
                }
                $rows[]=[
                    'label'=>str_pad((string)$h,2,'0',STR_PAD_LEFT).':00',
                    'forecastKWh'=>round(max(0.0,(float)($learned[$h]??0)),3),
                    'actualKWh'=>$actualValue
                ];
            }
            $days[]=[
                'date'=>date('Y-m-d',$dayStart),
                'label'=>date('d.m.Y',$dayStart),
                'forecastTotalKWh'=>round(array_sum($learned),3),
                'actualTotalKWh'=>$actualHasValues?round($actualTotal,3):null,
                'rows'=>$rows
            ];
        }
        $html='<div style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;color:#fff;width:100%"><b>Verbrauch / gelerntes Lastprofil</b><br><span style="font-size:11px">Stündliche Verbrauchsprognose im Vergleich zum tatsächlichen Verbrauch</span><br>';
        if($highchartsJS==='') return $html.'<div style="margin-top:8px">Highcharts lokal nicht verfügbar.</div></div>';
        $html.='<div id="'.$chartId.'" style="width:100%;height:410px;margin-top:8px"></div><div style="display:flex;justify-content:center;align-items:center;gap:12px;margin:4px 0 8px"><button id="'.$chartId.'_prev" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:16px;min-width:46px">&#8592;</button><span id="'.$chartId.'_date" style="min-width:150px;text-align:center;font-weight:bold"></span><button id="'.$chartId.'_next" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:16px;min-width:46px">&#8594;</button><button id="'.$chartId.'_today" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;min-width:72px;font-weight:bold;padding:4px 12px;cursor:pointer">Heute</button></div><div id="'.$chartId.'_summary" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:11px;color:#fff;text-align:center"></div><script>'.$highchartsJS.'</script><script>(function(){';
        $html.='var days='.json_encode($days).',id='.json_encode($chartId).',key='.json_encode('sbo_consumption_selected_day_' . $this->InstanceID).',idx=Math.max(0,days.length-1),chart=null;try{var sd=localStorage.getItem(key);if(sd){for(var si=0;si<days.length;si++){if(days[si].date===sd){idx=si;break;}}}}catch(e){}function e(s){return document.getElementById(id+s)}function draw(){if(days.length){try{localStorage.setItem(key,days[idx].date)}catch(e){}}if(!days.length||typeof Highcharts==="undefined")return;var d=days[idx],c=[],f=[],a=[];for(var j=0;j<d.rows.length;j++){var r=d.rows[j];c.push(r.label);f.push(r.forecastKWh);a.push(r.actualKWh)}chart=Highcharts.chart(id,{chart:{type:"column",backgroundColor:"transparent",animation:false,style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif"}},title:{text:null},credits:{enabled:false},legend:{itemStyle:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#fff",fontWeight:"normal"}},xAxis:{categories:c,lineColor:"#fff",tickColor:"#fff",labels:{style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#fff"}}},yAxis:{min:0,title:{text:"kWh",style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#fff"}},labels:{style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#fff"}},gridLineColor:"rgba(255,255,255,.18)"},tooltip:{shared:true,valueSuffix:" kWh",style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif"}},plotOptions:{column:{borderWidth:0,grouping:false,groupPadding:.06,pointPadding:.02}},series:[{name:"Gelerntes Lastprofil",data:f,dataLabels:{enabled:true,formatter:function(){return this.y>=.15?Highcharts.numberFormat(this.y,1,",","."):""},style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"9px",fontWeight:"normal",color:"#fff",textOutline:"none"}}},{name:"Ist-Verbrauch",data:a,color:"rgba(255,213,79,.38)",pointPadding:.20}]});e("_date").innerHTML=d.label+(idx===days.length-1?" &ndash; Heute":"");e("_summary").innerHTML="Prognose: <b>"+Highcharts.numberFormat(d.forecastTotalKWh,2,",",".")+" kWh</b> &middot; <span style=\"color:#ffe082\">Ist: <b>"+(d.actualTotalKWh===null?"–":Highcharts.numberFormat(d.actualTotalKWh,2,",",".")+" kWh")+"</b></span>";e("_prev").disabled=idx<=0;e("_next").disabled=idx>=days.length-1}function init(){e("_prev").onclick=function(){if(idx>0){idx--;draw()}};e("_next").onclick=function(){if(idx<days.length-1){idx++;draw()}};e("_today").onclick=function(){var t=new Date(),y=t.getFullYear()+"-"+String(t.getMonth()+1).padStart(2,"0")+"-"+String(t.getDate()).padStart(2,"0");for(var q=0;q<days.length;q++){if(days[q].date===y){idx=q;break;}}draw()};draw()}if(document.readyState==="loading")document.addEventListener("DOMContentLoaded",init);else setTimeout(init,0)})();</script></div>';
        return $html;
    }

    private function RenderPVForecastChartHTML(array $forecast): string
    {
        // Bewusst einfacher Highcharts-Aufbau wie bei der stabilen Preisgrafik.
        // Die Tagesnavigation erzeugt das Diagramm komplett neu, statt Serien dynamisch
        // zu verändern. Das ist im IP-Symcon HTMLBox/WebFront deutlich robuster.
        $highchartsJS = $this->GetHighchartsJavaScript();
        $chartId = 'sbo_pv_forecast_chart_' . $this->InstanceID;
        $todayDate = date('Y-m-d');
        $tomorrowDate = date('Y-m-d', strtotime('tomorrow'));
        $history = json_decode($this->ReadAttributeString('PVForecastHistoryJSON'), true);
        $debugMode = $this->ReadPropertyBoolean('DebugMode');
        $sourceHistory = json_decode($this->ReadAttributeString('PVSourceForecastHistoryJSON'), true);
        if (!is_array($sourceHistory)) $sourceHistory = [];
        $sourceWeights = is_array($forecast['forecastSourceWeights'] ?? null) ? $forecast['forecastSourceWeights'] : [];
        $storedSourceWeights = json_decode($this->ReadAttributeString('PVSourceWeightsJSON'), true);
        if (!is_array($storedSourceWeights)) $storedSourceWeights = [];

        $debugSources = [];
        if ($this->ReadPropertyBoolean('UseOpenMeteoForecast')) $debugSources[] = 'openmeteo';
        if ($this->ReadPropertyBoolean('UseForecastSolarForecast')) $debugSources[] = 'forecastsolar';
        if ($this->ReadPropertyBoolean('UsePVNodeForecast')) $debugSources[] = 'pvnode';

        $sourceLabels = [];
        foreach ($debugSources as $src) {
            $weight = array_key_exists($src, $sourceWeights)
                ? (float)$sourceWeights[$src]
                : (float)($storedSourceWeights[$src] ?? 0.0);
            $sourceLabels[$src] = $this->SourceDisplayName((string)$src) . ' (' . number_format($weight * 100.0, 1, ',', '.') . ' %)';
        }
        if (!is_array($history)) {
            $history = [];
        }

        // HEUTE und MORGEN im Diagramm immer aus dem AKTUELLEN Forecast aufbauen.
        // Historische Tage bleiben unverändert gespeichert. Das ist wichtig, weil sich der
        // PV-Auto-Faktor während des Tages ändern kann: Die blaue Highcharts-Serie muss dann
        // sofort dieselben korrigierten totalKW-Werte zeigen wie die Diagnose.
        $hours = is_array($forecast['hours'] ?? null) ? $forecast['hours'] : [];
        foreach ([$todayDate, $tomorrowDate] as $date) {
            $dayStart = strtotime($date . ' 00:00:00');
            $hourly = [];
            for ($h = 0; $h < 24; $h++) {
                // totalKW enthält bereits: Provider -> Quellengewichtung -> Anlagen-Auto-Faktor.
                $hourly[$h] = round(max(0.0, (float)($hours[$dayStart + $h * 3600]['totalKW'] ?? 0.0)), 4);
            }
            $history[$date] = [
                'hourlyKWh' => $hourly,
                'totalKWh' => array_sum($hourly),
                'savedAt' => time(),
                'dayAhead' => ($date === $tomorrowDate)
            ];
        }
        ksort($history);

        $days = [];
        $source = '';
        $minTs = strtotime('-7 days 00:00:00');
        $maxTs = strtotime('tomorrow 00:00:00');
        foreach ($history as $date => $entry) {
            $dayStart = strtotime($date . ' 00:00:00');
            if ($dayStart === false || $dayStart < $minTs || $dayStart > $maxTs) {
                continue;
            }
            $hourlyForecast = is_array($entry['hourlyKWh'] ?? null) ? array_values($entry['hourlyKWh']) : array_fill(0, 24, 0.0);
            $actual = $this->GetActualPVHourlyForDay($dayStart);
            if ($source === '' && !empty($actual['source'])) {
                $source = (string)$actual['source'];
            }
            $rows = [];
            for ($h = 6; $h < 22; $h++) {
                $actualValue = $actual['hourlyKWh'][$h] ?? null;
                $sourceKWh = [];
                if ($debugMode) {
                    foreach ($sourceLabels as $src => $label) {
                        $v = $sourceHistory[$src][$date][$h] ?? null;
                        $sourceKWh[$src] = $v === null ? null : round(max(0.0, (float)$v), 3);
                    }
                }
                $rows[] = [
                    'label' => str_pad((string)$h, 2, '0', STR_PAD_LEFT) . ':00',
                    'forecastKWh' => round(max(0.0, (float)($hourlyForecast[$h] ?? 0.0)), 3),
                    'actualKWh' => $actualValue === null ? null : round(max(0.0, (float)$actualValue), 3),
                    'sourceKWh' => $sourceKWh
                ];
            }
            $days[] = [
                'date' => $date,
                'label' => date('d.m.Y', $dayStart),
                'forecastTotalKWh' => round((float)($entry['totalKWh'] ?? array_sum($hourlyForecast)), 3),
                'actualTotalKWh' => round((float)($actual['energyKWh'] ?? 0.0), 3),
                'savedAt' => (int)($entry['savedAt'] ?? 0),
                'dayAhead' => !empty($entry['dayAhead']),
                'sourceLabels' => $debugMode ? $sourceLabels : [],
                'rows' => $rows
            ];
        }

        $dataJson = json_encode($days, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE);
        if ($dataJson === false) {
            $dataJson = '[]';
        }

        $html = '<div style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;color:#fff">';
        $html .= '<b>PV-Prognose – Prognose und Ist-Produktion</b><br>';
        $html .= '<span style="font-size:11px;color:#bbb">Aktualisiert: ' . date('d.m.Y H:i:s') . ' &middot; Darstellung 06:00–22:00 Uhr' . ($debugMode ? ' &middot; Debug-Quellenserien verfügbar' : '') . '</span><br>';

        if ($highchartsJS !== '') {
            $html .= '<div id="' . $chartId . '" style="width:100%;height:410px;margin-top:8px;margin-bottom:6px"></div>';
            $html .= '<div style="display:flex;justify-content:center;align-items:center;gap:12px;margin:4px 0 8px 0">';
            $html .= '<button id="' . $chartId . '_prev" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:16px;min-width:46px;padding:3px 12px;cursor:pointer">&#8592;</button>';
            $html .= '<span id="' . $chartId . '_date" style="min-width:150px;text-align:center;font-weight:bold"></span>';
            $html .= '<button id="' . $chartId . '_next" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:16px;min-width:46px;padding:3px 12px;cursor:pointer">&#8594;</button>';
            $html .= '<button id="' . $chartId . '_today" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;min-width:72px;padding:4px 12px;font-weight:bold;cursor:pointer">Heute</button>';
            $html .= '</div>';
            $html .= '<div id="' . $chartId . '_summary" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:11px;color:#fff;margin-bottom:8px;text-align:center"></div>';
            $html .= '<script>' . $highchartsJS . '</script>';
            $html .= '<script>(function(){';
            $html .= 'var days=' . $dataJson . ';';
            $html .= 'var today=' . json_encode($todayDate) . ';';
            $html .= 'var chartId=' . json_encode($chartId) . ';';
            $html .= 'var visibilityKey="sbo_pv_debug_visibility_' . $this->InstanceID . '";';
            $html .= 'var selectedDayKey="sbo_pv_selected_day_' . $this->InstanceID . '";';
            $html .= 'function loadVisibility(){var out={};try{var v=localStorage.getItem(visibilityKey);if(v){var l=JSON.parse(v);for(var k in l){if(Object.prototype.hasOwnProperty.call(l,k)){out[k]=!!l[k];}}}}catch(e){}return out;}';
            $html .= 'function saveVisibility(v){try{localStorage.setItem(visibilityKey,JSON.stringify(v));}catch(e){}}';
            // Fehlende Eintraege bedeuten sichtbar. Damit werden neu aktivierte
            // Provider (Open-Meteo, Forecast.Solar, pvnode) beim ersten Aufbau
            // nicht stillschweigend ausgeblendet. Danach wird der tatsaechlich
            // eingetretene Highcharts show/hide-Zustand gespeichert.

            $html .= 'var debugVisibility=loadVisibility();';
            $html .= 'var chart=null;';
            $html .= 'var idx=0;var savedDay=null;try{savedDay=localStorage.getItem(selectedDayKey);}catch(e){}var i,found=false;for(i=0;i<days.length;i++){if(savedDay&&days[i].date===savedDay){idx=i;found=true;break;}}if(!found){for(i=0;i<days.length;i++){if(days[i].date===today){idx=i;break;}}}';
            $html .= 'function el(s){return document.getElementById(chartId+s);}';
            $html .= 'function draw(){';
            $html .= 'if(!days.length||typeof Highcharts==="undefined"){return;}';
            $html .= 'var d=days[idx];try{localStorage.setItem(selectedDayKey,d.date);}catch(e){}var categories=[];var forecastData=[];var actualData=[];var sourceData={};';
            $html .= 'for(var src in d.sourceLabels){if(Object.prototype.hasOwnProperty.call(d.sourceLabels,src)){sourceData[src]=[];}}';
            $html .= 'for(var j=0;j<d.rows.length;j++){var r=d.rows[j];categories.push(r.label);forecastData.push({y:r.forecastKWh,custom:r});actualData.push(r.actualKWh===null?null:{y:r.actualKWh,custom:r});for(var src2 in sourceData){var sv=(r.sourceKWh&&Object.prototype.hasOwnProperty.call(r.sourceKWh,src2))?r.sourceKWh[src2]:null;sourceData[src2].push(sv===null?null:{y:sv,custom:r});}}';
            $html .= 'var chartSeries=[{name:"PV-Prognose kombiniert",data:forecastData,zIndex:1,dataLabels:{enabled:true,crop:false,overflow:"allow",formatter:function(){return this.y>=0.25?Highcharts.numberFormat(this.y,1,",","."):"";},style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"9px",fontWeight:"normal",color:"#ffffff",textOutline:"none"}}},{name:"Ist-Produktion",data:actualData,color:"rgba(255,213,79,0.38)",zIndex:3,pointPadding:0.20,dataLabels:{enabled:false}}];';
            $html .= 'for(var src3 in sourceData){if(Object.prototype.hasOwnProperty.call(sourceData,src3)){var vis=Object.prototype.hasOwnProperty.call(debugVisibility,src3)?!!debugVisibility[src3]:true;chartSeries.push({name:d.sourceLabels[src3],type:"line",data:sourceData[src3],visible:vis,zIndex:5,lineWidth:2,marker:{enabled:true,radius:2},custom:{sourceKey:src3},events:{show:function(){var key=this.options.custom&&this.options.custom.sourceKey;if(key){debugVisibility[key]=true;saveVisibility(debugVisibility);}},hide:function(){var key=this.options.custom&&this.options.custom.sourceKey;if(key){debugVisibility[key]=false;saveVisibility(debugVisibility);}}},dataLabels:{enabled:false}});}}';
            $html .= 'chart=chart=Highcharts.chart(chartId,{';
            $html .= 'chart:{type:"column",backgroundColor:"transparent",animation:false,style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#ffffff"}},';
            $html .= 'title:{text:null},credits:{enabled:false},';
            $html .= 'legend:{enabled:true,itemStyle:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#ffffff",fontWeight:"normal"},itemHoverStyle:{color:"#ffffff"}},';
            $html .= 'xAxis:{categories:categories,lineColor:"#ffffff",tickColor:"#ffffff",tickInterval:1,labels:{style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#ffffff"}}},';
            $html .= 'yAxis:{min:0,title:{text:"kWh",style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#ffffff"}},labels:{style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#ffffff"}},gridLineColor:"rgba(255,255,255,0.18)"},';
            $html .= 'tooltip:{useHTML:true,backgroundColor:"rgba(30,30,30,0.96)",borderColor:"#888888",style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#ffffff",fontSize:"11px"},formatter:function(){return "<span style=\\"font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;color:#fff\\"><b>"+d.label+" "+this.point.custom.label+"</b><br>"+this.series.name+": <b>"+Highcharts.numberFormat(this.y,2,",",".")+" kWh</b></span>";}},';
            $html .= 'plotOptions:{column:{borderWidth:0,grouping:false,groupPadding:0.06,pointPadding:0.02}},';
            $html .= 'series:chartSeries';
            $html .= '});';
            $html .= 'var dateEl=el("_date");if(dateEl){dateEl.innerHTML=d.label+(d.date===today?" &ndash; Heute":"");}';
            $html .= 'var sumEl=el("_summary");if(sumEl){sumEl.innerHTML="Prognose: <b>"+Highcharts.numberFormat(d.forecastTotalKWh,2,",",".")+" kWh</b> &middot; <span style=\\"color:#ffe082\\">Ist: <b>"+Highcharts.numberFormat(d.actualTotalKWh,2,",",".")+" kWh</b></span>"+(d.dayAhead?" &middot; gespeicherte Day-Ahead-Prognose":"");}';
            $html .= 'var prev=el("_prev"),next=el("_next");if(prev){prev.disabled=(idx<=0);}if(next){next.disabled=(idx>=days.length-1);}';
            $html .= '}';
            $html .= 'function init(){var prev=el("_prev"),next=el("_next"),todayBtn=el("_today");if(prev){prev.onclick=function(){if(idx>0){idx--;draw();}};}if(next){next.onclick=function(){if(idx<days.length-1){idx++;draw();}};}if(todayBtn){todayBtn.onclick=function(){for(var q=0;q<days.length;q++){if(days[q].date===today){idx=q;break;}}draw();};}draw();}';
            $html .= 'if(document.readyState==="loading"){document.addEventListener("DOMContentLoaded",init);}else{setTimeout(init,0);}';
            $html .= '})();</script>';
        } else {
            // Fallback: Heute als einfache HTML-Balken darstellen.
            $selected = null;
            foreach ($days as $day) {
                if (($day['date'] ?? '') === $todayDate) {
                    $selected = $day;
                    break;
                }
            }
            if ($selected === null && count($days) > 0) {
                $selected = $days[count($days) - 1];
            }
            if ($selected !== null) {
                $maxKWh = 0.01;
                foreach ($selected['rows'] as $row) {
                    $maxKWh = max($maxKWh, (float)$row['forecastKWh']);
                    if ($row['actualKWh'] !== null) {
                        $maxKWh = max($maxKWh, (float)$row['actualKWh']);
                    }
                }
                $html .= '<div style="margin:8px 0 14px 0;padding:8px;border:1px solid rgba(128,128,128,.45);border-radius:6px">';
                foreach ($selected['rows'] as $row) {
                    $forecastWidth = max(0.0, min(100.0, ((float)$row['forecastKWh'] / $maxKWh) * 100.0));
                    $actualWidth = $row['actualKWh'] === null ? 0.0 : max(0.0, min(100.0, ((float)$row['actualKWh'] / $maxKWh) * 100.0));
                    $html .= '<div style="display:flex;align-items:center;margin:3px 0"><div style="width:45px;flex:0 0 45px">' . htmlspecialchars((string)$row['label']) . '</div><div style="flex:1;height:16px;position:relative;background:rgba(128,128,128,.08)"><div style="position:absolute;left:0;top:1px;height:14px;width:' . number_format($forecastWidth, 1, '.', '') . '%;background:#4e8fd3"></div>';
                    if ($row['actualKWh'] !== null) {
                        $html .= '<div style="position:absolute;left:0;top:4px;height:8px;width:' . number_format($actualWidth, 1, '.', '') . '%;background:rgba(255,213,79,.38)"></div>';
                    }
                    $html .= '</div><div style="width:125px;text-align:right">' . number_format((float)$row['forecastKWh'], 2, ',', '.') . ' kWh';
                    if ($row['actualKWh'] !== null) {
                        $html .= ' / <span style="color:#ffe082">' . number_format((float)$row['actualKWh'], 2, ',', '.') . '</span>';
                    }
                    $html .= '</div></div>';
                }
                $html .= '</div>';
            } else {
                $html .= '<div style="margin:8px 0;padding:8px;border:1px solid rgba(128,128,128,.45);border-radius:6px">Keine PV-Prognosedaten vorhanden.</div>';
            }
        }

        $html .= '<div style="font-size:11px;color:#ccc">' . ($debugMode ? 'Debug: Die einzelnen Anbieter sind in der Legende mit ihrer aktuellen Gewichtung aufgeführt und können separat eingeblendet werden.<br>' : '') . 'Angezeigt werden nur die Stunden 06:00–22:00 Uhr; die Tages-Gesamtsummen beziehen sich weiterhin auf den vollständigen Tag. Blau = prognostizierte Energie je Stunde in kWh. Transparentes Gelb = tatsächlich erzeugte Energie je Stunde aus dem IP-Symcon-Archiv. Quelle Ist-Werte: ' . htmlspecialchars($source) . '. Gespeicherte Prognosen werden bis zu 14 Tage vorgehalten; in der Grafik sind die letzten 7 Tage sowie morgen anwählbar. Für Tage vor Installation der Speicherung existiert keine ursprüngliche Prognose.</div>';
        return $html . '</div>';
    }

    private function RenderPVCalibrationDiagnosisHTML(array $forecast): string
    {
        $cal = is_array($forecast['surfaceCalibration'] ?? null) ? $forecast['surfaceCalibration'] : [];
        $days = max(1, $this->ReadPropertyInteger('PVCalibrationDays'));
        $html = '<div style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;color:#fff">';
        $html .= '<b>PV-Kalibrierung Diagnose</b><br><span style="font-size:11px">Auto-Faktor = tatsächlich erzeugte Energie / prognostizierte Energie vor Auto-Faktor. Der berechnete Faktor wird ab dem ersten gültigen abgeschlossenen Stundenpaar angezeigt. Bis ' . $days . ' gültige Lerntage erreicht sind, bleibt der angewendete Auto-Faktor 1,000. Danach werden immer die neuesten ' . $days . ' gültigen Tage rollierend verwendet.</span><br>';
        $gate = $this->GetPVCalibrationFeedInGate();
        if ($this->ReadPropertyBoolean('DebugMode')) {
            $html .= '<div style="margin:8px 0;padding:6px;border:1px solid #666"><b>PV-Abregelung / Kalibriersperre</b><br>';
            $html .= 'Netz: ' . ($gate['feedInW'] === null ? '-' : number_format((float)$gate['feedInW'],0,',','.') . ' W') . ' | ';
            $html .= 'Sperre ab: ' . ($gate['thresholdW'] === null ? '-' : number_format((float)$gate['thresholdW'],0,',','.') . ' W') . ' | ';
            $html .= 'Batterie: ' . ($gate['batteryPowerW'] === null ? '-' : number_format((float)$gate['batteryPowerW'],0,',','.') . ' W') . '<br>';
            $html .= '<b>Abregelung erkannt: ' . (!empty($gate['blocked']) ? '<span style="color:#ffd166">JA – Kalibrierung gesperrt; nur Zeitraum ab bestätigter Grenzüberschreitung wird verworfen</span>' : 'NEIN – Kalibrierung erlaubt') . '</b>';
            $html .= '<br>2-Min-Fenster: über Schwelle '
                . number_format((float)($gate['windowHighPct'] ?? 0), 1, ',', '.') . ' % | unter Schwelle '
                . number_format((float)($gate['windowLowPct'] ?? 0), 1, ',', '.') . ' % | Schaltschwelle '
                . number_format((float)($gate['majorityPct'] ?? 75), 0, ',', '.') . ' %';
            if (!empty($gate['blocked']) && !empty($gate['blockedFromTs'])) {
                $html .= '<br>Verworfener Bereich beginnt: ' . date('H:i:s', (int)$gate['blockedFromTs'])
                    . ' (2 min vor erstem hohen Wert)';
            }
            $pollSeconds = max(10, min(120, $this->ReadPropertyInteger('PVCalibrationPollSeconds')));
            $html .= '<br><span style="opacity:.75">Aktualisierung der Kalibrierung und dieser Anzeige: alle ' . $pollSeconds . ' Sekunden</span></div>';
        }
        $html .= '<br>';
        if (count($cal) === 0) return $html . 'Keine aktive PV-Fläche.</div>';
        $beforeAuto = (float)($forecast['todayKWhBeforeAuto'] ?? $forecast['todayKWh'] ?? 0.0);
        $afterAuto = (float)($forecast['todayKWh'] ?? 0.0);
        $plantFactor = (float)($forecast['plantAutoFactor'] ?? 1.0);
        $html .= '<div style="margin:8px 0;padding:6px;border:1px solid #555"><b>Gesamtprognose / Auto-Korrektur</b><br>'
            . 'Kombinierte Prognose vor Auto: <b>' . number_format($beforeAuto, 2, ',', '.') . ' kWh</b>'
            . ' | Referenz-Gesamtfaktor (energiegewichtet): <b>' . number_format($plantFactor, 3, ',', '.') . '</b>'
            . ' | Prognose nach Auto: <b>' . number_format($afterAuto, 2, ',', '.') . ' kWh</b></div>';
        $html .= '<div style="overflow-x:auto"><table style="border-collapse:collapse;width:100%;font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:11px;color:#fff">';
        $html .= '<tr><th style="text-align:left;border-bottom:1px solid #888;padding:4px">PV-Fläche</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Prognose<br>vor Auto</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Ist-Erzeugung</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Ist / Prognose</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Auto-Faktor</th><th style="text-align:right;border-bottom:1px solid #888;padding:4px">Intervalle</th><th style="text-align:left;border-bottom:1px solid #888;padding:4px">Lernzeitraum</th></tr>';
        foreach ($cal as $name => $c) {
            $sumE = (float)($c['sumExpectedKWh'] ?? 0.0);
            $sumA = (float)($c['sumActualKWh'] ?? 0.0);
            $ratio = $c['learnedRatio'] ?? null;
            $factor = (float)($c['autoFactor'] ?? 1.0);
            $first = (int)($c['firstSampleTs'] ?? 0);
            $last = (int)($c['lastSampleTs'] ?? 0);
            $status = !empty($c['calibrationBlocked']) ? '<br><span style="color:#ffd166">' . htmlspecialchars((string)$c['calibrationBlockReason']) . '</span>' : '';
            $html .= '<tr>';
            $html .= '<td style="padding:4px;border-bottom:1px solid rgba(128,128,128,.25)"><b>' . htmlspecialchars((string)$name) . '</b>' . $status . '</td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . number_format($sumE, 2, ',', '.') . ' kWh</td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . number_format($sumA, 2, ',', '.') . ' kWh</td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . ($ratio === null ? '– (noch kein Vergleich)' : number_format((float)$ratio, 3, ',', '.') . (empty($c['factorReady']) ? ' (berechnet, Lernphase)' : '')) . '</td>';
            $seasonInfo = '';
            if (isset($c['seasonStats']) && is_array($c['seasonStats'])) {
                $ss = $c['seasonStats'];
                $sf = $ss['factor'] ?? null;
                $seasonInfo = '<br><span style="opacity:.75">Saison ' . htmlspecialchars((string)($ss['label'] ?? '')) . ': ' . ($sf === null ? '-' : number_format((float)$sf, 3, ',', '.'))
                    . ' | ' . number_format((float)($ss['expectedKWh'] ?? 0.0), 1, ',', '.') . ' kWh Prognose'
                    . ' | ' . number_format((float)($ss['actualKWh'] ?? 0.0), 1, ',', '.') . ' kWh Ist'
                    . ' | ' . (int)($ss['days'] ?? 0) . ' Tage</span>';
            }
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)"><b>' . number_format($factor, 3, ',', '.') . '</b>' . $seasonInfo . '</td>';
            $html .= '<td style="text-align:right;padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . (int)($c['sampleCount'] ?? 0) . '</td>';
            $html .= '<td style="padding:4px;border-bottom:1px solid rgba(128,128,128,.25)">' . ($first > 0 ? date('d.m. H:i', $first) : '-') . ' – ' . ($last > 0 ? date('d.m. H:i', $last) : '-') . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table></div>';
        $html .= '<div style="margin-top:8px;padding:6px;border:1px solid #555"><b>Kontrolle Verdichtung</b><br>';
        foreach ($cal as $name => $c) {
            $a = isset($c['compactionAudit']) && is_array($c['compactionAudit']) ? $c['compactionAudit'] : [];
            if (count($a) === 0) continue;
            $fb = $a['factorBefore'] ?? null; $fa = $a['factorAfter'] ?? null;
            $ok = abs((float)($a['expectedDeltaKWh'] ?? 0.0)) < 0.0001 && abs((float)($a['actualDeltaKWh'] ?? 0.0)) < 0.0001;
            $html .= '<div style="margin-top:3px"><b>' . htmlspecialchars((string)$name) . ':</b> '
                . (int)($a['rawCount'] ?? 0) . ' → ' . (int)($a['bucketCount'] ?? 0) . ' Intervalle'
                . ' | Prognose ' . number_format((float)($a['expectedBeforeKWh'] ?? 0.0), 3, ',', '.') . ' → ' . number_format((float)($a['expectedAfterKWh'] ?? 0.0), 3, ',', '.') . ' kWh'
                . ' | Ist ' . number_format((float)($a['actualBeforeKWh'] ?? 0.0), 3, ',', '.') . ' → ' . number_format((float)($a['actualAfterKWh'] ?? 0.0), 3, ',', '.') . ' kWh'
                . ' | Faktor ' . ($fb === null ? '-' : number_format((float)$fb, 3, ',', '.')) . ' → ' . ($fa === null ? '-' : number_format((float)$fa, 3, ',', '.'))
                . ' | <b>' . ($ok ? 'verlustfrei' : 'ABWEICHUNG') . '</b></div>';
        }
        $html .= '</div><br><span style="font-size:11px"><b>Beispiel:</b> Prognose vor Auto-Faktor 100,0 kWh, tatsächliche Erzeugung 118,0 kWh ⇒ Verhältnis 1,180 ⇒ Auto-Faktor 1,180 (begrenzt durch die eingestellten Min-/Max-Werte). Alte Watt-Samples aus Versionen vor 1.5.0 werden automatisch verworfen.</span>';
        return $html . '</div>';
    }

    private function RenderPriceChartHTML(array $forecast, array $prices, array $plan): string
    {
        // Diagramm-Rendering exakt nach dem bewährten Highcharts-Aufbau aus v1.2.6.
        // Nur die Daten werden vorab von 15 Minuten auf Stundenmittel zusammengefasst.
        $highchartsJS = $this->GetHighchartsJavaScript();
        $chartId = 'sbo_price_chart_' . $this->InstanceID;
        $minimumPrice = $this->GetMinimumFeedInPriceCt();

        $now = time();
        $displayStart = mktime((int)date('H', $now), 0, 0, (int)date('m', $now), (int)date('d', $now), (int)date('Y', $now));
        $displayHours = max(24, min(72, $this->ReadPropertyInteger('PriceDisplayHours')));
        $displayEnd = $displayStart + $displayHours * 3600;
        $hourBuckets = [];

        for ($i = 0; $i < $displayHours; $i++) {
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

        $html = '<div style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;color:#fff">';
        $html .= '<b>Einspeisevergütung – Stundenmittel der nächsten ' . $displayHours . ' Stunden</b><br>';
        $html .= '<span style="font-size:11px;color:#bbb">Aktualisiert: ' . date('d.m.Y H:i:s') . '</span><br>';
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
            $html .= 'chart:{type:"column",backgroundColor:"transparent",animation:false,style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#ffffff"}},';
            $html .= 'title:{text:null,style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#ffffff"}},credits:{enabled:false},legend:{enabled:false,itemStyle:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#ffffff"},itemHoverStyle:{color:"#ffffff"}},';
            $html .= 'xAxis:{categories:categories,lineColor:"#ffffff",tickColor:"#ffffff",labels:{rotation:-45,style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#ffffff"}}},';
            $html .= 'yAxis:{title:{text:"ct/kWh",style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#ffffff"}},labels:{style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#ffffff"}},gridLineColor:"rgba(255,255,255,0.18)",plotLines:[{value:0,color:"#ffffff",width:1,zIndex:4},{value:' . json_encode($minimumPrice) . ',color:"#e0a000",width:1,dashStyle:"Dash",zIndex:4,label:{text:"Mindestpreis Einspeisung ' . number_format($minimumPrice, 2, ',', '.') . ' ct",style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#ffffff"}}}]},';
            $html .= 'tooltip:{useHTML:true,backgroundColor:"rgba(30,30,30,0.96)",borderColor:"#888888",style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#ffffff",fontSize:"11px"},formatter:function(){var r=this.point.custom;return "<span style=\\"font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;color:#fff\\"><b>"+r.label+"</b><br>Börsenpreis: <b>"+Highcharts.numberFormat(r.marketCt,2,",",".")+" ct/kWh</b><br>Berechneter Tarif: "+Highcharts.numberFormat(r.priceCt,2,",",".")+" ct/kWh"+(r.selected?"<br><b>"+(r.reason==="pv_space"?"Speicher für PV freihalten":"Preisoptimierung")+"</b><br>Leistung: "+Highcharts.numberFormat(r.powerW/1000,2,",",".")+" kW<br>Energie: "+Highcharts.numberFormat(r.energyKWh,2,",",".")+" kWh":"")+"</span>";}},';
            $html .= 'plotOptions:{column:{borderWidth:0,groupPadding:0.08,pointPadding:0.03,dataLabels:{enabled:true,crop:false,overflow:"allow",formatter:function(){return Highcharts.numberFormat(this.y,2,",",".")+" ct";},style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",fontWeight:"normal",color:"#ffffff",textOutline:"none"}}}},';
            $html .= 'series:[{name:"Einspeisevergütung",data:market}]';
            $html .= '});}';
            $html .= 'if(document.readyState==="loading"){document.addEventListener("DOMContentLoaded",renderSBOChart);}else{setTimeout(renderSBOChart,0);}';
            $html .= '})();</script>';
        } else {
            $html .= $this->RenderFallbackPriceChart($chartRows, $minimumPrice);
        }
        $missingHours = $displayHours - $knownHours;
        $priceAvailabilityText = $missingHours > 0
            ? ' Für ' . $missingHours . ' der nächsten ' . $displayHours . ' Stunden sind vom Preisportal noch keine veröffentlichten Werte vorhanden; diese Stunden werden beim nächsten Abruf automatisch ergänzt.'
            : ' Für alle nächsten ' . $displayHours . ' Stunden liegen Preiswerte vor.';
        $html .= '<div style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:11px;color:#fff;margin-bottom:8px">Grün = Preisoptimierung, Gelb = Speicher für PV freihalten, Rot = negative Einspeisevergütung, Blau = übrige Stunden.' . htmlspecialchars($priceAvailabilityText) . '</div>';
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
