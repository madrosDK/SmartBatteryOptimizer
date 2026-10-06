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
            ['Active' => true, 'Name' => 'Süd', 'KWp' => 10.0, 'OrientationKnown' => true, 'Azimuth' => 0, 'Tilt' => 25, 'Factor' => 1.0, 'AutoCalibrate' => true, 'PVVariable1' => 0, 'PVVariable2' => 0, 'PVVariable3' => 0, 'PVNodeStringID' => '']
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
        $this->RegisterPropertyInteger('GridExportEnergyVariable', 0);
        $this->RegisterPropertyInteger('PVActualPowerVariable', 0);
        $this->RegisterPropertyInteger('LearningDays', 30);
        $this->RegisterPropertyFloat('FallbackNightConsumptionKWh', 4.0);
        $this->RegisterPropertyBoolean('ConsumptionProfileLearningEnabled', true);
        $this->RegisterPropertyFloat('EVChargingDetectionThresholdKW', 6.5);
        $this->RegisterPropertyFloat('EVChargingMaxEnergyKWh', 14.4);
        $this->RegisterPropertyFloat('EVChargingMinRiseKW', 4.0);
        $this->RegisterPropertyFloat('EVChargingExpectedRiseKW', 6.5);
        $this->RegisterPropertyFloat('EVChargingRiseToleranceKW', 2.0);
        $this->RegisterPropertyInteger('EVChargingMinimumDurationMinutes', 20);
        $this->RegisterPropertyBoolean('EVFutureDetectionEnabled', true);
        $this->RegisterPropertyInteger('EVArchiveSearchDays', 90);
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
        $this->RegisterVariableString('EVArchiveSearchStatus', 'Autoladung Archivsuche', '', 154);
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
        $this->RegisterAttributeString('OpenMeteoSurfaceCacheJSON', '{}');
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
        $this->RegisterAttributeString('PVSurfaceStableIDsJSON', '{}');
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
        $this->RegisterAttributeString('PVCalibrationPendingForecastJSON', '{}');
        $this->RegisterAttributeString('PVCalibrationCleanupStatus', '');
        $this->RegisterAttributeInteger('CalculationLockUntil', 0);
        $this->RegisterAttributeString('PricesJSON', '[]');
        $this->RegisterAttributeInteger('PriceCacheUpdatedTs', 0);
        $this->RegisterAttributeString('PriceCacheSignature', '');
        $this->RegisterAttributeInteger('PriceArchiveAlignmentVersion', 0);
        $this->RegisterAttributeInteger('PriceArchiveLastSyncedTs', 0);
        $this->RegisterAttributeString('PlanJSON', '[]');
        $this->RegisterAttributeInteger('FeedInPlannerVersion', 0);
        $this->RegisterAttributeFloat('LearnedNightKWh', 0.0);
        $this->RegisterAttributeString('NightLearningSource', 'Fallback');
        $this->RegisterAttributeInteger('NightSampleCount', 0);
        $this->RegisterAttributeString('ConsumptionProfileJSON', '{}');
        $this->RegisterAttributeInteger('ConsumptionProfileUpdated', 0);
        $this->RegisterAttributeString('ConsumptionLearningSource', 'Fallback');
        $this->RegisterAttributeString('ConsumptionArchiveRebuildStateJSON', '{}');
        $this->RegisterAttributeString('EVArchiveSearchStateJSON', '{}');
        $this->RegisterAttributeString('EVArchiveDetectionsJSON', '{}');
        $this->RegisterAttributeString('EVChargingPatternJSON', '{}');
        $this->RegisterAttributeBoolean('AlphaDispatchActive', false);
        $this->RegisterAttributeString('AlphaDispatchCommandKey', '');
        $this->RegisterAttributeString('ActiveFeedInPlanKey', '');
        $this->RegisterAttributeFloat('ActiveFeedInTargetKWh', 0.0);
        $this->RegisterAttributeFloat('ActiveFeedInDeliveredKWh', 0.0);
        $this->RegisterAttributeInteger('ActiveFeedInLastTs', 0);
        $this->RegisterAttributeFloat('ActiveFeedInLastExportW', 0.0);
        $this->RegisterAttributeFloat('ActiveFeedInLastEnergyKWh', 0.0);
        $this->RegisterAttributeInteger('ActiveFeedInEnergyVariableID', 0);
        $this->RegisterAttributeInteger('ActiveFeedInLastAdjustmentTs', 0);
        $this->RegisterAttributeInteger('ActiveFeedInPlannedEndTs', 0);
        $this->RegisterAttributeString('CompletedFeedInPlanKeysJSON', '{}');
        $this->RegisterAttributeString('FeedInStatisticsJSON', '[]');
        $this->RegisterAttributeString('FeedInDebugLogJSON', '[]');
        $this->RegisterAttributeString('GridExportDailyJSON', '{}');
        $this->RegisterAttributeInteger('GridExportTrackLastTs', 0);
        $this->RegisterAttributeFloat('GridExportTrackLastW', 0.0);
        $this->RegisterAttributeInteger('FeedInStatisticsLastRenderTs', 0);
        $this->RegisterAttributeInteger('FeedInStatisticsResetVersion', 0);
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
        $this->RegisterTimer('PVForecastTimer', 0, 'SBO_RefreshPVForecast($_IPS[\'TARGET\']);');
        $this->RegisterTimer('PVForecastRetryTimer', 0, 'SBO_RefreshPVForecastRetry($_IPS[\'TARGET\']);');
        $this->RegisterTimer('PVActualTimer', 0, 'SBO_RefreshPVActual($_IPS[\'TARGET\']);');
        $this->RegisterTimer('PVCalibrationTimer', 0, 'SBO_RefreshPVCalibration($_IPS[\'TARGET\']);');
        $this->RegisterTimer('ControlTimer', 0, 'SBO_Control($_IPS[\'TARGET\']);');
        $this->RegisterTimer('ManualRecalculateWorker', 0, 'SBO_RunManualRecalculate($_IPS[\'TARGET\']);');
        $this->RegisterTimer('EVArchiveSearchWorker', 0, 'SBO_RunEVArchiveSearch($_IPS[\'TARGET\']);');
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

    private function PVSurfaceFingerprint(array $surface): string
    {
        $vars=[(int)($surface['PVVariable1']??0),(int)($surface['PVVariable2']??0),(int)($surface['PVVariable3']??0)]; sort($vars);
        return implode(',', $vars).'|pn:'.trim((string)($surface['PVNodeStringID']??'')).'|kwp:'.number_format((float)($surface['KWp']??0),3,'.','');
    }

    private function EnsurePVSurfaceStableIDs(): void
    {
        $surfaces=json_decode($this->ReadPropertyString('PVSurfaces'),true); if(!is_array($surfaces))$surfaces=[];
        $old=json_decode($this->ReadAttributeString('PVSurfaceStableIDsJSON'),true); if(!is_array($old))$old=[];
        $used=[];$new=[];$maxID=-1; foreach($old as $entry)$maxID=max($maxID,(int)($entry['id']??-1));
        foreach($surfaces as $idx=>$surface){
            $fp=$this->PVSurfaceFingerprint($surface);$name=trim((string)($surface['Name']??''));$match=null;
            foreach($old as $entry){$id=(int)($entry['id']??-1);if($id<0||isset($used[$id]))continue;if(($entry['fingerprint']??'')===$fp){$match=$entry;break;}}
            if($match===null)foreach($old as $entry){$id=(int)($entry['id']??-1);if($id<0||isset($used[$id]))continue;if($name!==''&&($entry['name']??'')===$name){$match=$entry;break;}}
            if($match===null&&isset($old[$idx])){$id=(int)($old[$idx]['id']??-1);if($id>=0&&!isset($used[$id]))$match=$old[$idx];}
            if($match===null)$match=['id'=>++$maxID];$id=(int)$match['id'];$used[$id]=true;$new[]=['id'=>$id,'name'=>$name,'fingerprint'=>$fp];
        }
        foreach($old as $entry){$id=(int)($entry['id']??-1);if($id<0||isset($used[$id]))continue;foreach(['Expected','Actual'] as $kind){$vid=(int)@$this->GetIDForIdent('PVCal'.$kind.'_'.$id);if($vid>0&&@IPS_VariableExists($vid))@IPS_DeleteVariable($vid);}}
        $this->WriteAttributeString('PVSurfaceStableIDsJSON',json_encode($new));
    }

    private function PVCalibrationIdent(string $kind,int $idx): string
    {
        $map=json_decode($this->ReadAttributeString('PVSurfaceStableIDsJSON'),true);$id=$idx;if(is_array($map)&&isset($map[$idx]['id']))$id=(int)$map[$idx]['id'];return 'PVCal'.$kind.'_'.$id;
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
        $currentPriceVarID = (int)@$this->GetIDForIdent('CurrentPrice');
        if ($currentPriceVarID > 0) @IPS_SetVariableCustomProfile($currentPriceVarID, 'SBO.PriceCt');
        $this->InitializeFeedInFactorMemory();
        $this->EnsurePVSurfaceStableIDs();

        // v1.10.04: ältere Zukunftspläne konnten die Nacht-Einspeiseleistung fälschlich
        // mit Netzeinspeiselimit minus Sicherheitsabstand begrenzen (z.B. 10 kW - 0,5 kW = 9,5 kW).
        // Nur den zwischengespeicherten Plan verwerfen, niemals Archivdaten. Einen bereits laufenden
        // Einspeisevorgang lassen wir unangetastet.
        if ($this->ReadAttributeInteger('FeedInPlannerVersion') < 4) {
            if ($this->ReadAttributeString('ActiveFeedInPlanKey') === '') {
                $this->WriteAttributeString('PlanJSON', '[]');
                $targetVar = (int)@$this->GetIDForIdent('FeedInTargetEnergy');
                $deliveredVar = (int)@$this->GetIDForIdent('FeedInDeliveredEnergy');
                $windowVar = (int)@$this->GetIDForIdent('NextFeedInWindow');
                if ($targetVar > 0) SetValue($targetVar, 0.0);
                if ($deliveredVar > 0) SetValue($deliveredVar, 0.0);
                if ($windowVar > 0) SetValue($windowVar, '-');
                $this->DebugLog('Einspeiseplan', 'v1.10.04: alten Zukunftsplan verworfen; Nachtplanung jetzt mit Max. Einspeise-/Entladeleistung minus prognostiziertem Eigenverbrauch.');
            }
            $this->WriteAttributeInteger('FeedInPlannerVersion', 4);
        }

        // v1.10.33: Nachtplanung unterscheidet nun sauber zwischen Netz-Ziel und
        // physischer WR-/Batterie-Maximalleistung. Alte Zukunftsplaene einmalig
        // verwerfen, damit kein 9,5-kW-/Altplan erhalten bleibt. Laufende
        // Einspeisungen werden nicht angefasst.
        if ($this->ReadAttributeInteger('FeedInPlannerVersion') < 5) {
            if ($this->ReadAttributeString('ActiveFeedInPlanKey') === '') {
                $this->WriteAttributeString('PlanJSON', '[]');
                $targetVar = (int)@$this->GetIDForIdent('FeedInTargetEnergy');
                $deliveredVar = (int)@$this->GetIDForIdent('FeedInDeliveredEnergy');
                $windowVar = (int)@$this->GetIDForIdent('NextFeedInWindow');
                if ($targetVar > 0) SetValue($targetVar, 0.0);
                if ($deliveredVar > 0) SetValue($deliveredVar, 0.0);
                if ($windowVar > 0) SetValue($windowVar, '-');
                $this->DebugLog('Einspeiseplan', 'v1.10.33: alten Zukunftsplan verworfen; Netz-Ziel + Lastprofil werden jetzt gegen die WR-Maximalleistung begrenzt.');
            }
            $this->WriteAttributeInteger('FeedInPlannerVersion', 5);
        }

        // v1.10.34: Dispatch bleibt strikt auf Netz-Ziel/WR-Maximum begrenzt. Das
        // Lastprofil reduziert die rechnerisch erreichbare Netzeinspeisung nur dann,
        // wenn Netz-Ziel + Last die physische WR-Maximalleistung uebersteigen.
        if ($this->ReadAttributeInteger('FeedInPlannerVersion') < 6) {
            if ($this->ReadAttributeString('ActiveFeedInPlanKey') === '') {
                $this->WriteAttributeString('PlanJSON', '[]');
                $targetVar = (int)@$this->GetIDForIdent('FeedInTargetEnergy');
                $deliveredVar = (int)@$this->GetIDForIdent('FeedInDeliveredEnergy');
                $windowVar = (int)@$this->GetIDForIdent('NextFeedInWindow');
                if ($targetVar > 0) SetValue($targetVar, 0.0);
                if ($deliveredVar > 0) SetValue($deliveredVar, 0.0);
                if ($windowVar > 0) SetValue($windowVar, '-');
                $this->DebugLog('Einspeiseplan', 'v1.10.34: Zukunftsplan neu aufgebaut; Dispatch bleibt am Netz-Ziel, Last reduziert die Rechenleistung nur bei WR-Leistungsgrenze.');
            }
            $this->WriteAttributeInteger('FeedInPlannerVersion', 6);
        }
        // Zeitreihen ab 1.9.79 im IP-Symcon Archive Control verwalten.
        // Bestehende JSON-Lerndaten/Statistiken werden beim ersten Lauf einmalig uebernommen.
        $this->EnsureArchiveStorageAndMigration();
        // Ab v1.10.42 werden bei Updates keine Statistikdaten mehr automatisch
        // zurückgesetzt oder entfernt. Der einmalige v1.10.41-Reset wird nicht erneut aufgerufen.

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
        $pvCalibrationPollSeconds = max(10, min(120, $this->ReadPropertyInteger('PVCalibrationPollSeconds')));

        // Bewaehrte Timer-Struktur wie in v1.10.10/v1.10.18:
        // Jede Aufgabe besitzt ihren eigenen internen Modul-Timer.
        $this->SetTimerInterval('RefreshTimer', $refresh * 60 * 1000);
        $this->SetTimerInterval('PVForecastTimer', $pvForecastRefresh * 60 * 1000);
        $this->SetTimerInterval('PVForecastRetryTimer', 0);
        $this->SetTimerInterval('PVActualTimer', $pvActualRefresh * 60 * 1000);
        $this->SetTimerInterval('PVCalibrationTimer', $pvCalibrationPollSeconds * 1000);
        $this->SetTimerInterval('ControlTimer', 15 * 1000);
        $this->SetTimerInterval('ManualRecalculateWorker', 0);
        $this->SetTimerInterval('EVArchiveSearchWorker', 0);
        $this->SetTimerInterval('FullRefreshWorker', 0);
        $this->SetTimerInterval('DeferredDebugRebuildTimer', 0);
        $rebuildState = json_decode($this->ReadAttributeString('ConsumptionArchiveRebuildStateJSON'), true);
        if (is_array($rebuildState) && !empty($rebuildState['active'])) {
            // Der bereits bestehende ManualRecalculateWorker wird für den blockweisen
            // Archiv-Wiederaufbau wiederverwendet. Damit ist kein zusätzlicher Modul-Timer nötig.
            $this->SetTimerInterval('ManualRecalculateWorker', 5000);
        }
        $evSearchState = json_decode($this->ReadAttributeString('EVArchiveSearchStateJSON'), true);
        if (is_array($evSearchState) && !empty($evSearchState['active'])) {
            $this->SetTimerInterval('EVArchiveSearchWorker', 4000);
        }

        // Reste der zwischenzeitlichen Scheduler-/Watchdog-Versionen entfernen.
        $this->CleanupLegacySchedulerArtifacts();
        $this->SetBuffer('SchedulerState', '');
        $this->SetBuffer('SchedulerTask', '');
        $this->SetBuffer('SchedulerForceRefresh', '');

        $this->DebugLog('ApplyChanges',
            'Timerstruktur v1.10.18 aktiv | Preise=' . $refresh . ' min'
            . ' | PV-Prognose=' . $pvForecastRefresh . ' min'
            . ' | PV-Ist=' . $pvActualRefresh . ' min'
            . ' | PV-Kalibrierung=' . $pvCalibrationPollSeconds . ' s'
            . ' | Steuerpruefung=15 s'
        );

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

        // Externe API-Abfragen duerfen ApplyChanges nicht blockieren.
        if ($debugModeChanged) {
            if ($debugMode) {
                $this->DebugLog('ApplyChanges', 'Debug-Modus geaendert -> asynchroner Neuaufbau wird gestartet.');
            }
            $this->SetTimerInterval('DeferredDebugRebuildTimer', 250);
        }

        $currentModuleVersion = '1.10.59';
        if ($this->ReadAttributeString('AppliedModuleVersion') !== $currentModuleVersion) {
            $this->WriteAttributeString('AppliedModuleVersion', $currentModuleVersion);
            // Ein PHP-Fatalfehler kann den flüchtigen Rechen-Lock zurücklassen, weil
            // PHP den finally-Block bei erschöpftem Speicher nicht zuverlässig erreicht.
            // Beim Modulupdate darf dieser alte Lock den vorgesehenen Vollrefresh nicht
            // noch bis zu 15 Minuten blockieren. Es werden keinerlei Lern-/Archivdaten
            // verändert, nur die Laufzeitsperre wird freigegeben.
            $this->WriteAttributeInteger('CalculationLockUntil', 0);
            $this->SetActionFeedback('Modulupdate erkannt – Anzeigen, PV-Quellen und Planung werden aktualisiert ...');
            $this->SetTimerInterval('FullRefreshWorker', 1500);
        }
    }

    private function CleanupLegacySchedulerArtifacts(): void
    {
        foreach (['WatchdogLastRun', 'WatchdogCounter', 'WatchdogBusySkips', 'SchedulerLastRun', 'SchedulerCounter', 'SchedulerStatus'] as $ident) {
            try {
                $id = (int)@$this->GetIDForIdent($ident);
                if ($id > 0 && @IPS_VariableExists($id)) {
                    $this->UnregisterVariable($ident);
                }
            } catch (Throwable $ignored) {}
        }

        // Das frueher extern angelegte PHP-Skript wird nicht mehr benoetigt. Nur ein
        // eindeutig zu dieser Instanz gehoerendes Skript mit dem bekannten Namen und
        // dem alten Scheduler-Aufruf wird entfernt. Die Datei wird dabei nicht endgueltig
        // geloescht, sondern von IP-Symcon in den deleted-Bereich verschoben.
        try {
            foreach (@IPS_GetChildrenIDs($this->InstanceID) ?: [] as $childID) {
                $obj = @IPS_GetObject($childID);
                if (!is_array($obj) || (int)($obj['ObjectType'] ?? -1) !== 3) continue;
                if ((string)($obj['ObjectName'] ?? '') !== 'SmartBatteryOptimizer Scheduler') continue;
                $content = (string)@IPS_GetScriptContent($childID);
                if (strpos($content, 'SBO_SchedulerTick') === false && strpos($content, 'SBO_Control') === false) continue;
                @IPS_SetScriptTimer($childID, 0);
                @IPS_DeleteScript($childID, false);
                $this->DebugLog('Scheduler', 'Altes externes Scheduler-Skript entfernt.');
            }
        } catch (Throwable $ignored) {}
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
    }

    public function ExportStoredData(): string
    {
        $stringAttributes = [
            'ForecastJSON','PVForecastHistoryJSON','PVSourceForecastHistoryJSON','ForecastSolarSurfaceCacheJSON','OpenMeteoSurfaceCacheJSON',
            'PVDebugVisibilityJSON','ProviderDebugLogJSON','ActionHistoryJSON','AppliedModuleVersion','PVSourceWeightsJSON','PVNodeLastError',
            'PVCalibrationJSON','PVCalibrationCurtailmentSamplesJSON','PVCalibrationExcludedPeriodsJSON','PVCalibrationExclusionActiveReason','PVCalibrationCleanupStatus','PricesJSON','PriceCacheSignature','PlanJSON','NightLearningSource',
            'ConsumptionProfileJSON','ConsumptionLearningSource','ConsumptionArchiveRebuildStateJSON','EVArchiveSearchStateJSON','EVArchiveDetectionsJSON','EVChargingPatternJSON','AlphaDispatchCommandKey','ActiveFeedInPlanKey',
            'CompletedFeedInPlanKeysJSON','FeedInStatisticsJSON','ActiveFeedInReason','AlphaTestTrace','ArchiveStorageStatus'
        ];
        $integerAttributes = [
            'ForecastSolarRetryAfterTs','PVSourceWeightLearningResetTs','PVNodeConsecutiveRejects','PVCalibrationEnergyVersion',
            'PVCalibrationBelowThresholdSince','PVCalibrationAboveThresholdSince','PVCalibrationAboveThresholdCount',
            'PVCalibrationBlockedFromTs','PVCalibrationExclusionActiveFromTs','NightSampleCount','ConsumptionProfileUpdated','ActiveFeedInLastTs','ActiveFeedInEnergyVariableID','ManualTestUntil',
            'ManualTestPowerW','AlphaTestStage','AlphaTestNextTs','ActiveFeedInLastAdjustmentTs','ActiveFeedInPlannedEndTs','ActiveFeedInStartedTs','FeedInFactorVariableLastID','ArchiveStorageMigrationVersion','PriceCacheUpdatedTs','PriceArchiveAlignmentVersion','PriceArchiveLastSyncedTs','FeedInStatisticsLastRenderTs','FeedInStatisticsResetVersion'
        ];
        $floatAttributes = ['LearnedNightKWh','ActiveFeedInTargetKWh','ActiveFeedInDeliveredKWh','ActiveFeedInLastExportW','ActiveFeedInLastEnergyKWh','ActiveFeedInPriceCt','FeedInFactorOriginalValue'];
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
            'moduleVersion' => '1.10.59',
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
        // Direkter Vollrefresh. Der fruehere 1-s-One-Shot-Worker konnte in
        // IP-Symcon ausbleiben und bei "Auftrag angenommen ..." stehen bleiben.
        $this->SetTimerInterval('FullRefreshWorker', 0);
        $this->SetActionFeedback('Alles aktualisieren: Berechnung läuft ...');
        $this->RunFullRefresh();
        echo "Alle Anzeigen und Diagramme wurden aktualisiert.";
    }

    public function RunFullRefresh()
    {
        $this->SetTimerInterval('FullRefreshWorker', 0);
        $this->SetActionFeedback('Alles aktualisieren: Anzeigen, Prognosen und Diagramme werden aktualisiert ...');
        try {
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
        // Direkter Rechenlauf wie beim funktionierenden Force-Refresh.
        // Der fruehere 1-s-One-Shot-Worker konnte in IP-Symcon ausbleiben; dann
        // blieb die Aktion bei "Auftrag angenommen" stehen und weder Prognose,
        // Preise noch Planung wurden aktualisiert.
        $rebuildState = json_decode($this->ReadAttributeString('ConsumptionArchiveRebuildStateJSON'), true);
        if (!is_array($rebuildState) || empty($rebuildState['active'])) {
            $this->SetTimerInterval('ManualRecalculateWorker', 0);
        }
        $this->SetActionFeedback('Prognose & Plan: Berechnung läuft – Prognosequellen werden abgefragt ...');
        try {
            $this->RecalculateInternal(true);
            $status = (string)GetValue($this->GetIDForIdent('StatusText'));
            $this->SetActionFeedback('Prognose & Plan fertig. ' . $status);
            echo 'Prognose und Planung wurden aktualisiert.';
        } catch (Throwable $e) {
            $text = 'Prognose & Plan FEHLER: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        }
    }

    public function RunManualRecalculate()
    {
        $rebuildState = json_decode($this->ReadAttributeString('ConsumptionArchiveRebuildStateJSON'), true);
        if (is_array($rebuildState) && !empty($rebuildState['active'])) {
            $this->RunConsumptionProfileArchiveRebuild();
            return;
        }

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

    public function RefreshPVForecast()
    {
        // Der automatische PV-Timer muss die eigentliche Berechnung direkt starten.
        // Recalculate() ist bewusst nur der manuelle UI-Einstieg und schaltet einen
        // One-Shot-Worker dazwischen; dieser Umweg darf fuer zyklische Timer nicht
        // verwendet werden.
        if ($this->ReadAttributeInteger('CalculationLockUntil') > time()) {
            $this->DebugLog('PVForecastTimer', 'Berechnung belegt – PV-Prognose wird in 30 s erneut versucht');
            $this->SetTimerInterval('PVForecastRetryTimer', 30000);
            return;
        }
        $this->SetTimerInterval('PVForecastRetryTimer', 0);
        $this->DebugLog('PVForecastTimer', 'Automatische PV-Prognose startet direkt');
        $this->RecalculateInternal(true);
    }

    public function RefreshPVForecastRetry()
    {
        $this->SetTimerInterval('PVForecastRetryTimer', 0);
        if ($this->ReadAttributeInteger('CalculationLockUntil') > time()) {
            $this->DebugLog('PVForecastRetry', 'Berechnung weiterhin belegt – erneuter Versuch in 30 s');
            $this->SetTimerInterval('PVForecastRetryTimer', 30000);
            return;
        }
        $this->DebugLog('PVForecastRetry', 'Nachgeholte automatische PV-Prognose startet');
        $this->RecalculateInternal(true);
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
            $this->FinalizePVCalibrationCompletedHours();
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

    private function RefreshPricesAndChartEarly(): void
    {
        try {
            $prices = $this->FetchPrices();
            if (!is_array($prices) || count($prices) === 0) return;

            $this->WriteAttributeString('PricesJSON', json_encode($prices));
            $this->SyncCurrentPriceArchiveTimeline($prices);
            $this->UpdateCurrentPriceVariable($prices);

            $forecast = json_decode($this->ReadAttributeString('ForecastJSON'), true);
            $plan = json_decode($this->ReadAttributeString('PlanJSON'), true);
            if (is_array($forecast) && !empty($forecast) && is_array($plan) && !empty($plan)) {
                $priceChartID = (int)@$this->GetIDForIdent('PriceChartHTML');
                if ($priceChartID > 0) {
                    SetValue($priceChartID, $this->RenderPriceChartHTML($forecast, $prices, $plan));
                }
            }
            $this->DebugLog('Preise', 'Früher Preis-Refresh abgeschlossen; Slots=' . count($prices));
        } catch (Throwable $e) {
            // Der normale Rechenlauf darf durch einen separaten frühen Preis-Refresh
            // nicht abgebrochen werden; die bestehende Preisstufe versucht es später erneut.
            $this->DebugLog('Preise', 'Früher Preis-Refresh fehlgeschlagen: ' . $e->getMessage(), 0);
        }
    }

    private function RecalculateInternal(bool $refreshPVForecast, bool $forceForecastProviders = false)
    {
        $nowCalcLock = time();
        $calcLockUntil = $this->ReadAttributeInteger('CalculationLockUntil');
        if ($calcLockUntil > $nowCalcLock) {
            $this->DebugLog('Recalculate', 'Übersprungen: anderer Berechnungslauf ist noch aktiv');
            return;
        }
        $this->WriteAttributeInteger('CalculationLockUntil', $nowCalcLock + 900);
        $this->DebugLog('Recalculate', 'Start | PV-Prognose neu abrufen=' . ($refreshPVForecast ? 'ja' : 'nein'));
        $dayNight = $this->GetCurrentDayNightStatus();
        $this->DebugLog('DayNight', ($dayNight['isNight'] ? 'NACHT' : 'TAG') . ' | Fenster ' . date('Y-m-d H:i', (int)$dayNight['start']) . ' -> ' . date('Y-m-d H:i', (int)$dayNight['end']) . ' | Modus=' . ($this->ReadPropertyBoolean('AutomaticDayNight') ? 'automatisch' : 'manuell'));
        try {
            // Ein Fehler in der Steuerpruefung darf die zyklische Prognose-/Preis-
            // aktualisierung niemals blockieren. Insbesondere muss die Berechnungs-
            // sperre auch bei einer Exception in Control() wieder freigegeben werden.
            try {
                $this->Control();
            } catch (Throwable $controlError) {
                $this->DebugLog('Control', 'Steuerpruefung vor Aktualisierung fehlgeschlagen, Aktualisierung laeuft trotzdem weiter: ' . $controlError->getMessage(), 0);
            }

            // Preise und Preisdiagramm bewusst VOR Nachtverbrauch/Lastprofil aktualisieren.
            // Ein langsamer oder fehlerhafter Lernlauf darf den Börsenpreis-Refresh niemals
            // mehr blockieren. Für die Farbmarkierungen wird zunächst der zuletzt gültige
            // Forecast/Plan verwendet; am Ende des Rechenlaufs wird das Diagramm wie bisher
            // nochmals mit dem frisch berechneten Plan gerendert.
            $this->RefreshPricesAndChartEarly();

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
            $forecastWarning = '';
            if ($refreshPVForecast) {
                // Zuerst Kalibrierung/Faktoren aktualisieren, erst danach Prognose berechnen und Highcharts rendern.
                // Schlaegt nur der externe Prognoseabruf fehl, wird mit dem letzten gueltigen
                // Forecast weitergerechnet. Preise, Planung und Anzeigen duerfen deswegen nicht
                // auf einem alten Stand stehen bleiben.
                try {
                    $this->ForecastDiagnosticStep('05 PV-Kalibrierung START');
                    $this->UpdatePVCalibrationState(false);
                    $this->ForecastDiagnosticStep('06 PV-Kalibrierung ENDE');
                    $this->ForecastDiagnosticStep('07 FetchPVForecast START');
                    $forecast = $this->FetchPVForecast($forceForecastProviders);
                    $this->ForecastDiagnosticStep('08 FetchPVForecast ENDE');
                    $this->DebugLog('PV-Prognose', ['heuteKWh'=>$forecast['todayKWh'] ?? null,'morgenKWh'=>$forecast['tomorrowKWh'] ?? null,'Quellen'=>$forecast['forecastSources'] ?? [],'Gewichte'=>$forecast['forecastSourceWeights'] ?? []]);
                    $this->StorePVForecastHistory($forecast);
                } catch (Throwable $forecastError) {
                    $cachedForecast = json_decode($this->ReadAttributeString('ForecastJSON'), true);
                    if (!is_array($cachedForecast) || empty($cachedForecast)) {
                        throw $forecastError;
                    }
                    $forecast = $cachedForecast;
                    $forecastWarning = 'PV-Prognose konnte nicht neu geladen werden: ' . $forecastError->getMessage();
                    $this->DebugLog('PV-Prognose', $forecastWarning . ' | letzter gueltiger Forecast wird weiterverwendet', 0);
                }
            }
            $forecast = $this->ApplyConsumptionForecastToPV($forecast, $consumptionProfile, $night);
            SetValue($this->GetIDForIdent('PVCalibrationStatus'), $this->BuildPVCalibrationStatus($forecast));
            $gate = $this->GetAutomaticLearningGateStatus();
            SetValue($this->GetIDForIdent('AutomaticReleaseStatus'), $gate['text']);
            $this->ForecastDiagnosticStep('09 Preise START');
            $prices = $this->FetchPrices();
            // Das frisch geladene Preisraster zuerst veröffentlichen. Der parallel
            // laufende ControlTimer darf niemals noch ein altes PricesJSON lesen und
            // damit den bereits neuen CurrentPrice wieder überschreiben.
            $this->WriteAttributeString('PricesJSON', json_encode($prices));
            // Preisarchiv mit den echten Tarif-Gültigkeitszeiten pflegen. Beim ersten
            // Lauf von v1.10.39 wird der noch bekannte historische Bereich einmalig
            // bereinigt und rückwirkend mit den korrekten Startzeiten neu aufgebaut.
            $this->SyncCurrentPriceArchiveTimeline($prices);
            $this->UpdateCurrentPriceVariable($prices);
            $this->ForecastDiagnosticStep('10 Preise ENDE');
            $this->DebugLog('Preise', 'Geladene interne Preis-Slots: ' . count($prices));
            $nightForPlan = (float)($forecast['nightConsumptionTomorrowKWh'] ?? $night);
            $this->ForecastDiagnosticStep('11 Einspeiseplan START');
            // Veralteten Laufzustand bereinigen: Ein gesetzter ActiveFeedInPlanKey darf
            // die Aktualisierung des zukünftigen Plans nur blockieren, wenn tatsächlich
            // gerade eingespeist wird. Nach Neustart/Fehler kann der Schlüssel sonst
            // stehen bleiben und FeedInTargetEnergy dauerhaft auf einem alten Wert halten.
            $this->CleanupStaleActiveFeedInState();
            $previousPlan = json_decode($this->ReadAttributeString('PlanJSON'), true);
            if (!is_array($previousPlan)) $previousPlan = [];
            $plan = $this->BuildPlan($forecast, $prices, $nightForPlan, $consumptionProfile);
            // Bereits veröffentlichte zukünftige Einspeisefenster sind verbindlich.
            // Eine normale Neuberechnung darf sie nicht mehr entfernen oder verschieben.
            $plan = $this->PreserveCommittedFeedInPlan($plan, $previousPlan);
            $this->ForecastDiagnosticStep('12 Einspeiseplan ENDE');
            $this->DebugLog('Einspeiseplan', ['SoC'=>$plan['soc'] ?? null,'gespeichertKWh'=>$plan['storedKWh'] ?? null,'ReserveKWh'=>$plan['reserveKWh'] ?? null,'verfuegbarKWh'=>$plan['availableKWh'] ?? null,'PVSpeicherKWh'=>$plan['pvSpaceRequiredKWh'] ?? null,'Slots'=>count($plan['slots'] ?? []),'ErloesEUR'=>$plan['expectedRevenueEUR'] ?? null,'Status'=>$plan['status'] ?? '']);

            $this->WriteAttributeString('ForecastJSON', json_encode($forecast));
            // PricesJSON wurde unmittelbar nach FetchPrices() gespeichert, damit
            // CurrentPrice und ControlTimer dieselbe Preisbasis verwenden.
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
            if ($this->ReadAttributeString('ActiveFeedInPlanKey') === '') {
                $nextPlannedKWh = 0.0;
                $nowPlan = time();
                foreach (($plan['slots'] ?? []) as $plannedSlot) {
                    if ((int)($plannedSlot['end'] ?? 0) <= $nowPlan) continue;
                    $nextPlannedKWh = max(0.0, (float)($plannedSlot['energyKWh'] ?? 0.0));
                    break;
                }
                SetValue($this->GetIDForIdent('FeedInTargetEnergy'), round($nextPlannedKWh, 3));
                SetValue($this->GetIDForIdent('FeedInDeliveredEnergy'), 0.0);
            }
            $finalStatus = (string)$plan['status'];
            if ($forecastWarning !== '') {
                $finalStatus .= ' | WARNUNG: ' . $forecastWarning;
            }
            SetValue($this->GetIDForIdent('StatusText'), $finalStatus);
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

            // Auch wenn ein Forecast-/Provider-Abruf fehlschlaegt, darf ein bereits
            // gespeicherter verbindlicher Zukunftsplan nicht mit einer offensichtlich
            // veralteten Energiemenge stehen bleiben. Falls der letzte erfolgreiche
            // Plan bereits eine aktuelle Freigabemenge enthaelt, wird nur die
            // Sicherheitskorrektur des bestehenden Preisfensters ausgefuehrt.
            // Ein laufender Einspeisevorgang wird dabei bewusst nicht veraendert.
            try {
                $this->CleanupStaleActiveFeedInState();
                if ($this->ReadAttributeString('ActiveFeedInPlanKey') === '') {
                    $cachedPlan = json_decode($this->ReadAttributeString('PlanJSON'), true);
                    if (is_array($cachedPlan) && !empty($cachedPlan)) {
                        $safePlan = $this->PreserveCommittedFeedInPlan($cachedPlan, $cachedPlan);
                        $this->WriteAttributeString('PlanJSON', json_encode($safePlan));

                        SetValue($this->GetIDForIdent('AvailableFeedInEnergy'), round((float)($safePlan['availableKWh'] ?? 0.0), 3));
                        SetValue($this->GetIDForIdent('ExpectedRevenue'), round((float)($safePlan['expectedRevenueEUR'] ?? 0.0), 3));
                        SetValue($this->GetIDForIdent('NextFeedInWindow'), (string)($safePlan['nextWindow'] ?? '-'));

                        $nextPlannedKWh = 0.0;
                        $nowPlan = time();
                        foreach (($safePlan['slots'] ?? []) as $plannedSlot) {
                            if ((int)($plannedSlot['end'] ?? 0) <= $nowPlan) continue;
                            $nextPlannedKWh = max(0.0, (float)($plannedSlot['energyKWh'] ?? 0.0));
                            break;
                        }
                        SetValue($this->GetIDForIdent('FeedInTargetEnergy'), round($nextPlannedKWh, 3));

                        $cachedForecast = json_decode($this->ReadAttributeString('ForecastJSON'), true);
                        $cachedPrices = json_decode($this->ReadAttributeString('PricesJSON'), true);
                        if (is_array($cachedForecast)) {
                            SetValue($this->GetIDForIdent('OverviewHTML'), $this->RenderOverviewHTML($cachedForecast, $safePlan, (float)($safePlan['nightConsumptionKWh'] ?? 0.0)));
                            if (is_array($cachedPrices)) {
                                SetValue($this->GetIDForIdent('PriceChartHTML'), $this->RenderPriceChartHTML($cachedForecast, $cachedPrices, $safePlan));
                                SetValue($this->GetIDForIdent('PlanHTML'), $this->RenderPlanHTML($cachedForecast, $cachedPrices, $safePlan));
                            }
                        }
                        $this->DebugLog('Einspeiseplan', 'Fallback-Sicherheitsabgleich trotz Rechenfehler ausgefuehrt | Ziel=' . round($nextPlannedKWh, 3) . ' kWh');
                    }
                }
            } catch (Throwable $planSafetyError) {
                $this->DebugLog('Einspeiseplan', 'Fallback-Sicherheitsabgleich fehlgeschlagen: ' . $planSafetyError->getMessage(), 0);
            }

            SetValue($this->GetIDForIdent('StatusText'), 'Fehler: ' . $e->getMessage());
            $this->SetStatus(201);
            $this->StopFeedIn();
        } finally {
            // Die Sperre MUSS auch nach jeder Exception wieder geloescht werden.
            $this->WriteAttributeInteger('CalculationLockUntil', 0);
        }
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


    public function SearchEVChargingArchive()
    {
        $this->SetActionFeedback('Autoladung: Archivsuche wird vorbereitet ...');
        try {
            $rebuildState = json_decode($this->ReadAttributeString('ConsumptionArchiveRebuildStateJSON'), true);
            if (is_array($rebuildState) && !empty($rebuildState['active'])) {
                $text = 'Autoladungs-Archivsuche nicht gestartet: Die Lastprofil-Neuberechnung läuft noch.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }

            $varID = $this->ReadPropertyInteger('HousePowerVariable');
            if ($varID <= 0 || !@IPS_VariableExists($varID)) {
                $text = 'Autoladungs-Archivsuche nicht gestartet: Hausverbrauchsvariable fehlt.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }
            $archiveID = $this->FindArchive();
            if ($archiveID <= 0) {
                $text = 'Autoladungs-Archivsuche nicht gestartet: Archiv nicht gefunden.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }
            if (function_exists('AC_GetLoggingStatus') && !@AC_GetLoggingStatus($archiveID, $varID)) {
                $text = 'Autoladungs-Archivsuche nicht gestartet: Hausverbrauchsvariable ist nicht archiviert.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }

            $archiveFirstDay = $this->FindConsumptionArchiveStartDay($archiveID, $varID);
            $lastDay = strtotime('yesterday 00:00:00');
            if ($archiveFirstDay <= 0 || $archiveFirstDay > $lastDay) {
                $text = 'Autoladungs-Archivsuche nicht gestartet: keine abgeschlossenen Archivtage gefunden.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }

            $searchDays = max(0, $this->ReadPropertyInteger('EVArchiveSearchDays'));
            $firstDay = $archiveFirstDay;
            if ($searchDays > 0) {
                $limitedFirst = strtotime('-' . max(0, $searchDays - 1) . ' days', $lastDay);
                $firstDay = max($archiveFirstDay, $limitedFirst);
            }
            $thresholdKW = max(1.0, $this->ReadPropertyFloat('EVChargingDetectionThresholdKW'));
            $maxEnergyKWh = max(0.1, $this->ReadPropertyFloat('EVChargingMaxEnergyKWh'));
            $minRiseKW = max(0.5, $this->ReadPropertyFloat('EVChargingMinRiseKW'));
            $expectedRiseKW = max(0.5, $this->ReadPropertyFloat('EVChargingExpectedRiseKW'));
            $riseToleranceKW = max(0.2, $this->ReadPropertyFloat('EVChargingRiseToleranceKW'));
            $minimumDurationMinutes = max(1, $this->ReadPropertyInteger('EVChargingMinimumDurationMinutes'));
            $totalDays = max(1, (int)floor(($lastDay - $firstDay) / 86400) + 1);
            $state = [
                'active' => true,
                'archiveID' => $archiveID,
                'varID' => $varID,
                'firstDay' => $firstDay,
                'lastDay' => $lastDay,
                'cursorDay' => $lastDay,
                'started' => time(),
                'thresholdKW' => $thresholdKW,
                'maxEnergyKWh' => $maxEnergyKWh,
                'minRiseKW' => $minRiseKW,
                'expectedRiseKW' => $expectedRiseKW,
                'riseToleranceKW' => $riseToleranceKW,
                'minimumDurationMinutes' => $minimumDurationMinutes,
                'totalDays' => $totalDays,
                'processedDays' => 0,
                'foundDays' => 0,
                'sessions' => 0,
                'kWh' => 0.0,
                'rawEdges' => 0,
                'rawTrackedSessions' => 0,
                'rawRows' => 0,
                'daysWithRawData' => 0,
                'maxRawRiseW' => 0.0,
                'latestRawValueTs' => 0,
                'latestSessionTs' => 0
            ];
            $this->WriteAttributeString('EVArchiveSearchStateJSON', json_encode($state));
            $this->SetBuffer('ConsumptionEVAnalysisCache', '');
            $this->SetTimerInterval('EVArchiveSearchWorker', 1000);

            $rangeText = $searchDays <= 0 ? 'gesamtes verfügbares Archiv' : $totalDays . ' abgeschlossene Tage';
            $text = 'Autoladungs-Archivsuche gestartet: Verbrauchsvariable #' . $varID . ', ' . $rangeText
                . ' (' . date('d.m.Y', $firstDay) . ' bis ' . date('d.m.Y', $lastDay) . ')'
                . ', typischer Ladeanstieg ' . number_format($expectedRiseKW, 1, ',', '.') . ' ± ' . number_format($riseToleranceKW, 1, ',', '.') . ' kW'
                . ' (Mindestanstieg ' . number_format($minRiseKW, 1, ',', '.') . ' kW, Mindestdauer ' . $minimumDurationMinutes . ' min, feste Ladeleistung ' . number_format($thresholdKW, 1, ',', '.') . ' kW, max. Energie ' . number_format($maxEnergyKWh, 1, ',', '.') . ' kWh).';
            SetValue($this->GetIDForIdent('EVArchiveSearchStatus'), $text);
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        } catch (Throwable $e) {
            $this->SetTimerInterval('EVArchiveSearchWorker', 0);
            $text = 'Autoladungs-Archivsuche konnte nicht gestartet werden: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('EVArchiveSearchStatus'), $text);
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        }
    }

    public function RunEVArchiveSearch()
    {
        $state = json_decode($this->ReadAttributeString('EVArchiveSearchStateJSON'), true);
        if (!is_array($state) || empty($state['active'])) {
            $this->SetTimerInterval('EVArchiveSearchWorker', 0);
            return;
        }

        try {
            $archiveID = (int)($state['archiveID'] ?? 0);
            $varID = (int)($state['varID'] ?? 0);
            $firstDay = (int)($state['firstDay'] ?? 0);
            $cursorDay = (int)($state['cursorDay'] ?? 0);
            if ($archiveID <= 0 || $varID <= 0 || $firstDay <= 0 || $cursorDay <= 0) {
                throw new Exception('ungültiger Suchzustand');
            }

            $stored = json_decode($this->ReadAttributeString('EVArchiveDetectionsJSON'), true);
            if (!is_array($stored)) $stored = [];
            $batchStart = microtime(true);
            $batchDays = 0;
            while ($cursorDay >= $firstDay && $batchDays < 2 && (microtime(true) - $batchStart) < 0.80) {
                $dateKey = date('Y-m-d', $cursorDay);
                // Force=true: Ein nachträglicher Suchlauf darf nie ein altes "kein Treffer"-
                // Cacheergebnis wiederverwenden. Jede Suchrunde bewertet den Tag mit der
                // aktuell konfigurierten kW-Schwelle neu.
                $ev = $this->GetEVChargingAnalysisForDay($archiveID, $varID, $cursorDay, true);
                $sessionCount = (int)($ev['sessions'] ?? 0);
                $kWh = max(0.0, (float)($ev['kWh'] ?? 0.0));
                $state['rawEdges'] = (int)($state['rawEdges'] ?? 0) + max(0, (int)($ev['rawEdges'] ?? 0));
                $state['rawTrackedSessions'] = (int)($state['rawTrackedSessions'] ?? 0) + max(0, (int)($ev['rawTrackedSessions'] ?? 0));
                $dayRawRows = max(0, (int)($ev['rawScannedRows'] ?? 0));
                $state['rawRows'] = (int)($state['rawRows'] ?? 0) + $dayRawRows;
                if ($dayRawRows > 0) $state['daysWithRawData'] = (int)($state['daysWithRawData'] ?? 0) + 1;
                $state['maxRawRiseW'] = max((float)($state['maxRawRiseW'] ?? 0.0), max(0.0, (float)($ev['maxRawRiseW'] ?? 0.0)));
                $state['latestRawValueTs'] = max((int)($state['latestRawValueTs'] ?? 0), (int)($ev['latestRawValueTs'] ?? 0));
                foreach (($ev['rawEdgeTimestamps'] ?? []) as $edgeTs) {
                    $state['latestRawEdgeTs'] = max((int)($state['latestRawEdgeTs'] ?? 0), (int)$edgeTs);
                }
                if ($kWh > 0.01) {
                    $stored[$dateKey] = [
                        'version' => 12,
                        'thresholdKW' => max(1.0, $this->ReadPropertyFloat('EVChargingDetectionThresholdKW')),
                        'maxEnergyKWh' => max(0.1, $this->ReadPropertyFloat('EVChargingMaxEnergyKWh')),
                        'minRiseKW' => max(0.5, $this->ReadPropertyFloat('EVChargingMinRiseKW')),
                        'expectedRiseKW' => max(0.5, $this->ReadPropertyFloat('EVChargingExpectedRiseKW')),
                        'riseToleranceKW' => max(0.2, $this->ReadPropertyFloat('EVChargingRiseToleranceKW')),
                        'minimumDurationMinutes' => max(1, $this->ReadPropertyInteger('EVChargingMinimumDurationMinutes')),
                        'hourlyWh' => array_values($ev['hourlyWh'] ?? array_fill(0, 24, 0.0)),
                        'sessions' => $sessionCount,
                        'kWh' => $kWh,
                        'details' => is_array($ev['details'] ?? null) ? array_values($ev['details']) : [],
                        'updated' => time()
                    ];
                    $state['foundDays'] = (int)($state['foundDays'] ?? 0) + 1;
                    $state['sessions'] = (int)($state['sessions'] ?? 0) + $sessionCount;
                    $state['kWh'] = (float)($state['kWh'] ?? 0.0) + $kWh;
                    foreach (($ev['details'] ?? []) as $detail) {
                        $state['latestSessionTs'] = max((int)($state['latestSessionTs'] ?? 0), (int)($detail['start'] ?? 0));
                    }
                } else {
                    // Der Tag wurde mit der aktuellen Schwelle geprüft und enthält keine
                    // Autoladung. Einen eventuell früher gespeicherten Treffer für diesen
                    // Kalendertag deshalb gezielt entfernen.
                    unset($stored[$dateKey]);
                }

                $state['processedDays'] = (int)($state['processedDays'] ?? 0) + 1;
                $cursorDay = strtotime('-1 day', $cursorDay);
                $state['cursorDay'] = $cursorDay;
                $batchDays++;
            }

            // Positive Treffer sind kompakt (24 Stundenwerte + Details) und werden
            // dauerhaft gespeichert. Die eigentlichen Verbrauchsarchive bleiben unverändert.
            ksort($stored);
            $this->WriteAttributeString('EVArchiveDetectionsJSON', json_encode($stored));

            $processed = (int)($state['processedDays'] ?? 0);
            $total = max(1, (int)($state['totalDays'] ?? 1));
            $pct = min(100, (int)round($processed * 100 / $total));
            $progress = 'Autoladungs-Archivsuche: Variable #' . (int)($state['varID'] ?? 0)
                . ' · ' . $processed . '/' . $total . ' Tage (' . $pct . ' %)'
                . ' · ' . (int)($state['sessions'] ?? 0) . ' Ladungen'
                . ' · ' . (int)($state['rawEdges'] ?? 0) . ' Roh-Flanken'
                . ' · ' . (int)($state['rawTrackedSessions'] ?? 0) . ' Roh-Phasen'
                . ' · ' . (int)($state['rawRows'] ?? 0) . ' Rohwerte'
                . ' · max. Anstieg ' . number_format(((float)($state['maxRawRiseW'] ?? 0.0)) / 1000.0, 2, ',', '.') . ' kW'
                . ((int)($state['latestRawEdgeTs'] ?? 0) > 0 ? ' (letzte Flanke ' . date('d.m. H:i:s', (int)$state['latestRawEdgeTs']) . ')' : '')
                . ' · ' . number_format((float)($state['kWh'] ?? 0.0), 2, ',', '.') . ' kWh erkannt.';
            SetValue($this->GetIDForIdent('EVArchiveSearchStatus'), $progress);
            $this->SetActionFeedback($progress);

            if ($cursorDay < $firstDay) {
                $state['active'] = false;
                $state['finished'] = time();
                $this->WriteAttributeString('EVArchiveSearchStateJSON', json_encode($state));
                $this->SetTimerInterval('EVArchiveSearchWorker', 0);

                // Aus allen nachträglich gefundenen Ladephasen ein robustes Muster für
                // zukünftige Ladevorgänge bilden. Das Muster ist nur eine zusätzliche
                // Plausibilisierung; Anstieg + Plateau + Abfall bleiben die Primärerkennung.
                $pattern = $this->RebuildEVChargingPatternFromStoredDetections();

                // Das aktuelle Lernfenster sofort aus den nun bekannten Lade-Markierungen
                // neu bilden. Dank des Such-Caches werden dabei keine langen Rohwert-Scans
                // wiederholt. Historische Treffer außerhalb des Lernfensters bleiben
                // gespeichert und werden bei der nächsten Archiv-Neuberechnung verwendet.
                $profileText = '';
                if ($this->ReadPropertyBoolean('ConsumptionProfileLearningEnabled')) {
                    try {
                        $profile = $this->LearnConsumptionProfileInternal(true);
                        $chartID = (int)@$this->GetIDForIdent('ConsumptionProfileChartHTML');
                        if ($chartID > 0 && is_array($profile)) {
                            SetValue($chartID, $this->RenderConsumptionProfileChartHTML($profile));
                        }
                        $profileText = ' Aktuelles Lastprofil wurde mit den gefundenen Ladeanteilen neu gelernt.';
                    } catch (Throwable $learnError) {
                        $profileText = ' Lastprofil-Neulernen fehlgeschlagen: ' . $learnError->getMessage();
                    }
                }

                $latest = (int)($state['latestSessionTs'] ?? 0);
                $done = 'Autoladungs-Archivsuche abgeschlossen: '
                    . (int)($state['sessions'] ?? 0) . ' Ladungen an '
                    . (int)($state['foundDays'] ?? 0) . ' Tagen, '
                    . number_format((float)($state['kWh'] ?? 0.0), 2, ',', '.') . ' kWh Ladeanteil.'
                    . ' Verbrauchsvariable #' . (int)($state['varID'] ?? 0) . '.'
                    . ' Roh-Flanken im Archiv: ' . (int)($state['rawEdges'] ?? 0)
                    . ', daraus Roh-Phasen: ' . (int)($state['rawTrackedSessions'] ?? 0)
                    . ', gelesene Rohwerte: ' . (int)($state['rawRows'] ?? 0)
                    . ' an ' . (int)($state['daysWithRawData'] ?? 0) . ' Tagen'
                    . ', größter Roh-Anstieg: ' . number_format(((float)($state['maxRawRiseW'] ?? 0.0)) / 1000.0, 2, ',', '.') . ' kW'
                    . ((int)($state['latestRawEdgeTs'] ?? 0) > 0 ? ' (letzte ' . date('d.m.Y H:i:s', (int)$state['latestRawEdgeTs']) . ')' : '') . '.'
                    . ($latest > 0 ? ' Letzter Fund: ' . date('d.m.Y H:i', $latest) . '.' : '')
                    . ((int)($pattern['samples'] ?? 0) > 0 ? ' Gelerntes Lademuster: ca. ' . number_format((float)($pattern['chargePowerKW'] ?? 0.0), 1, ',', '.') . ' kW Zusatzlast.' : '')
                    . $profileText;
                SetValue($this->GetIDForIdent('EVArchiveSearchStatus'), $done);
                SetValue($this->GetIDForIdent('StatusText'), $done);
                $this->SetActionFeedback($done);
                return;
            }

            $this->WriteAttributeString('EVArchiveSearchStateJSON', json_encode($state));
            $this->SetTimerInterval('EVArchiveSearchWorker', 4000);
        } catch (Throwable $e) {
            $state['active'] = false;
            $state['error'] = $e->getMessage();
            $this->WriteAttributeString('EVArchiveSearchStateJSON', json_encode($state));
            $this->SetTimerInterval('EVArchiveSearchWorker', 0);
            $text = 'Autoladungs-Archivsuche FEHLER: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('EVArchiveSearchStatus'), $text);
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
        }
    }


    public function RebuildConsumptionProfileFromArchive()
    {
        $this->SetActionFeedback('Lastprofil: Archiv wird für die vollständige Neuberechnung vorbereitet ...');
        try {
            $evSearchState = json_decode($this->ReadAttributeString('EVArchiveSearchStateJSON'), true);
            if (is_array($evSearchState) && !empty($evSearchState['active'])) {
                $text = 'Lastprofil-Neuberechnung nicht gestartet: Die Autoladungs-Archivsuche läuft noch.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }

            if (!$this->ReadPropertyBoolean('ConsumptionProfileLearningEnabled')) {
                $text = 'Lastprofil-Neuberechnung nicht gestartet: Verbrauchsprofil-Lernen ist deaktiviert.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }

            $varID = $this->ReadPropertyInteger('HousePowerVariable');
            if ($varID <= 0 || !@IPS_VariableExists($varID)) {
                $text = 'Lastprofil-Neuberechnung nicht gestartet: Hausverbrauchsvariable fehlt.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }

            $archiveID = $this->FindArchive();
            if ($archiveID <= 0) {
                $text = 'Lastprofil-Neuberechnung nicht gestartet: Archiv nicht gefunden.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }

            if (function_exists('AC_GetLoggingStatus') && !@AC_GetLoggingStatus($archiveID, $varID)) {
                $text = 'Lastprofil-Neuberechnung nicht gestartet: Hausverbrauchsvariable ist nicht archiviert.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }

            $firstDay = $this->FindConsumptionArchiveStartDay($archiveID, $varID);
            $lastDay = strtotime('yesterday 00:00:00');
            if ($firstDay <= 0 || $firstDay > $lastDay) {
                $text = 'Lastprofil-Neuberechnung nicht gestartet: keine abgeschlossenen Archivtage gefunden.';
                $this->SetActionFeedback($text);
                echo $text;
                return;
            }

            // Keine synchrone Mehrtages-Auswertung mehr im Button-Aufruf. Der Worker
            // beginnt mit dem jüngsten abgeschlossenen Tag und veröffentlicht schon nach
            // dem ersten gültigen Tag ein Zwischenprofil. Damit bleibt die Oberfläche frei
            // und der Börsenpreis-/PV-Refresh wird nicht durch den Button blockiert.
            $state = [
                'active' => true,
                'archiveID' => $archiveID,
                'varID' => $varID,
                'firstDay' => $firstDay,
                'lastDay' => $lastDay,
                'cursorDay' => $lastDay,
                'direction' => -1,
                'started' => time(),
                'accumulator' => $this->CreateConsumptionAccumulator()
            ];
            $this->WriteAttributeString('ConsumptionArchiveRebuildStateJSON', json_encode($state));
            // Der Archiv-Wiederaufbau darf die normalen Modul-Timer nicht verdrängen.
            // Deshalb bewusst mit Pause zwischen den kurzen Worker-Läufen starten.
            $this->SetTimerInterval('ManualRecalculateWorker', 5000);

            $text = 'Lastprofil-Neuberechnung aus Archiv gestartet: '
                . date('d.m.Y', $firstDay) . ' bis ' . date('d.m.Y', $lastDay)
                . '. Jüngste Archivtage werden zuerst verarbeitet; das erste gültige Zwischenprofil wird automatisch veröffentlicht. Autoladungen werden erkannt und aus dem Grundprofil ausgeschlossen.';
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        } catch (Throwable $e) {
            $this->SetTimerInterval('ManualRecalculateWorker', 0);
            $text = 'Lastprofil-Neuberechnung konnte nicht gestartet werden: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        }
    }

    public function RunConsumptionProfileArchiveRebuild()
    {
        $state = json_decode($this->ReadAttributeString('ConsumptionArchiveRebuildStateJSON'), true);
        if (!is_array($state) || empty($state['active'])) {
            $this->SetTimerInterval('ManualRecalculateWorker', 0);
            return;
        }

        try {
            $archiveID = (int)($state['archiveID'] ?? 0);
            $varID = (int)($state['varID'] ?? 0);
            $cursorDay = (int)($state['cursorDay'] ?? 0);
            $firstDay = (int)($state['firstDay'] ?? 0);
            $lastDay = (int)($state['lastDay'] ?? 0);
            // Alte, bereits laufende v1.10.43-1.10.46-Zustände besitzen noch keine
            // direction. Bereits vorhandener Fortschritt wird unverändert vorwärts
            // weitergeführt. Falls der alte Lauf wegen des Speicherfehlers noch keinen
            // einzigen gültigen Tag geschafft hat, darf er ohne Datenverlust direkt mit
            // dem jüngsten Tag im neuen Verfahren neu ansetzen.
            $acc = is_array($state['accumulator'] ?? null)
                ? $state['accumulator']
                : $this->CreateConsumptionAccumulator();
            if (!isset($state['direction']) && (int)($acc['validDays'] ?? 0) === 0) {
                $direction = -1;
                $cursorDay = $lastDay;
                $state['direction'] = -1;
                $state['cursorDay'] = $cursorDay;
            } else {
                $direction = isset($state['direction']) && (int)$state['direction'] < 0 ? -1 : 1;
            }

            if ($archiveID <= 0 || $varID <= 0 || $cursorDay <= 0 || $firstDay <= 0 || $lastDay <= 0) {
                throw new Exception('ungültiger Wiederaufbau-Zustand');
            }

            // Normale Preis-/PV-/Plan-Aktualisierungen haben immer Vorrang.
            // Wenn gerade ein regulärer Rechenlauf aktiv ist, macht der Archiv-Worker
            // nur Pause und versucht es später erneut.
            if ($this->ReadAttributeInteger('CalculationLockUntil') > time()) {
                $this->SetTimerInterval('ManualRecalculateWorker', 5000);
                return;
            }

            // Pro Worker-Lauf genau einen Tag verarbeiten. Die Tagesauswertung selbst
            // verwendet nur Archiv-Aggregate (Stunde + Minute), keine Rohwert-Vollabfrage.
            // Dadurch bleiben Speicherbedarf und Laufzeit klar begrenzt.
            $day = $this->GetConsumptionDayForProfileLearning($archiveID, $varID, $cursorDay);
            if (is_array($day)) {
                $this->AddConsumptionDayToAccumulator($acc, $cursorDay, $day);
            }
            $cursorDay = strtotime(($direction < 0 ? '-1 day' : '+1 day'), $cursorDay);

            $state['cursorDay'] = $cursorDay;
            $state['accumulator'] = $acc;

            // Bereits während des Archivlaufs ein Zwischenprofil veröffentlichen. Das
            // verhindert, dass die Anzeige bis zum Ende eines langen Archivs auf dem
            // 45-kWh/24-Fallback stehen bleibt.
            if ((int)($acc['validDays'] ?? 0) > 0) {
                $partialModel = $this->FinalizeConsumptionAccumulator($acc);
                $partial = $this->ComposeConsumptionProfileFromModel($partialModel, strtotime('tomorrow 12:00:00'));
                $partial['archiveRebuild'] = true;
                $partial['updated'] = time();
                $partial['source'] = 'Archiv-Neuberechnung läuft – ' . (int)($acc['validDays'] ?? 0) . ' gültige Tage';
                $this->WriteAttributeString('ConsumptionProfileJSON', json_encode($partial));
                $this->WriteAttributeInteger('ConsumptionProfileUpdated', time());
                $this->WriteAttributeString('ConsumptionLearningSource', $partial['source']);
                $chartID = (int)@$this->GetIDForIdent('ConsumptionProfileChartHTML');
                if ($chartID > 0) SetValue($chartID, $this->RenderConsumptionProfileChartHTML($partial));
                $statusID = (int)@$this->GetIDForIdent('ConsumptionLearningStatus');
                if ($statusID > 0) SetValue($statusID, $partial['source']);
            }

            $this->WriteAttributeString('ConsumptionArchiveRebuildStateJSON', json_encode($state));

            $hasMore = $direction < 0 ? ($cursorDay >= $firstDay) : ($cursorDay <= $lastDay);
            if ($hasMore) {
                $totalDays = max(1, (int)floor(($lastDay - $firstDay) / 86400) + 1);
                if ($direction < 0) {
                    $doneDays = max(0, (int)floor(($lastDay - $cursorDay) / 86400));
                } else {
                    $doneDays = max(0, (int)floor(($cursorDay - $firstDay) / 86400));
                }
                $pct = min(99, (int)round(($doneDays / $totalDays) * 100));
                $text = 'Lastprofil Archiv-Neuberechnung: ' . $pct . ' % · '
                    . (int)($acc['validDays'] ?? 0) . ' gültige Tage · '
                    . (int)($acc['evSessions'] ?? 0) . ' Autoladungen erkannt.';
                $this->SetActionFeedback($text);
                $this->SetTimerInterval('ManualRecalculateWorker', 5000);
                return;
            }

            $model = $this->FinalizeConsumptionAccumulator($acc);
            $minimumDays = max(1, $this->ReadPropertyInteger('MinimumValidConsumptionDays'));
            if ((int)($model['validDays'] ?? 0) < $minimumDays) {
                throw new Exception('nur ' . (int)($model['validDays'] ?? 0) . ' gültige Archivtage gefunden');
            }

            $targetTomorrow = strtotime('tomorrow 12:00:00');
            $result = $this->ComposeConsumptionProfileFromModel($model, $targetTomorrow);
            $result['archiveRebuild'] = true;
            $result['updated'] = time();

            $this->WriteAttributeString('ConsumptionProfileJSON', json_encode($result));
            $this->WriteAttributeInteger('ConsumptionProfileUpdated', time());
            $this->WriteAttributeString('ConsumptionLearningSource', (string)$result['source']);

            $state['active'] = false;
            $state['finished'] = time();
            $state['accumulator'] = [];
            $this->WriteAttributeString('ConsumptionArchiveRebuildStateJSON', json_encode($state));
            $this->SetTimerInterval('ManualRecalculateWorker', 0);

            $chartID = (int)@$this->GetIDForIdent('ConsumptionProfileChartHTML');
            if ($chartID > 0) SetValue($chartID, $this->RenderConsumptionProfileChartHTML($result));
            $forecastID = (int)@$this->GetIDForIdent('ConsumptionForecastTomorrow');
            if ($forecastID > 0) SetValue($forecastID, round((float)($result['dailyKWh'] ?? 0.0), 3));
            $statusID = (int)@$this->GetIDForIdent('ConsumptionLearningStatus');
            if ($statusID > 0) SetValue($statusID, (string)$result['source']);

            $text = 'Lastprofil aus Archiv neu berechnet: '
                . (int)($model['validDays'] ?? 0) . ' Tage ausgewertet, '
                . (int)($model['evSessions'] ?? 0) . ' Autoladungen ('
                . number_format((float)($model['evKWh'] ?? 0.0), 2, ',', '.') . ' kWh) aus dem Grundprofil ausgeschlossen.';
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);

            // Wie beim bisherigen manuellen Lernlauf anschließend Prognose und Plan
            // mit dem frisch erzeugten Profil aktualisieren.
            $this->RecalculateInternal(false);
        } catch (Throwable $e) {
            $this->SetTimerInterval('ManualRecalculateWorker', 0);
            $state['active'] = false;
            $state['error'] = $e->getMessage();
            $this->WriteAttributeString('ConsumptionArchiveRebuildStateJSON', json_encode($state));
            $text = 'Lastprofil Archiv-Neuberechnung fehlgeschlagen: ' . $e->getMessage();
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
        }
    }

    public function ResetConsumptionProfile()
    {
        try {
            // Ausschließlich intern gelernte Lastprofilwerte zurücksetzen.
            // Keine IP-Symcon-Archive, Verbrauchswerte oder andere Modulbereiche verändern.
            $this->SetTimerInterval('ManualRecalculateWorker', 0);
            $this->WriteAttributeString('ConsumptionArchiveRebuildStateJSON', '{}');
            $this->WriteAttributeString('ConsumptionProfileJSON', '{}');
            $this->WriteAttributeInteger('ConsumptionProfileUpdated', 0);
            $this->WriteAttributeString('ConsumptionLearningSource', 'Lastprofil manuell zurückgesetzt');

            $fallbackDaily = max(0.0, $this->ReadPropertyFloat('FallbackDailyConsumptionKWh'));
            $fallback = $this->BuildFallbackConsumptionProfile(
                $fallbackDaily,
                'Lastprofil zurückgesetzt – Fallback bis zum nächsten Lernlauf'
            );

            $chartID = (int)@$this->GetIDForIdent('ConsumptionProfileChartHTML');
            if ($chartID > 0) SetValue($chartID, $this->RenderConsumptionProfileChartHTML($fallback));
            $forecastID = (int)@$this->GetIDForIdent('ConsumptionForecastTomorrow');
            if ($forecastID > 0) SetValue($forecastID, round($fallbackDaily, 3));
            $statusID = (int)@$this->GetIDForIdent('ConsumptionLearningStatus');
            if ($statusID > 0) SetValue($statusID, 'Lastprofil manuell zurückgesetzt');

            $text = 'Gelernte Lastprofile zurückgesetzt. Archivierte Verbrauchsdaten wurden nicht verändert.';
            SetValue($this->GetIDForIdent('StatusText'), $text);
            $this->SetActionFeedback($text);
            echo $text;
        } catch (Throwable $e) {
            $text = 'Lastprofil zurücksetzen fehlgeschlagen: ' . $e->getMessage();
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
                    foreach ([$this->PVCalibrationIdent('Expected', $idx), $this->PVCalibrationIdent('Actual', $idx)] as $ident) {
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
                        foreach ([$this->PVCalibrationIdent('Expected', $idxReset), $this->PVCalibrationIdent('Actual', $idxReset)] as $identReset) {
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
        if (!IPS_SemaphoreEnter($lock, 1)) {
            return;
        }
        try {
            $now = time();

            // Aktuellen berechneten Einspeisetarif aus dem geladenen Preisraster
            // fortlaufend in eine eigene, archivierte Variable schreiben. Damit kann
            // die Einspeise-Statistik den realen Erlös auch außerhalb der Automatik
            // zeitgenau aus Energie x Tarif rekonstruieren.
            $this->UpdateCurrentPriceVariable();
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
                $powerW = $this->GetPlannedBatteryPowerW($consumptionProfile, $now);
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

    private function CleanupStaleActiveFeedInState(): void
    {
        $key = $this->ReadAttributeString('ActiveFeedInPlanKey');
        if ($key === '') return;

        $feedInActive = false;
        $feedInVar = (int)@$this->GetIDForIdent('FeedInActive');
        if ($feedInVar > 0) $feedInActive = (bool)GetValue($feedInVar);
        $plannedPower = 0.0;
        $powerVar = (int)@$this->GetIDForIdent('PlannedPower');
        if ($powerVar > 0) $plannedPower = (float)GetValue($powerVar);

        // Während einer echten Einspeisung niemals eingreifen.
        if ($feedInActive || $plannedPower > 1.0) return;

        $startedTs = $this->ReadAttributeInteger('ActiveFeedInStartedTs');
        $lastTs = $this->ReadAttributeInteger('ActiveFeedInLastTs');
        $referenceTs = max($startedTs, $lastTs);

        // Ein frisch gestarteter Lauf kann für wenige Sekunden noch keinen sichtbaren
        // Leistungswert haben. Erst nach 5 Minuten ohne aktive Einspeisung bereinigen.
        if ($referenceTs > 0 && time() - $referenceTs <= 300) return;

        $this->DebugLog('Einspeiseplan', 'Veralteten aktiven Einspeisezustand bereinigt | Key=' . $key);
        $this->WriteAttributeString('ActiveFeedInPlanKey', '');
        $this->WriteAttributeFloat('ActiveFeedInTargetKWh', 0.0);
        $this->WriteAttributeFloat('ActiveFeedInDeliveredKWh', 0.0);
        $this->WriteAttributeInteger('ActiveFeedInLastTs', 0);
        $this->WriteAttributeFloat('ActiveFeedInLastExportW', 0.0);
        $this->WriteAttributeInteger('ActiveFeedInEnergyVariableID', 0);
        $this->WriteAttributeFloat('ActiveFeedInLastEnergyKWh', 0.0);
        $this->WriteAttributeInteger('ActiveFeedInLastAdjustmentTs', 0);
        $this->WriteAttributeInteger('ActiveFeedInPlannedEndTs', 0);
        $this->WriteAttributeInteger('ActiveFeedInStartedTs', 0);
        $this->WriteAttributeFloat('ActiveFeedInPriceCt', 0.0);
        $this->WriteAttributeString('ActiveFeedInReason', '');
        if ($feedInVar > 0) SetValue($feedInVar, false);
        if ($powerVar > 0) SetValue($powerVar, 0.0);
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
        $energyVarID = $this->ReadPropertyInteger('GridExportEnergyVariable');
        if ($energyVarID > 0 && @IPS_VariableExists($energyVarID)) {
            $this->WriteAttributeInteger('ActiveFeedInEnergyVariableID', $energyVarID);
            $this->WriteAttributeFloat('ActiveFeedInLastEnergyKWh', max(0.0, (float)GetValue($energyVarID)));
        } else {
            $this->WriteAttributeInteger('ActiveFeedInEnergyVariableID', 0);
            $this->WriteAttributeFloat('ActiveFeedInLastEnergyKWh', 0.0);
        }
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
        $delivered = max(0.0, $this->ReadAttributeFloat('ActiveFeedInDeliveredKWh'));

        // Wenn eine eigene kumulative Einspeise-Energievariable (kWh) konfiguriert ist,
        // wird die laufende Automatikmenge direkt aus deren Zaehlerdifferenz bestimmt.
        // Damit stammen Statistik und "Tatsaechlich eingespeiste Menge aktuell" aus
        // derselben realen Energiequelle und nicht aus zwei unterschiedlichen Verfahren.
        $energyVarID = $this->ReadPropertyInteger('GridExportEnergyVariable');
        if ($energyVarID > 0 && @IPS_VariableExists($energyVarID)) {
            $currentEnergy = max(0.0, (float)GetValue($energyVarID));
            $lastEnergyVarID = $this->ReadAttributeInteger('ActiveFeedInEnergyVariableID');
            $lastEnergy = max(0.0, $this->ReadAttributeFloat('ActiveFeedInLastEnergyKWh'));

            if ($lastEnergyVarID === $energyVarID && $lastTs > 0) {
                $delta = $currentEnergy - $lastEnergy;
                if ($delta >= 0.0) {
                    $delivered += $delta;
                } else {
                    // Tageszaehler/Zaehlerreset waehrend eines laufenden Fensters:
                    // der neue positive Zaehlerstand ist die seit dem Reset gelieferte Energie.
                    $delivered += $currentEnergy;
                }
            }

            $this->WriteAttributeFloat('ActiveFeedInDeliveredKWh', $delivered);
            $this->WriteAttributeInteger('ActiveFeedInLastTs', $now);
            $this->WriteAttributeInteger('ActiveFeedInEnergyVariableID', $energyVarID);
            $this->WriteAttributeFloat('ActiveFeedInLastEnergyKWh', $currentEnergy);
            // Den Leistungswert parallel aktuell halten, falls die kWh-Variable spaeter
            // waehrend eines Laufes entfernt wird und der Fallback uebernehmen muss.
            try { $this->WriteAttributeFloat('ActiveFeedInLastExportW', $this->ReadCurrentGridExportW()); } catch (Throwable $e) {}
            return $delivered;
        }

        // Fallback ohne kWh-Zaehler: reale Netzleistung zeitlich integrieren.
        $lastW = max(0.0, $this->ReadAttributeFloat('ActiveFeedInLastExportW'));
        $currentW = $this->ReadCurrentGridExportW();
        if ($lastTs > 0 && $now > $lastTs) {
            $seconds = min(180, $now - $lastTs);
            $delivered += (($lastW + $currentW) / 2.0) * ($seconds / 3600.0) / 1000.0;
        }
        $this->WriteAttributeFloat('ActiveFeedInDeliveredKWh', $delivered);
        $this->WriteAttributeInteger('ActiveFeedInLastTs', $now);
        $this->WriteAttributeFloat('ActiveFeedInLastExportW', $currentW);
        $this->WriteAttributeInteger('ActiveFeedInEnergyVariableID', 0);
        $this->WriteAttributeFloat('ActiveFeedInLastEnergyKWh', 0.0);
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

        // Den laufenden Tag in der Statistik sichtbar nachführen, ohne Highcharts bei
        // jedem Messzyklus neu aufzubauen. Maximal einmal pro Minute rendern.
        $lastRender = $this->ReadAttributeInteger('FeedInStatisticsLastRenderTs');
        if ($now - $lastRender >= 60) {
            // Den heutigen Tageswert aus dem Archiv rekonstruieren. So gehen bei
            // Modulupdates, Neustarts oder Timerpausen keine Einspeise-Zeiträume verloren.
            $this->RebuildTodayGridExportFromArchive();
            $statsID = (int)@$this->GetIDForIdent('FeedInStatisticsHTML');
            if ($statsID > 0) SetValue($statsID, $this->RenderFeedInStatisticsHTML());
            $this->WriteAttributeInteger('FeedInStatisticsLastRenderTs', $now);
        }
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

    private function RebuildTodayGridExportFromArchive(): void
    {
        $start = strtotime('today 00:00:00');
        $end = time();
        if ($end <= $start) return;

        $daily = $this->GetGridExportDailyFromArchive($start, $end);
        $day = date('Y-m-d', $start);
        $kWh = max(0.0, (float)($daily[$day] ?? 0.0));

        $days = json_decode($this->ReadAttributeString('GridExportDailyJSON'), true);
        if (!is_array($days)) $days = [];
        if (!isset($days[$day]) || !is_array($days[$day])) $days[$day] = ['kWh' => 0.0, 'eur' => 0.0];
        $days[$day]['kWh'] = $kWh;
        $this->WriteAttributeString('GridExportDailyJSON', json_encode($days));
    }

    private function GetGridExportDailyFromArchive(int $startTs, int $endTs): array
    {
        // Falls eine eigene kumulative Einspeise-Energievariable (kWh) konfiguriert ist,
        // ist sie die maßgebliche Quelle der Statistik. Die zeitliche Integration der
        // Netzleistungsvariable bleibt ausschließlich als Fallback erhalten.
        $energyVarID = $this->ReadPropertyInteger('GridExportEnergyVariable');
        if ($energyVarID > 0 && @IPS_VariableExists($energyVarID)) {
            return $this->GetGridExportDailyFromEnergyArchive($startTs, $endTs, $energyVarID);
        }
        return $this->GetGridExportDailyFromPowerArchive($startTs, $endTs);
    }

    private function GetGridExportDailyFromPowerArchive(int $startTs, int $endTs): array
    {
        $archiveID = $this->FindArchive();
        $varID = $this->ReadPropertyInteger('PVCalibrationFeedInVariable');
        if ($archiveID <= 0 || $varID <= 0 || !@IPS_VariableExists($varID) || $endTs <= $startTs) return [];

        $values = @AC_GetLoggedValues($archiveID, $varID, $startTs, $endTs, 0);
        if (!is_array($values) || count($values) === 0) return [];
        $values = array_reverse($values);

        $prev = @AC_GetLoggedValues($archiveID, $varID, 0, $startTs - 1, 1);
        if (is_array($prev) && count($prev) > 0) {
            array_unshift($values, ['TimeStamp' => $startTs, 'Value' => $prev[0]['Value']]);
        } elseif ((int)$values[0]['TimeStamp'] > $startTs) {
            array_unshift($values, ['TimeStamp' => $startTs, 'Value' => $values[0]['Value']]);
        }

        $invert = $this->ReadPropertyBoolean('PVCalibrationFeedInInvert');
        $dailyWh = [];
        $count = count($values);
        for ($i = 0; $i < $count; $i++) {
            $segStart = max($startTs, (int)$values[$i]['TimeStamp']);
            $nextTs = ($i + 1 < $count) ? (int)$values[$i + 1]['TimeStamp'] : $endTs;
            $segEnd = min($endTs, $nextTs);
            if ($segEnd <= $segStart) continue;

            $raw1 = (float)$values[$i]['Value'];
            $exportW1 = max(0.0, $invert ? -$raw1 : $raw1);
            $exportW2 = $exportW1;
            if ($i + 1 < $count) {
                $raw2 = (float)$values[$i + 1]['Value'];
                $exportW2 = max(0.0, $invert ? -$raw2 : $raw2);
            }

            // Archivluecken duerfen nicht mehr so behandelt werden, als haette die
            // letzte Leistung beliebig lange unveraendert angelegen. Das war die
            // Hauptursache fuer unrealistisch hohe berechnete Tages-kWh. Wie bei der
            // Live-Messung werden maximal 180 s ohne neuen Messpunkt fortgeschrieben.
            $trustedEnd = min($segEnd, $segStart + 180);
            if ($trustedEnd <= $segStart) continue;
            $trustedSeconds = $trustedEnd - $segStart;
            $fullSeconds = max(1, $nextTs - (int)$values[$i]['TimeStamp']);
            $fraction = min(1.0, $trustedSeconds / $fullSeconds);
            $endW = $exportW1 + ($exportW2 - $exportW1) * $fraction;
            $avgW = max(0.0, ($exportW1 + $endW) / 2.0);
            if ($avgW <= 0.0) continue;

            // Segmente ueber Mitternacht sauber auf die einzelnen Kalendertage verteilen.
            $cursor = $segStart;
            while ($cursor < $trustedEnd) {
                $nextMidnight = strtotime('tomorrow 00:00:00', $cursor);
                $pieceEnd = min($trustedEnd, $nextMidnight);
                $day = date('Y-m-d', $cursor);
                if (!isset($dailyWh[$day])) $dailyWh[$day] = 0.0;
                $dailyWh[$day] += $avgW * (($pieceEnd - $cursor) / 3600.0);
                $cursor = $pieceEnd;
            }
        }

        $result = [];
        foreach ($dailyWh as $day => $wh) $result[$day] = max(0.0, $wh / 1000.0);
        return $result;
    }

    private function GetGridExportDailyFromEnergyArchive(int $startTs, int $endTs, int $varID): array
    {
        $archiveID = $this->FindArchive();
        if ($archiveID <= 0 || $varID <= 0 || !@IPS_VariableExists($varID) || $endTs <= $startTs) return [];

        $effectiveEnd = min($endTs, time());
        if ($effectiveEnd <= $startTs) return [];

        $values = @AC_GetLoggedValues($archiveID, $varID, $startTs, $effectiveEnd, 0);
        if (!is_array($values)) $values = [];
        $values = array_reverse($values);

        // Für einen kumulativen kWh-Zähler benötigen wir den letzten Stand vor dem
        // Auswertezeitraum als Basis. Ohne diesen Wert beginnt die Auswertung beim
        // ersten vorhandenen Archivpunkt.
        $prev = @AC_GetLoggedValues($archiveID, $varID, 0, $startTs - 1, 1);
        if (is_array($prev) && count($prev) > 0) {
            array_unshift($values, ['TimeStamp' => $startTs, 'Value' => (float)$prev[0]['Value']]);
        } elseif (count($values) > 0 && (int)$values[0]['TimeStamp'] > $startTs) {
            array_unshift($values, ['TimeStamp' => $startTs, 'Value' => (float)$values[0]['Value']]);
        }

        // Für den laufenden Tag den aktuellen Zählerstand ergänzen, falls der letzte
        // Archivpunkt älter ist. Historische Zeiträume werden nicht mit dem heutigen
        // Livewert vermischt.
        if ($effectiveEnd >= time() - 5 && @IPS_VariableExists($varID)) {
            $current = (float)GetValue($varID);
            $lastTs = count($values) > 0 ? (int)$values[count($values)-1]['TimeStamp'] : 0;
            if ($lastTs < $effectiveEnd) $values[] = ['TimeStamp' => $effectiveEnd, 'Value' => $current];
        }

        if (count($values) < 2) return [];

        $daily = [];
        for ($i = 1; $i < count($values); $i++) {
            $t1 = max($startTs, (int)$values[$i-1]['TimeStamp']);
            $t2 = min($effectiveEnd, (int)$values[$i]['TimeStamp']);
            if ($t2 <= $t1) continue;

            $v1 = (float)$values[$i-1]['Value'];
            $v2 = (float)$values[$i]['Value'];
            $delta = $v2 - $v1;

            if ($delta < 0.0) {
                // Zählerreset (z. B. Tageszähler): negativer Sprung wird nicht als
                // negative Einspeisung gewertet. Der neue positive Zählerstand gehört
                // zum Tag des neuen Messpunkts.
                $resetKWh = max(0.0, $v2);
                if ($resetKWh > 0.0) {
                    $day = date('Y-m-d', $t2);
                    $daily[$day] = ($daily[$day] ?? 0.0) + $resetKWh;
                }
                continue;
            }
            if ($delta <= 0.0) continue;

            // Wenn zwei Zählerstände eine Mitternacht überspannen, wird die positive
            // Differenz proportional zur Zeit auf die betroffenen Kalendertage verteilt.
            $duration = $t2 - $t1;
            $cursor = $t1;
            while ($cursor < $t2) {
                $nextMidnight = strtotime('tomorrow 00:00:00', $cursor);
                $pieceEnd = min($t2, $nextMidnight);
                $ratio = ($pieceEnd - $cursor) / $duration;
                $day = date('Y-m-d', $cursor);
                $daily[$day] = ($daily[$day] ?? 0.0) + ($delta * $ratio);
                $cursor = $pieceEnd;
            }
        }

        foreach ($daily as $day => $kWh) $daily[$day] = max(0.0, (float)$kWh);
        return $daily;
    }

    private function GetGridExportRevenueDailyFromArchive(int $startTs, int $endTs): array
    {
        // Eine exakte zeitliche Erlösberechnung ist mit dem kumulativen Einspeise-kWh-
        // Zähler möglich. Ohne diese Variable bleibt für Alt-/Fallback-Fälle weiterhin
        // der bisherige GridExportDailyJSON-Erlös verfügbar.
        $archiveID = $this->FindArchive();
        $energyVarID = $this->ReadPropertyInteger('GridExportEnergyVariable');
        $priceVarID = (int)@$this->GetIDForIdent('CurrentPrice');
        if ($archiveID <= 0 || $energyVarID <= 0 || !@IPS_VariableExists($energyVarID) || $priceVarID <= 0 || $endTs <= $startTs) return [];

        $effectiveEnd = min($endTs, time());
        if ($effectiveEnd <= $startTs) return [];

        // Preis-Zeitreihe aus dem Archiv lesen. Zusätzlich werden die aktuell geladenen
        // Preis-Slots verwendet; dadurch kann der laufende Tag bereits unmittelbar nach
        // einem Update korrekt bewertet werden, auch wenn noch kein Stundenwechsel im
        // Preisarchiv stattgefunden hat.
        $pricePoints = [];
        $prevPrice = @AC_GetLoggedValues($archiveID, $priceVarID, 0, $startTs - 1, 1);
        if (is_array($prevPrice) && count($prevPrice) > 0) {
            $pricePoints[$startTs] = (float)$prevPrice[0]['Value'];
        }
        $loggedPrices = @AC_GetLoggedValues($archiveID, $priceVarID, $startTs, $effectiveEnd, 0);
        if (is_array($loggedPrices)) {
            foreach (array_reverse($loggedPrices) as $row) {
                $ts = (int)($row['TimeStamp'] ?? 0);
                if ($ts >= $startTs && $ts <= $effectiveEnd) $pricePoints[$ts] = (float)($row['Value'] ?? 0.0);
            }
        }
        $cachedPrices = json_decode($this->ReadAttributeString('PricesJSON'), true);
        if (is_array($cachedPrices)) {
            foreach ($cachedPrices as $p) {
                $ps = (int)($p['start'] ?? 0); $pe = (int)($p['end'] ?? 0);
                if ($pe <= $startTs || $ps >= $effectiveEnd || $pe <= $ps) continue;
                $pricePoints[max($startTs, $ps)] = (float)($p['priceCt'] ?? 0.0);
            }
        }
        if (count($pricePoints) === 0) return [];
        ksort($pricePoints);

        $energyValues = @AC_GetLoggedValues($archiveID, $energyVarID, $startTs, $effectiveEnd, 0);
        if (!is_array($energyValues)) $energyValues = [];
        $energyValues = array_reverse($energyValues);
        $prevEnergy = @AC_GetLoggedValues($archiveID, $energyVarID, 0, $startTs - 1, 1);
        if (is_array($prevEnergy) && count($prevEnergy) > 0) {
            array_unshift($energyValues, ['TimeStamp'=>$startTs, 'Value'=>(float)$prevEnergy[0]['Value']]);
        } elseif (count($energyValues) > 0 && (int)$energyValues[0]['TimeStamp'] > $startTs) {
            array_unshift($energyValues, ['TimeStamp'=>$startTs, 'Value'=>(float)$energyValues[0]['Value']]);
        }
        if ($effectiveEnd >= time() - 5 && @IPS_VariableExists($energyVarID)) {
            $lastTs = count($energyValues) > 0 ? (int)$energyValues[count($energyValues)-1]['TimeStamp'] : 0;
            if ($lastTs < $effectiveEnd) $energyValues[] = ['TimeStamp'=>$effectiveEnd, 'Value'=>(float)GetValue($energyVarID)];
        }
        if (count($energyValues) < 2) return [];

        $priceAt = static function(int $ts) use ($pricePoints): ?float {
            $found = null;
            foreach ($pricePoints as $pts => $price) {
                if ((int)$pts > $ts) break;
                $found = (float)$price;
            }
            return $found;
        };
        $priceChangeTs = array_map('intval', array_keys($pricePoints));
        $daily = [];

        for ($i = 1; $i < count($energyValues); $i++) {
            $t1 = max($startTs, (int)$energyValues[$i-1]['TimeStamp']);
            $t2 = min($effectiveEnd, (int)$energyValues[$i]['TimeStamp']);
            if ($t2 <= $t1) continue;
            $v1 = (float)$energyValues[$i-1]['Value'];
            $v2 = (float)$energyValues[$i]['Value'];
            $delta = $v2 - $v1;

            if ($delta < 0.0) {
                // Tageszähler-/Zählerreset: analog zur kWh-Statistik wird der neue
                // positive Stand dem Zeitpunkt nach dem Reset zugerechnet.
                $resetKWh = max(0.0, $v2);
                if ($resetKWh <= 0.0) continue;
                $price = $priceAt($t2);
                $day = date('Y-m-d', $t2);
                if (!isset($daily[$day])) $daily[$day] = ['kWh'=>0.0, 'pricedKWh'=>0.0, 'eur'=>0.0];
                $daily[$day]['kWh'] += $resetKWh;
                if ($price !== null) {
                    $daily[$day]['pricedKWh'] += $resetKWh;
                    $daily[$day]['eur'] += $resetKWh * $price / 100.0;
                }
                continue;
            }
            if ($delta <= 0.0) continue;

            $duration = $t2 - $t1;
            $breaks = [$t1, $t2];
            foreach ($priceChangeTs as $pts) if ($pts > $t1 && $pts < $t2) $breaks[] = $pts;
            $cursor = $t1;
            while ($cursor < $t2) {
                $midnight = strtotime('tomorrow 00:00:00', $cursor);
                if ($midnight > $t1 && $midnight < $t2) $breaks[] = $midnight;
                $cursor = min($t2, $midnight);
            }
            $breaks = array_values(array_unique(array_map('intval', $breaks)));
            sort($breaks);
            for ($b = 0; $b < count($breaks)-1; $b++) {
                $pieceStart = $breaks[$b]; $pieceEnd = $breaks[$b+1];
                if ($pieceEnd <= $pieceStart) continue;
                $pieceKWh = $delta * (($pieceEnd - $pieceStart) / $duration);
                if ($pieceKWh <= 0.0) continue;
                $day = date('Y-m-d', $pieceStart);
                if (!isset($daily[$day])) $daily[$day] = ['kWh'=>0.0, 'pricedKWh'=>0.0, 'eur'=>0.0];
                $daily[$day]['kWh'] += $pieceKWh;
                $price = $priceAt($pieceStart);
                if ($price !== null) {
                    $daily[$day]['pricedKWh'] += $pieceKWh;
                    $daily[$day]['eur'] += $pieceKWh * $price / 100.0;
                }
            }
        }
        return $daily;
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
            $this->StoreFeedInStatisticArchive($delivered, $delivered*$priceCt/100.0, $target, $startedTs, time());
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

    private function FetchPVForecast(bool $forceProviders = false): array
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
        $openMeteoCache = json_decode($this->ReadAttributeString('OpenMeteoSurfaceCacheJSON'), true);
        if (!is_array($openMeteoCache)) $openMeteoCache = [];

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
                $openMeteoHours = null;
                $openMeteoFromCache = false;
                $cacheSignature = sha1(json_encode([
                    'lat'=>round($lat,6),'lon'=>round($lon,6),'tilt'=>round($tilt,2),'azimuth'=>round($azimuth,2),
                    'kwp'=>round($kwp,4),'eff'=>round($this->ReadPropertyFloat('SystemEfficiency'),5),
                    'manual'=>round($manualFactor,5),'global'=>round($this->ReadPropertyFloat('GlobalPVFactor'),5)
                ]));
                $cachedSurface = $openMeteoCache[$key] ?? null;
                $cacheAge = is_array($cachedSurface) ? (time() - (int)($cachedSurface['savedAt'] ?? 0)) : PHP_INT_MAX;
                if (!$forceProviders && is_array($cachedSurface) && ($cachedSurface['signature'] ?? '') === $cacheSignature && $cacheAge >= 0 && $cacheAge < 3600 && is_array($cachedSurface['hours'] ?? null)) {
                    $openMeteoHours = $cachedSurface['hours'];
                    $openMeteoFromCache = true;
                    $this->DebugLog('Open-Meteo', $name . ' | Cache ' . round($cacheAge / 60, 1) . ' min | kein API-Aufruf');
                } else {
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
                    $openMeteoHours = [];
                    $openMeteoTimezone = new DateTimeZone('Europe/Vienna');
                    foreach ($data['hourly']['time'] as $i => $timeStr) {
                        $dt = DateTimeImmutable::createFromFormat('!Y-m-d\TH:i', (string)$timeStr, $openMeteoTimezone);
                        if ($dt === false) $dt = new DateTimeImmutable((string)$timeStr, $openMeteoTimezone);
                        $ts = $dt->getTimestamp() - 3600;
                        $gti = max(0.0, (float)$data['hourly']['global_tilted_irradiance'][$i]);
                        $openMeteoHours[(int)$ts] = $kwp * ($gti / 1000.0) * $this->ReadPropertyFloat('SystemEfficiency') * $manualFactor * $this->ReadPropertyFloat('GlobalPVFactor');
                    }
                    $openMeteoCache[$key] = ['savedAt'=>time(),'signature'=>$cacheSignature,'hours'=>$openMeteoHours];
                }

                $sum = 0.0;
                foreach (($openMeteoHours ?? []) as $tsRaw => $basePowerKWRaw) {
                    $ts = (int)$tsRaw;
                    $basePowerKW = max(0.0, (float)$basePowerKWRaw);
                    $powerKW = $basePowerKW;
                    if (!isset($sourceHours['openmeteo'][$ts])) $sourceHours['openmeteo'][$ts] = 0.0;
                    $sourceHours['openmeteo'][$ts] += $powerKW;
                    if (!isset($surfaceSourceHours['openmeteo'][$name])) $surfaceSourceHours['openmeteo'][$name] = [];
                    $surfaceSourceHours['openmeteo'][$name][$ts] = $powerKW;
                    if ($ts === $nowHour) $currentExpectedBaseW = $basePowerKW * 1000.0;
                    if (date('Y-m-d', $ts) === date('Y-m-d', strtotime('tomorrow'))) $sum += $powerKW;
                }
                $surfaceTotalsBySource['openmeteo'][$name] = $sum;
                $this->DebugLog('Open-Meteo', $name . ' | morgen=' . round($sum, 3) . ' kWh | kWp=' . $kwp . ' | Azimut=' . $azimuth . ' | Neigung=' . $tilt . ' | ' . ($openMeteoFromCache ? 'Cache' : 'Live'));
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

                    // Erfolgreiche Forecast.Solar-Flächendaten bis zu 60 Minuten wiederverwenden.
                    // Force-Refresh umgeht diesen Cache weiterhin bewusst.
                    if (!$forceProviders && is_array($cachedSurface) && $cacheAge >= 0 && $cacheAge < 3600 && is_array($cachedSurface['hours'] ?? null)) {
                        $fsHours = $cachedSurface['hours'];
                        $fromCache = true;
                        $this->DebugLog('Forecast.Solar', $name . ' | Cache ' . round($cacheAge / 60, 1) . ' min | kein API-Aufruf');
                    } elseif (!$forceProviders && $retryAfterTs > time()) {
                        if (is_array($cachedSurface) && is_array($cachedSurface['hours'] ?? null)) {
                            $fsHours = $cachedSurface['hours'];
                            $fromCache = true;
                            $this->DebugLog('Forecast.Solar', $name . ' | Rate-Limit bis ' . date('H:i:s', $retryAfterTs) . ' | Cache verwendet');
                        } else {
                            throw new Exception('Forecast.Solar Rate-Limit aktiv bis ' . date('d.m.Y H:i:s', $retryAfterTs) . '; kein Flächen-Cache vorhanden.');
                        }
                    } else {
                        $this->ForecastDiagnosticStep('Forecast.Solar START | ' . $name);
                            $fsHours = $this->FetchForecastSolarSurface($lat, $lon, $tilt, $azimuth, $kwp, $name);
                            $this->ForecastDiagnosticStep('Forecast.Solar ENDE | ' . $name);
                    }
                    // Den Cache-Zeitstempel nur nach einem echten Live-Abruf erneuern.
                    // Beim Lesen aus dem Cache muss savedAt unverändert bleiben, sonst
                    // wird der Eintrag bei jedem Rechenlauf künstlich wieder "frisch".
                    if (!$fromCache && is_array($fsHours)) {
                        $forecastSolarCache[$key] = [
                            'savedAt' => time(),
                            'name' => $name,
                            'kwp' => $kwp,
                            'tilt' => $tilt,
                            'azimuth' => $azimuth,
                            'hours' => $fsHours
                        ];
                    }
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

        if ($useOpenMeteo) {
            $this->WriteAttributeString('OpenMeteoSurfaceCacheJSON', json_encode($openMeteoCache));
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
                    $sourceHours['pvnode'] = $forceProviders ? $this->GetPVNodeForecastForced($pvnodeKey, $pvnodeSiteID) : $this->GetPVNodeForecastLimited($pvnodeKey, $pvnodeSiteID);

                    // pvnode V2 kann mit include=strings die einzelnen, in der Site
                    // konfigurierten Solarflächen liefern. Diese werden positionsstabil den
                    // aktiven SBO-PV-Flächen zugeordnet. Nur bei eindeutiger 1:1-Anzahl wird
                    // die Flächenprognose verwendet; eine künstliche kWp-Verteilung findet
                    // ausdrücklich nicht statt.
                    $pvnodeCache = json_decode($this->ReadAttributeString('PVNodeForecastCacheJSON'), true);
                    $pvnodeStringHoursByID = is_array($pvnodeCache['stringHoursByID'] ?? null) ? $pvnodeCache['stringHoursByID'] : [];
                    $pvnodeStringHoursByIndex = is_array($pvnodeCache['stringHours'] ?? null) ? $pvnodeCache['stringHours'] : [];
                    $pvnodeStringIDsByIndex = is_array($pvnodeCache['stringIDsByIndex'] ?? null) ? $pvnodeCache['stringIDsByIndex'] : [];
                    ksort($pvnodeStringHoursByIndex, SORT_NUMERIC);

                    $activeSurfaces = [];
                    foreach ($surfaces as $pvIdx => $pvSurface) {
                        if (empty($pvSurface['Active'])) continue;
                        $pvName = trim((string)($pvSurface['Name'] ?? 'PV'));
                        if ($pvName === '') $pvName = 'PV ' . ($pvIdx + 1);
                        $activeSurfaces[] = [
                            'name' => $pvName,
                            // Historischer Property-Name bleibt aus Kompatibilitätsgründen bestehen.
                            // Der konfigurierte Wert ist ab v1.9.97 ausdrücklich pvnode string_index.
                            'stringIndex' => trim((string)($pvSurface['PVNodeStringID'] ?? ''))
                        ];
                    }

                    foreach ($activeSurfaces as $pvPos => $pvSurfaceInfo) {
                        $pvName = $pvSurfaceInfo['name'];
                        $configuredIndexRaw = $pvSurfaceInfo['stringIndex'];
                        $selectedHours = [];
                        $selectedLabel = '';

                        // Die Konfiguration verwendet direkt den von pvnode gelieferten
                        // numerischen string_index (z. B. 0=Haus, 1=Nebengebäude).
                        // Ist kein Index eingetragen, wird weiterhin die Position der
                        // aktiven SBO-Fläche als abwärtskompatibler Fallback verwendet.
                        $selectedIndex = $configuredIndexRaw !== '' && preg_match('/^\\d+$/', $configuredIndexRaw)
                            ? (int)$configuredIndexRaw
                            : $pvPos;

                        if (isset($pvnodeStringHoursByIndex[$selectedIndex]) && is_array($pvnodeStringHoursByIndex[$selectedIndex])) {
                            $selectedHours = $pvnodeStringHoursByIndex[$selectedIndex];
                            $stringID = (string)($pvnodeStringIDsByIndex[$selectedIndex] ?? '');
                            $selectedLabel = 'Index ' . $selectedIndex . ($stringID !== '' ? ' · ' . $stringID : '');
                        } else {
                            $this->DebugLog('pvnode', 'PV-Fläche ' . $pvName . ': string_index ' . $selectedIndex . ' wurde in der API-Antwort nicht gefunden.', 0);
                            continue;
                        }

                        if (count($selectedHours) === 0) continue;
                        $surfaceSourceHours['pvnode'][$pvName] = [];
                        $tomorrowSurface = 0.0;
                        foreach ($selectedHours as $pvTs => $pvKWh) {
                            $value = max(0.0, (float)$pvKWh);
                            $surfaceSourceHours['pvnode'][$pvName][(int)$pvTs] = $value;
                            if (date('Y-m-d', (int)$pvTs) === date('Y-m-d', strtotime('tomorrow'))) $tomorrowSurface += $value;
                        }
                        $surfaceTotalsBySource['pvnode'][$pvName] = $tomorrowSurface;
                        $this->DebugLog('pvnode', 'Fläche ' . $pvName . ' -> ' . $selectedLabel . ' | morgen=' . number_format($tomorrowSurface, 2, ',', '.') . ' kWh');
                    }
                    $this->DebugLog('pvnode', 'Prognose bereit | Site-ID=' . $pvnodeSiteID . ' | Stunden=' . count($sourceHours['pvnode']));
                } catch (Throwable $e) {
                    $this->WriteAttributeString('PVNodeLastError', $e->getMessage());
                    $this->DebugLog('pvnode', $e->getMessage(), 0);
                }
            }
        }

        $this->WriteAttributeString('PVCalibrationJSON', json_encode($calibration));

        // Forecast.Solar-Plausibilitätsprüfung: liefert die Quelle für morgen
        // praktisch 0 kWh, während mindestens eine andere aktive Quelle klar positive
        // Energie prognostiziert, darf Forecast.Solar für diesen Prognosetag nicht in
        // die Gewichtung eingehen. Die Quelle bleibt konfiguriert und wird beim nächsten
        // Abruf automatisch wieder berücksichtigt, sobald plausible Daten vorliegen.
        if ($useForecastSolar && count($sourceHours['forecastsolar']) > 0) {
            $tomorrowKey = date('Y-m-d', strtotime('tomorrow'));
            $sumTomorrow = static function(array $hours) use ($tomorrowKey): float {
                $sum = 0.0;
                foreach ($hours as $ts => $value) {
                    if (date('Y-m-d', (int)$ts) === $tomorrowKey) $sum += max(0.0, (float)$value);
                }
                return $sum;
            };
            $fsTomorrow = $sumTomorrow($sourceHours['forecastsolar']);
            $otherTomorrow = 0.0;
            if ($useOpenMeteo && count($sourceHours['openmeteo']) > 0) $otherTomorrow = max($otherTomorrow, $sumTomorrow($sourceHours['openmeteo']));
            if ($usePVNode && count($sourceHours['pvnode']) > 0) $otherTomorrow = max($otherTomorrow, $sumTomorrow($sourceHours['pvnode']));
            if ($fsTomorrow <= 0.01 && $otherTomorrow > 0.5) {
                $sourceHours['forecastsolar'] = [];
                $forecastSolarSurfaceStatus[] = 'Forecast.Solar verworfen: morgen 0,00 kWh unplausibel, andere Quelle liefert ' . number_format($otherTomorrow, 2, ',', '.') . ' kWh.';
                $this->SetActionFeedback('Prognose: Forecast.Solar verworfen – morgen 0,00 kWh unplausibel.');
                $this->DebugLog('Forecast.Solar', 'Für morgen verworfen: 0,00 kWh bei gleichzeitig ' . round($otherTomorrow, 3) . ' kWh aus anderer Quelle.', 0);
            }
        }

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
            $stringHoursByID = is_array($result['stringHoursByID'] ?? null) ? $result['stringHoursByID'] : [];
            $stringIDsByIndex = is_array($result['stringIDsByIndex'] ?? null) ? $result['stringIDsByIndex'] : [];
            $next = (int)$result['nextPollTs'];
            $this->WriteAttributeString('PVNodeForecastCacheJSON', json_encode([
                'siteID' => $siteID,
                'fetchedAt' => $now,
                'hours' => $hours,
                'stringHours' => $stringHours,
                'stringHoursByID' => $stringHoursByID,
                'stringIDsByIndex' => $stringIDsByIndex
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

    private function GetPVNodeForecastForced(string $apiKey, string $siteID): array
    {
        $this->DebugLog('pvnode', 'FORCE-LIVE | manueller Anbieterabruf unabhängig von Modul-Cache/Tageslimit');
        $result = $this->FetchPVNodeForecastLive($apiKey, $siteID);
        $hours = is_array($result['hours'] ?? null) ? $result['hours'] : [];
        $stringHours = is_array($result['stringHours'] ?? null) ? $result['stringHours'] : [];
        $stringHoursByID = is_array($result['stringHoursByID'] ?? null) ? $result['stringHoursByID'] : [];
        $stringIDsByIndex = is_array($result['stringIDsByIndex'] ?? null) ? $result['stringIDsByIndex'] : [];
        $next = (int)($result['nextPollTs'] ?? 0);
        $this->WriteAttributeString('PVNodeForecastCacheJSON', json_encode([
            'siteID' => $siteID,
            'fetchedAt' => time(),
            'hours' => $hours,
            'stringHours' => $stringHours,
            'stringHoursByID' => $stringHoursByID,
            'stringIDsByIndex' => $stringIDsByIndex
        ]));
        if ($next > 0) $this->WriteAttributeInteger('PVNodeNextPollTs', $next);
        $this->WriteAttributeInteger('PVNodeConsecutiveRejects', 0);
        $this->WriteAttributeString('PVNodeLastError', '');
        return $hours;
    }

    public function ForceRefreshForecastProviders(): string
    {
        $this->SetActionFeedback('Prognoseanbieter: erzwungener Live-Abruf läuft ...');
        try {
            $this->RecalculateInternal(true, true);
            $status = (string)GetValue($this->GetIDForIdent('StatusText'));
            $msg = 'Alle aktivierten Prognoseanbieter wurden ohne interne Cache-/Abruflimits neu angefordert und die Prognose wurde aktualisiert. ' . $status;
            $this->SetActionFeedback($msg);
            return $msg;
        } catch (Throwable $e) {
            $msg = 'Force-Refresh Prognoseanbieter FEHLER: ' . $e->getMessage();
            $this->SetActionFeedback($msg);
            return $msg;
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
            'User-Agent: IP-Symcon-SmartBatteryOptimizer/1.9.89',
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

        // pvnode kann bei include=strings die Gesamtserie in values[] ohne pv_power
        // liefern. Deshalb werden die String-Zeitreihen unabhängig davon ausgewertet.
        // Jeder 15-Minuten-pv_power-Wert ist Leistung in W; vier Viertelstunden
        // ergeben pro voller Stunde Energie: Summe(W) / 1000 * 0,25 = kWh.
        $stringQuarterValuesByID = [];
        $stringIndexByID = [];
        $stringIDsByIndex = [];
        if (isset($data['strings']) && is_array($data['strings'])) {
            foreach ($data['strings'] as $row) {
                if (!is_array($row) || !isset($row['timestamp'], $row['pv_power'], $row['string_index'])) continue;
                $ts = strtotime((string)$row['timestamp']);
                if ($ts === false) continue;
                $idx = (int)$row['string_index'];
                $sid = trim((string)($row['string_id'] ?? ('index_' . $idx)));
                if ($sid === '') $sid = 'index_' . $idx;
                $hourTs = strtotime(date('Y-m-d H:00:00', $ts));
                if (!isset($stringQuarterValuesByID[$sid])) $stringQuarterValuesByID[$sid] = [];
                if (!isset($stringQuarterValuesByID[$sid][$hourTs])) $stringQuarterValuesByID[$sid][$hourTs] = [];
                $stringQuarterValuesByID[$sid][$hourTs][] = max(0.0, (float)$row['pv_power']);
                $stringIndexByID[$sid] = $idx;
                $stringIDsByIndex[$idx] = $sid;
            }
        }

        $stringHoursByID = [];
        foreach ($stringQuarterValuesByID as $sid => $byHour) {
            foreach ($byHour as $hourTs => $watts) {
                if (count($watts) === 0) continue;
                // Energie der tatsächlich gelieferten 15-Minuten-Intervalle in kWh.
                $stringHoursByID[$sid][(int)$hourTs] = array_sum($watts) / 1000.0 * 0.25;
            }
            ksort($stringHoursByID[$sid]);
        }
        ksort($stringIDsByIndex, SORT_NUMERIC);

        // Kompatibilitätsansicht nach string_index für vorhandene Caches/Installationen.
        $stringHours = [];
        foreach ($stringHoursByID as $sid => $byHour) {
            $idx = (int)($stringIndexByID[$sid] ?? 0);
            $stringHours[$idx] = $byHour;
        }
        ksort($stringHours, SORT_NUMERIC);

        // Standortgesamt: wenn values[].pv_power vorhanden ist, direkt integrieren.
        // Fehlt es (wie in der realen API-Antwort mit include=strings), werden die
        // getrennten String-Energien je Stunde addiert.
        $quarterValues = [];
        foreach ($data['values'] as $row) {
            if (!is_array($row) || !isset($row['timestamp'], $row['pv_power'])) continue;
            $ts = strtotime((string)$row['timestamp']);
            if ($ts === false) continue;
            $hourTs = strtotime(date('Y-m-d H:00:00', $ts));
            if (!isset($quarterValues[$hourTs])) $quarterValues[$hourTs] = [];
            $quarterValues[$hourTs][] = max(0.0, (float)$row['pv_power']);
        }
        $hours = [];
        foreach ($quarterValues as $hourTs => $watts) {
            if (count($watts) === 0) continue;
            $hours[(int)$hourTs] = array_sum($watts) / 1000.0 * 0.25;
        }
        if (count($hours) === 0 && count($stringHoursByID) > 0) {
            foreach ($stringHoursByID as $byHour) {
                foreach ($byHour as $hourTs => $kWh) {
                    if (!isset($hours[(int)$hourTs])) $hours[(int)$hourTs] = 0.0;
                    $hours[(int)$hourTs] += max(0.0, (float)$kWh);
                }
            }
        }
        ksort($hours);
        if (count($hours) === 0) throw new Exception('pvnode: Keine verwertbaren PV-Leistungswerte erhalten.');

        // Plausibilitätsprüfung gegen pvnode daily[].pv_energy_kwh; nur Diagnose,
        // die API-Tageswerte ersetzen die Zeitreihe nicht.
        if (isset($data['daily']) && is_array($data['daily'])) {
            foreach ($data['daily'] as $dayRow) {
                if (!is_array($dayRow) || !isset($dayRow['date'], $dayRow['pv_energy_kwh'])) continue;
                $sum = 0.0;
                foreach ($hours as $hourTs => $kWh) if (date('Y-m-d', (int)$hourTs) === (string)$dayRow['date']) $sum += (float)$kWh;
                $apiDaily = (float)$dayRow['pv_energy_kwh'];
                $this->DebugLog('pvnode', 'Tagescheck ' . $dayRow['date'] . ': Strings=' . number_format($sum, 2, ',', '.') . ' kWh | API daily=' . number_format($apiDaily, 2, ',', '.') . ' kWh');
            }
        }

        $nextPollRaw = $data['next_poll_at'] ?? ($data['meta']['next_poll_at'] ?? ($data['metadata']['next_poll_at'] ?? null));
        $nextPollTs = 0;
        if (is_numeric($nextPollRaw)) {
            $n = (int)$nextPollRaw;
            $nextPollTs = $n > 20000000000 ? (int)floor($n / 1000) : $n;
        } elseif (is_string($nextPollRaw) && trim($nextPollRaw) !== '') {
            $parsed = strtotime($nextPollRaw);
            if ($parsed !== false) $nextPollTs = $parsed;
        }

        return ['hours' => $hours, 'stringHours' => $stringHours, 'stringHoursByID' => $stringHoursByID, 'stringIDsByIndex' => $stringIDsByIndex, 'nextPollTs' => $nextPollTs];
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
        $provider = $this->ReadPropertyInteger('PriceProvider');
        $this->DebugLog('Preise', 'Preisquelle/Tarif Modus=' . $provider);
        if ($provider === 2) return $this->FetchCustomJSONPrices();

        $signature = sha1(json_encode([
            'provider'=>$provider,
            'positive'=>$this->ReadPropertyFloat('PositivePriceFactor'),
            'negative'=>$this->ReadPropertyFloat('NegativePriceFactor'),
            'adjustment'=>$this->ReadPropertyFloat('PriceAdjustmentCt')
        ]));
        $updated = $this->ReadAttributeInteger('PriceCacheUpdatedTs');
        $cached = json_decode($this->ReadAttributeString('PricesJSON'), true);
        if ($updated > 0 && (time() - $updated) >= 0 && (time() - $updated) < 3600 && $this->ReadAttributeString('PriceCacheSignature') === $signature && is_array($cached) && count($cached) > 0) {
            $this->DebugLog('Preise', 'Cache ' . round((time() - $updated) / 60, 1) . ' min | kein externer API-Aufruf');
            return $cached;
        }

        switch ($provider) {
            case 1: $prices = $this->FetchEPEXHourlyPrices(1); break;
            case 3: $prices = $this->FetchEPEXHourlyPrices(3); break;
            case 0:
            default: $prices = $this->FetchEPEXHourlyPrices(0); break;
        }
        $this->WriteAttributeInteger('PriceCacheUpdatedTs', time());
        $this->WriteAttributeString('PriceCacheSignature', $signature);
        return $prices;
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

        // $available ist die für die NETZEINSPEISUNG freigegebene Energiemenge.
        // Der erwartete Eigenverbrauch reduziert nicht diese Sollmenge, sondern nur die
        // tatsächlich erreichbare Netzleistung. Dadurch verlängert sich die notwendige
        // Laufzeit, bis die geplanten Netz-kWh erreicht sind.
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
            $expectedLoadW = $this->GetExpectedLoadPowerW($consumptionProfile, $slotStart);
            $expectedExportKW = $this->GetExpectedGridExportPowerW($consumptionProfile, $slotStart) / 1000.0;
            if ($expectedExportKW <= 0.001 || $batteryPowerW <= 0.0) continue;

            // Ziel bleibt Netz-kWh. Der Eigenverbrauch wirkt ausschließlich auf die
            // Netzleistung und damit auf die erforderliche Zeit.
            $energy = min($remaining, $slotRemaining, $expectedExportKW * $durationH);
            $requiredSeconds = (int)ceil(($energy / $expectedExportKW) * 3600.0);
            $actualEnd = min($p['end'], $slotStart + max(1, $requiredSeconds));
            $key = $p['start'] . ':' . $p['end'];

            $selected[] = [
                'start' => $slotStart,
                'priceIntervalStart' => $p['start'],
                'end' => $actualEnd,
                'priceIntervalEnd' => $p['end'],
                'planKey' => $key,
                'priceCt' => $p['priceCt'],
                'marketCt' => $p['marketCt'],
                'energyKWh' => $energy,
                'gridTargetW' => $this->GetConfiguredGridFeedInTargetW(),
                'powerW' => $batteryPowerW,
                'expectedGridExportW' => $expectedExportKW * 1000.0,
                'expectedLoadW' => $expectedLoadW,
                'reason' => 'price'
            ];
            $usedKeys[$key] = true;
            $revenue += $energy * $p['priceCt'] / 100.0;
            $remaining = max(0.0, $remaining - $energy);
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
                $expectedLoadW = $this->GetExpectedLoadPowerW($consumptionProfile, $slotStart);
                $expectedExportKW = $this->GetExpectedGridExportPowerW($consumptionProfile, $slotStart) / 1000.0;
                if ($expectedExportKW <= 0.001 || $batteryPowerW <= 0.0) continue;

                $energy = min($remaining, $mandatoryMissing, $slotRemaining, $expectedExportKW * $durationH);
                if ($energy <= 0.00001) continue;
                $actualEnd = min($p['end'], $slotStart + max(1, (int)ceil(($energy / $expectedExportKW) * 3600.0)));
                $selected[] = [
                    'start' => $slotStart,
                    'priceIntervalStart' => $p['start'],
                    'end' => $actualEnd,
                    'priceIntervalEnd' => $p['end'],
                    'priceCt' => $p['priceCt'],
                    'marketCt' => $p['marketCt'],
                    'energyKWh' => $energy,
                    'gridTargetW' => $this->GetConfiguredGridFeedInTargetW(),
                    'powerW' => $batteryPowerW,
                    'expectedGridExportW' => $expectedExportKW * 1000.0,
                    'expectedLoadW' => $expectedLoadW,
                    'reason' => 'pv_space_required'
                ];
                $revenue += $energy * $p['priceCt'] / 100.0;
                $remaining = max(0.0, $remaining - $energy);
                $scheduledEnergy += $energy;
                $mandatoryMissing = max(0.0, $mandatoryMissing - $energy);
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
            // Für Anzeige und spätere Zusammenfassung genau einen Stundenabschnitt
            // mit der tatsächlich geplanten Lage innerhalb dieser Stunde speichern.
            $first['segments'] = [[
                'start' => $packedStart,
                'end' => $packedEnd,
                'priceIntervalStart' => $hourStart,
                'priceIntervalEnd' => $hourEnd,
                'energyKWh' => $energy,
                'gridTargetW' => (float)($first['gridTargetW'] ?? $this->GetConfiguredGridFeedInTargetW()),
                'powerW' => (float)$first['powerW'],
                'expectedGridExportW' => (float)$first['expectedGridExportW'],
                'expectedLoadW' => (float)($first['expectedLoadW'] ?? 0.0),
                'priceCt' => (float)$first['priceCt'],
                'reason' => (string)($first['reason'] ?? 'price')
            ]];
            $packedSelected[] = $first;
        }
        $selected = $packedSelected;
        usort($selected, fn($a, $b) => $a['start'] <=> $b['start']);

        // Direkt aneinander anschließende ausgewählte Preisstunden bilden einen einzigen
        // verbindlichen Einspeisevorgang. Stundenwechsel erzeugen keinen STOP/START mehr.
        $continuous=[];
        foreach($selected as $slot){
            if(empty($continuous)){$continuous[]=$slot;continue;}
            $li=count($continuous)-1;$prev=$continuous[$li];
            $prevIntervalEnd=(int)($prev['priceIntervalEnd']??$prev['end']);
            $slotIntervalStart=(int)($slot['priceIntervalStart']??$slot['start']);
            if($slotIntervalStart<=$prevIntervalEnd+1 && (int)$slot['start']<=$prevIntervalEnd+1){
                $e1=max(0.0,(float)($prev['energyKWh']??0.0));$e2=max(0.0,(float)($slot['energyKWh']??0.0));$te=$e1+$e2;
                $prev['priceCt']=$te>0.0?(($e1*(float)($prev['priceCt']??0.0)+$e2*(float)($slot['priceCt']??0.0))/$te):0.0;
                $prev['energyKWh']=$te;
                $prev['end']=max((int)$prev['end'],(int)$slot['end']);$prev['priceIntervalEnd']=max($prevIntervalEnd,(int)($slot['priceIntervalEnd']??$slot['end']));
                $prev['powerW']=max((float)($prev['powerW']??0.0),(float)($slot['powerW']??0.0));$duration=max(1,(int)$prev['end']-(int)$prev['start']);$prev['expectedGridExportW']=($te/($duration/3600.0))*1000.0;
                $prev['segments']=array_merge(is_array($prev['segments']??null)?$prev['segments']:[],is_array($slot['segments']??null)?$slot['segments']:[]);
                $prev['planKey']=(int)($prev['priceIntervalStart']??$prev['start']).':'.(int)$prev['priceIntervalEnd'];$continuous[$li]=$prev;
            }else{$continuous[]=$slot;}
        }
        $selected=$continuous;

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

        // Ein bereits gewähltes Preisfenster bleibt verbindlich. Die darin geplante
        // Energiemenge darf jedoch nicht dauerhaft von der aktuell freigegebenen
        // Einspeisemenge abweichen. Kleine Prognoseänderungen bis +/-10 % werden bewusst
        // toleriert, damit der Plan nicht bei jedem Rechenlauf geringfügig verändert wird.
        $plannedEnergyKWh = array_sum(array_map(static fn($x) => max(0.0, (float)($x['energyKWh'] ?? 0.0)), $committed));
        $releasedEnergyKWh = max(0.0, (float)($newPlan['availableKWh'] ?? 0.0));
        $lowerToleranceKWh = $releasedEnergyKWh * 0.90;
        $upperToleranceKWh = $releasedEnergyKWh * 1.10;
        $energyAdjusted = false;

        if ($plannedEnergyKWh < $lowerToleranceKWh - 0.001 || $plannedEnergyKWh > $upperToleranceKWh + 0.001) {
            $targetEnergyKWh = $releasedEnergyKWh;
            $remainingTargetKWh = $targetEnergyKWh;
            $adjusted = [];

            foreach ($committed as $slot) {
                if ($remainingTargetKWh <= 0.001) break;

                $start = max($now, (int)($slot['start'] ?? 0));
                $intervalEnd = (int)($slot['priceIntervalEnd'] ?? ($slot['end'] ?? 0));
                if ($intervalEnd <= $start) continue;

                $expectedGridExportW = max(0.0, (float)($slot['expectedGridExportW'] ?? 0.0));
                if ($expectedGridExportW <= 1.0) {
                    $duration = max(1, (int)($slot['end'] ?? $intervalEnd) - (int)($slot['start'] ?? $start));
                    $oldEnergy = max(0.0, (float)($slot['energyKWh'] ?? 0.0));
                    if ($oldEnergy > 0.0) $expectedGridExportW = ($oldEnergy / ($duration / 3600.0)) * 1000.0;
                }
                if ($expectedGridExportW <= 1.0) continue;

                $capacityKWh = ($expectedGridExportW / 1000.0) * (($intervalEnd - $start) / 3600.0);
                $slotEnergyKWh = min($remainingTargetKWh, max(0.0, $capacityKWh));
                if ($slotEnergyKWh <= 0.001) continue;

                $requiredSeconds = max(1, (int)ceil(($slotEnergyKWh / ($expectedGridExportW / 1000.0)) * 3600.0));
                $slot['start'] = $start;
                $slot['end'] = min($intervalEnd, $start + $requiredSeconds);
                $slot['energyKWh'] = $slotEnergyKWh;
                $slot['expectedGridExportW'] = $expectedGridExportW;
                $slot['segments'] = [[
                    'start' => $slot['start'],
                    'end' => $slot['end'],
                    'priceIntervalStart' => (int)($slot['priceIntervalStart'] ?? $slot['start']),
                    'priceIntervalEnd' => $intervalEnd,
                    'energyKWh' => $slotEnergyKWh,
                    'gridTargetW' => (float)($slot['gridTargetW'] ?? $this->GetConfiguredGridFeedInTargetW()),
                    'powerW' => (float)($slot['powerW'] ?? 0.0),
                    'expectedGridExportW' => $expectedGridExportW,
                    'expectedLoadW' => (float)($slot['expectedLoadW'] ?? 0.0),
                    'priceCt' => (float)($slot['priceCt'] ?? 0.0),
                    'reason' => (string)($slot['reason'] ?? 'price')
                ]];
                $adjusted[] = $slot;
                $remainingTargetKWh = max(0.0, $remainingTargetKWh - $slotEnergyKWh);
            }

            $committed = $adjusted;
            $energyAdjusted = true;
            $adjustedTotalKWh = array_sum(array_map(static fn($x) => max(0.0, (float)($x['energyKWh'] ?? 0.0)), $committed));
            $this->DebugLog(
                'Einspeiseplan',
                'Verbindliche Planmenge angepasst | alt=' . round($plannedEnergyKWh, 3) . ' kWh'
                . ' | aktuell freigegeben=' . round($releasedEnergyKWh, 3) . ' kWh'
                . ' | Toleranz=' . round($lowerToleranceKWh, 3) . '-' . round($upperToleranceKWh, 3) . ' kWh'
                . ' | neu=' . round($adjustedTotalKWh, 3) . ' kWh'
            );

            // Kann innerhalb des bereits verbindlichen Fensters nicht die komplette
            // aktuelle Freigabemenge untergebracht werden, bleibt die physikalisch
            // mögliche Menge bestehen; ein neues Preisfenster wird nicht erzwungen.
            if ($remainingTargetKWh > 0.001) {
                $this->DebugLog('Einspeiseplan', 'Verbindliches Fenster kann ' . round($remainingTargetKWh, 3) . ' kWh der aktuellen Freigabe nicht mehr aufnehmen');
            }
        } else {
            // Innerhalb der +/-10-%-Toleranz bleibt der komplette bereits gewählte
            // Einspeiseplan unverändert: Preisfenster, Laufzeit und Energiemenge.
            // Die Toleranz dient bewusst dazu, kleine Prognoseänderungen nicht
            // ständig in einen neuen Zielwert umzusetzen.
        }

        if (empty($committed)) {
            $newPlan['slots'] = [];
            $newPlan['nextWindow'] = '-';
            $newPlan['highestPriceCt'] = 0.0;
            $newPlan['expectedRevenueEUR'] = 0.0;
            $newPlan['status'] = 'Verbindlicher Einspeiseplan aktiv – aktuell keine Einspeisemenge freigegeben';
            return $newPlan;
        }

        $newPlan['slots'] = $committed;
        $newPlan['nextWindow'] = date('d.m. H:i', (int)$committed[0]['start']) . '–' . date('H:i', (int)$committed[0]['end']);
        $newPlan['highestPriceCt'] = max(array_map(static fn($x) => (float)($x['priceCt'] ?? 0.0), $committed));
        $newPlan['expectedRevenueEUR'] = array_sum(array_map(static fn($x) => (float)($x['energyKWh'] ?? 0.0) * (float)($x['priceCt'] ?? 0.0) / 100.0, $committed));
        $newPlan['status'] = $energyAdjusted
            ? 'Verbindlicher Einspeiseplan aktiv – Energiemenge wegen >10 % Abweichung an aktuelle Freigabe angepasst'
            : 'Verbindlicher Einspeiseplan aktiv – geplante Menge innerhalb +/-10 % Toleranz';
        if (!$energyAdjusted) {
            $this->DebugLog(
                'Einspeiseplan',
                'Verbindlichen bestehenden Plan beibehalten | geplant=' . round($plannedEnergyKWh, 3) . ' kWh'
                . ' | aktuell freigegeben=' . round($releasedEnergyKWh, 3) . ' kWh'
                . ' | Toleranz=' . round($lowerToleranceKWh, 3) . '-' . round($upperToleranceKWh, 3) . ' kWh'
            );
        }
        return $newPlan;
    }

    private function EstimateConsumptionEnergyBetween(array $consumptionProfile, int $fromTs, int $toTs): float
    {
        if ($toTs <= $fromTs) return 0.0;
        $energy = 0.0;
        $cursor = $fromTs;
        while ($cursor < $toTs) {
            $hourStart = strtotime(date('Y-m-d H:00:00', $cursor));
            $hourEnd = $hourStart + 3600;
            $segmentEnd = min($toTs, $hourEnd);
            $fraction = max(0, $segmentEnd - $cursor) / 3600.0;
            $hourly = $this->GetConsumptionForecastHourlyForTimestamp($consumptionProfile, $cursor, true);
            $hour = max(0, min(23, (int)date('G', $cursor)));
            $energy += max(0.0, (float)($hourly[$hour] ?? 0.0)) * $fraction;
            $cursor = $segmentEnd;
        }
        return $energy;
    }

    private function GetExpectedLoadPowerW(array $consumptionProfile, int $timestamp): float
    {
        $hourly = $this->GetConsumptionForecastHourlyForTimestamp($consumptionProfile, $timestamp, true);
        $hour = max(0, min(23, (int)date('G', $timestamp)));
        // kWh pro Stunde entspricht der mittleren Leistung in kW für diese Stunde.
        return max(0.0, (float)($hourly[$hour] ?? 0.0)) * 1000.0;
    }

    private function GetConfiguredGridFeedInTargetW(): float
    {
        // Das Netz-Ziel stammt aus "Maximale Netzeinspeisung". Der separate
        // Sicherheitsabstand gehoert ausschliesslich zum PV-/Netzlimit-Schutz und
        // wird fuer die naechtliche Preis-Einspeisung NICHT abgezogen.
        return max(0.0, (float)$this->GetRuntimeInteger(
            'RuntimeGridFeedInLimitW',
            $this->ReadPropertyInteger('GridFeedInLimitW')
        ));
    }

    private function GetPlannedBatteryPowerW(array $consumptionProfile, int $timestamp): float
    {
        // Dispatch-Regel fuer die naechtliche Preis-Einspeisung:
        // Der AlphaESS-Dispatch darf weder das konfigurierte Netz-Ziel noch die
        // physische Max. Einspeise-/Entladeleistung ueberschreiten. Das Lastprofil
        // wird NICHT auf den Dispatch aufgeschlagen.
        $maxBatteryW = max(0.0, (float)$this->ReadPropertyInteger('MaxDischargePowerW'));
        $gridTargetW = $this->GetConfiguredGridFeedInTargetW();
        if ($maxBatteryW <= 0.0 || $gridTargetW <= 0.0) return 0.0;
        return min($gridTargetW, $maxBatteryW);
    }

    private function GetExpectedGridExportPowerW(array $consumptionProfile, int $timestamp): float
    {
        // Fuer die Mengen-/Dauerberechnung gilt:
        // Solange Netz-Ziel + erwartete Last innerhalb der WR-Maximalleistung liegen,
        // bleibt die rechnerische Netzeinspeisung beim Netz-Ziel. Erst wenn die Summe
        // die WR-Grenze ueberschreitet, reduziert die erwartete Last die erreichbare
        // Netzeinspeisung.
        // Beispiele bei WR max. 20 kW:
        //   Ziel 10 kW + Last 5 kW => 10 kW rechnerische Netzeinspeisung.
        //   Ziel 20 kW + Last 5 kW => 15 kW rechnerische Netzeinspeisung.
        $maxBatteryW = max(0.0, (float)$this->ReadPropertyInteger('MaxDischargePowerW'));
        $gridTargetW = $this->GetConfiguredGridFeedInTargetW();
        if ($maxBatteryW <= 0.0 || $gridTargetW <= 0.0) return 0.0;
        $loadW = $this->GetExpectedLoadPowerW($consumptionProfile, $timestamp);
        return max(0.0, min($gridTargetW, $maxBatteryW - $loadW));
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

        // Ein vorhandenes saisonales Modell kann ohne neuen Archivlauf jederzeit auf
        // den Zieltag projiziert werden. Dadurch bleibt der 7-Tage-/Saisonbezug auch
        // beim Tageswechsel korrekt.
        if (!$force
            && is_array($cached)
            && isset($cached['seasonalModel'])
            && is_array($cached['seasonalModel'])
            && $updated > time() - 6 * 3600
        ) {
            $result = $this->ComposeConsumptionProfileFromModel(
                $cached['seasonalModel'],
                strtotime('tomorrow 12:00:00')
            );
            $result['updated'] = $updated;
            $result['archiveRebuild'] = !empty($cached['archiveRebuild']);
            $this->WriteAttributeString('ConsumptionLearningSource', (string)($result['source'] ?? 'Archiv gelernt'));
            return $result;
        }

        // Alte v1-Profile ohne 7-Tage-/Saisonmodell bleiben als Fallback erhalten,
        // bis genügend neue Archivtage gelesen werden konnten.
        $legacyCached = null;
        if (is_array($cached) && isset($cached['hourlyKWh']) && is_array($cached['hourlyKWh']) && count($cached['hourlyKWh']) === 24) {
            $legacyCached = $cached;
        }

        // Während einer expliziten Archiv-Neuberechnung liest der reguläre Refresh
        // niemals parallel erneut dutzende Archivtage. Er verwendet das zuletzt
        // veröffentlichte Profil (oder den Fallback), während ausschließlich der
        // Worker den Archivfortschritt übernimmt.
        $rebuildState = json_decode($this->ReadAttributeString('ConsumptionArchiveRebuildStateJSON'), true);
        if (!$force && is_array($rebuildState) && !empty($rebuildState['active'])) {
            if ($legacyCached !== null) {
                $this->WriteAttributeString('ConsumptionLearningSource', (string)($legacyCached['source'] ?? 'Archiv-Neuberechnung läuft'));
                return $legacyCached;
            }
            return $this->BuildFallbackConsumptionProfile($fallbackDaily, 'Archiv-Neuberechnung läuft – Fallback bis zum ersten gültigen Archivtag');
        }

        $varID = $this->ReadPropertyInteger('HousePowerVariable');
        if ($varID <= 0 || !@IPS_VariableExists($varID)) {
            return $legacyCached ?? $this->BuildFallbackConsumptionProfile($fallbackDaily, 'Fallback – Hausverbrauchsvariable fehlt');
        }

        $archiveID = $this->FindArchive();
        if ($archiveID <= 0) {
            return $legacyCached ?? $this->BuildFallbackConsumptionProfile($fallbackDaily, 'Fallback – Archiv nicht gefunden');
        }

        if (function_exists('AC_GetLoggingStatus')) {
            try {
                if (!AC_GetLoggingStatus($archiveID, $varID)) {
                    return $legacyCached ?? $this->BuildFallbackConsumptionProfile($fallbackDaily, 'Fallback – Hausverbrauch nicht archiviert');
                }
            } catch (Throwable $e) {
                $this->DebugLog('ConsumptionProfile', 'Logging-Status konnte nicht geprüft werden: ' . $e->getMessage(), 0);
            }
        }

        $days = max(3, min(90, $this->ReadPropertyInteger('LearningDays')));
        $acc = $this->CreateConsumptionAccumulator();

        for ($age = 1; $age <= $days; $age++) {
            $dayStart = strtotime('-' . $age . ' days 00:00:00');
            $day = $this->GetConsumptionDayForProfileLearning($archiveID, $varID, $dayStart);
            if (!is_array($day)) continue;
            $this->AddConsumptionDayToAccumulator($acc, $dayStart, $day);
        }

        $minimumConsumptionDays = max(1, min($days, $this->ReadPropertyInteger('MinimumValidConsumptionDays')));
        if ((int)($acc['validDays'] ?? 0) < $minimumConsumptionDays) {
            if ($legacyCached !== null) {
                $source = 'Letztes Verbrauchsprofil – nur ' . (int)($acc['validDays'] ?? 0) . '/' . $minimumConsumptionDays . ' gültige Tage';
                $legacyCached['source'] = $source;
                $this->WriteAttributeString('ConsumptionLearningSource', $source);
                return $legacyCached;
            }
            return $this->BuildFallbackConsumptionProfile(
                $fallbackDaily,
                'Fallback – nur ' . (int)($acc['validDays'] ?? 0) . '/' . $minimumConsumptionDays . ' gültige Verbrauchstage'
            );
        }

        $recentModel = $this->FinalizeConsumptionAccumulator($acc);
        $baseModel = (
            is_array($cached)
            && isset($cached['seasonalModel'])
            && is_array($cached['seasonalModel'])
        ) ? $cached['seasonalModel'] : [];

        // Der normale Lernlauf berechnet die zuletzt vorhandenen Archivtage jedes Mal
        // deterministisch neu und ersetzt nur Saison/Wochentag-Slots, für die im
        // aktuellen Lernfenster tatsächlich Daten vorhanden sind. Andere Jahreszeiten
        // aus einer früheren Archiv-Neuberechnung bleiben erhalten.
        $model = $this->MergeConsumptionSeasonalModels($baseModel, $recentModel);
        $result = $this->ComposeConsumptionProfileFromModel($model, strtotime('tomorrow 12:00:00'));
        $result['updated'] = time();
        $result['archiveRebuild'] = !empty($cached['archiveRebuild']);

        $this->WriteAttributeString('ConsumptionProfileJSON', json_encode($result));
        $this->WriteAttributeInteger('ConsumptionProfileUpdated', time());
        $this->WriteAttributeString('ConsumptionLearningSource', (string)$result['source']);
        $this->DebugLog(
            'ConsumptionProfile',
            (string)$result['source']
            . ', Prognose ' . round((float)$result['dailyKWh'], 3) . ' kWh'
            . ', Sonderlasten ' . (int)($model['evSessions'] ?? 0),
            0
        );
        return $result;
    }

    private function CreateConsumptionAccumulator(): array
    {
        $seasons = ['winter', 'spring', 'summer', 'autumn'];
        $sum = [];
        $weight = [];
        $slotWeight = [];
        foreach ($seasons as $season) {
            $sum[$season] = [];
            $weight[$season] = [];
            $slotWeight[$season] = [];
            for ($weekday = 1; $weekday <= 7; $weekday++) {
                $key = (string)$weekday;
                $sum[$season][$key] = array_fill(0, 24, 0.0);
                $weight[$season][$key] = array_fill(0, 24, 0.0);
                $slotWeight[$season][$key] = 0.0;
            }
        }

        return [
            'sum' => $sum,
            'weight' => $weight,
            'slotWeight' => $slotWeight,
            'globalSum' => array_fill(0, 24, 0.0),
            'globalWeight' => array_fill(0, 24, 0.0),
            'validDays' => 0,
            'evSessions' => 0,
            'evKWh' => 0.0,
            'archiveFrom' => 0,
            'archiveTo' => 0
        ];
    }

    private function AddConsumptionDayToAccumulator(array &$acc, int $dayStart, array $day): void
    {
        $hourly = isset($day['hourlyKWh']) && is_array($day['hourlyKWh'])
            ? array_values($day['hourlyKWh'])
            : [];
        if (count($hourly) !== 24) return;

        $daily = array_sum($hourly);
        if ($daily <= 0.1 || !is_finite($daily)) return;

        $weekday = (string)max(1, min(7, (int)date('N', $dayStart)));
        $seasonWeights = $this->GetConsumptionSeasonWeights($dayStart + 12 * 3600);

        // Neuere Vergleichstage erhalten mehr Gewicht; ältere Archivjahre wirken
        // weiterhin mit, dominieren aber heutige Verbrauchsgewohnheiten nicht.
        $ageDays = max(0.0, (time() - ($dayStart + 12 * 3600)) / 86400.0);
        $recencyWeight = max(0.15, pow(0.5, $ageDays / 365.0));

        for ($h = 0; $h < 24; $h++) {
            $v = max(0.0, (float)($hourly[$h] ?? 0.0));
            $acc['globalSum'][$h] = (float)($acc['globalSum'][$h] ?? 0.0) + $v * $recencyWeight;
            $acc['globalWeight'][$h] = (float)($acc['globalWeight'][$h] ?? 0.0) + $recencyWeight;
        }

        foreach ($seasonWeights as $season => $seasonWeight) {
            $w = $recencyWeight * max(0.0, (float)$seasonWeight);
            if ($w <= 0.000001) continue;
            if (!isset($acc['sum'][$season][$weekday])) continue;
            for ($h = 0; $h < 24; $h++) {
                $v = max(0.0, (float)($hourly[$h] ?? 0.0));
                $acc['sum'][$season][$weekday][$h] =
                    (float)$acc['sum'][$season][$weekday][$h] + $v * $w;
                $acc['weight'][$season][$weekday][$h] =
                    (float)$acc['weight'][$season][$weekday][$h] + $w;
            }
            $acc['slotWeight'][$season][$weekday] =
                (float)$acc['slotWeight'][$season][$weekday] + $w;
        }

        $acc['validDays'] = (int)($acc['validDays'] ?? 0) + 1;
        $acc['evSessions'] = (int)($acc['evSessions'] ?? 0) + (int)($day['evSessions'] ?? 0);
        $acc['evKWh'] = (float)($acc['evKWh'] ?? 0.0) + (float)($day['evKWh'] ?? 0.0);
        $acc['archiveFrom'] = ((int)($acc['archiveFrom'] ?? 0) <= 0)
            ? $dayStart
            : min((int)$acc['archiveFrom'], $dayStart);
        $acc['archiveTo'] = max((int)($acc['archiveTo'] ?? 0), $dayStart);
    }

    private function FinalizeConsumptionAccumulator(array $acc): array
    {
        $seasons = ['winter', 'spring', 'summer', 'autumn'];
        $profiles = [];
        $slotWeights = [];
        foreach ($seasons as $season) {
            $profiles[$season] = [];
            $slotWeights[$season] = [];
            for ($weekday = 1; $weekday <= 7; $weekday++) {
                $key = (string)$weekday;
                $hourly = [];
                $hasAny = false;
                for ($h = 0; $h < 24; $h++) {
                    $w = (float)($acc['weight'][$season][$key][$h] ?? 0.0);
                    if ($w > 0.000001) {
                        $hourly[$h] = max(0.0, (float)$acc['sum'][$season][$key][$h] / $w);
                        $hasAny = true;
                    } else {
                        $hourly[$h] = 0.0;
                    }
                }
                if ($hasAny) $profiles[$season][$key] = $hourly;
                $slotWeights[$season][$key] = (float)($acc['slotWeight'][$season][$key] ?? 0.0);
            }
        }

        $global = [];
        for ($h = 0; $h < 24; $h++) {
            $w = (float)($acc['globalWeight'][$h] ?? 0.0);
            $global[$h] = $w > 0.000001
                ? max(0.0, (float)$acc['globalSum'][$h] / $w)
                : 0.0;
        }

        return [
            'version' => 2,
            'profiles' => $profiles,
            'slotWeights' => $slotWeights,
            'globalHourlyKWh' => $global,
            'validDays' => (int)($acc['validDays'] ?? 0),
            'evSessions' => (int)($acc['evSessions'] ?? 0),
            'evKWh' => max(0.0, (float)($acc['evKWh'] ?? 0.0)),
            'archiveFrom' => (int)($acc['archiveFrom'] ?? 0),
            'archiveTo' => (int)($acc['archiveTo'] ?? 0),
            'modelUpdated' => time()
        ];
    }

    private function MergeConsumptionSeasonalModels(array $base, array $recent): array
    {
        if (empty($base['profiles']) || !is_array($base['profiles'])) return $recent;
        if (empty($recent['profiles']) || !is_array($recent['profiles'])) return $base;

        $merged = $base;
        $seasons = ['winter', 'spring', 'summer', 'autumn'];
        foreach ($seasons as $season) {
            if (!isset($merged['profiles'][$season]) || !is_array($merged['profiles'][$season])) {
                $merged['profiles'][$season] = [];
            }
            if (!isset($merged['slotWeights'][$season]) || !is_array($merged['slotWeights'][$season])) {
                $merged['slotWeights'][$season] = [];
            }
            for ($weekday = 1; $weekday <= 7; $weekday++) {
                $key = (string)$weekday;
                $recentWeight = (float)($recent['slotWeights'][$season][$key] ?? 0.0);
                // Mindestens ungefähr ein gewichteter Vergleichstag muss vorhanden sein,
                // bevor ein bestehender Saison/Wochentag-Slot ersetzt wird.
                if ($recentWeight >= 0.75
                    && isset($recent['profiles'][$season][$key])
                    && is_array($recent['profiles'][$season][$key])
                    && count($recent['profiles'][$season][$key]) === 24
                ) {
                    $merged['profiles'][$season][$key] = array_values($recent['profiles'][$season][$key]);
                    $merged['slotWeights'][$season][$key] = $recentWeight;
                }
            }
        }

        $oldGlobal = is_array($base['globalHourlyKWh'] ?? null)
            ? array_values($base['globalHourlyKWh'])
            : array_fill(0, 24, 0.0);
        $newGlobal = is_array($recent['globalHourlyKWh'] ?? null)
            ? array_values($recent['globalHourlyKWh'])
            : array_fill(0, 24, 0.0);
        $mergedGlobal = [];
        for ($h = 0; $h < 24; $h++) {
            $oldV = max(0.0, (float)($oldGlobal[$h] ?? 0.0));
            $newV = max(0.0, (float)($newGlobal[$h] ?? 0.0));
            if ($oldV > 0.0 && $newV > 0.0) {
                $mergedGlobal[$h] = $oldV * 0.30 + $newV * 0.70;
            } else {
                $mergedGlobal[$h] = max($oldV, $newV);
            }
        }
        $merged['globalHourlyKWh'] = $mergedGlobal;

        // Die vollständige Archivbasis bleibt als Metadatum erhalten; der normale
        // Lernlauf ergänzt nur die Information über das aktuelle Lernfenster.
        $merged['recentValidDays'] = (int)($recent['validDays'] ?? 0);
        $merged['recentEvSessions'] = (int)($recent['evSessions'] ?? 0);
        $merged['recentEvKWh'] = (float)($recent['evKWh'] ?? 0.0);
        $merged['validDays'] = max((int)($base['validDays'] ?? 0), (int)($recent['validDays'] ?? 0));
        $merged['evSessions'] = max((int)($base['evSessions'] ?? 0), (int)($recent['evSessions'] ?? 0));
        $merged['evKWh'] = max((float)($base['evKWh'] ?? 0.0), (float)($recent['evKWh'] ?? 0.0));
        if ((int)($base['archiveFrom'] ?? 0) > 0) {
            $merged['archiveFrom'] = (int)$base['archiveFrom'];
        } else {
            $merged['archiveFrom'] = (int)($recent['archiveFrom'] ?? 0);
        }
        $merged['archiveTo'] = max((int)($base['archiveTo'] ?? 0), (int)($recent['archiveTo'] ?? 0));
        $merged['modelUpdated'] = time();
        $merged['version'] = 2;
        return $merged;
    }

    private function GetConsumptionSeasonWeights(int $timestamp): array
    {
        $year = (int)date('Y', $timestamp);
        $anchors = [
            ['name' => 'autumn', 'ts' => strtotime(($year - 1) . '-10-15 12:00:00')],
            ['name' => 'winter', 'ts' => strtotime($year . '-01-15 12:00:00')],
            ['name' => 'spring', 'ts' => strtotime($year . '-04-15 12:00:00')],
            ['name' => 'summer', 'ts' => strtotime($year . '-07-15 12:00:00')],
            ['name' => 'autumn', 'ts' => strtotime($year . '-10-15 12:00:00')],
            ['name' => 'winter', 'ts' => strtotime(($year + 1) . '-01-15 12:00:00')]
        ];

        $left = $anchors[0];
        $right = $anchors[1];
        for ($i = 0; $i < count($anchors) - 1; $i++) {
            if ($timestamp >= (int)$anchors[$i]['ts'] && $timestamp <= (int)$anchors[$i + 1]['ts']) {
                $left = $anchors[$i];
                $right = $anchors[$i + 1];
                break;
            }
        }

        $span = max(1, (int)$right['ts'] - (int)$left['ts']);
        $fraction = max(0.0, min(1.0, ($timestamp - (int)$left['ts']) / $span));

        // Cosinus-Interpolation: an den Saison-Stützpunkten ist die Steigung null.
        // Dadurch entstehen keine harten Sprünge im Lastprofil.
        $smooth = 0.5 - 0.5 * cos(M_PI * $fraction);
        $weights = [
            (string)$left['name'] => max(0.0, 1.0 - $smooth),
            (string)$right['name'] => max(0.0, $smooth)
        ];

        // Falls bei einer theoretischen Randkonstellation beide Namen gleich wären.
        if ((string)$left['name'] === (string)$right['name']) {
            return [(string)$left['name'] => 1.0];
        }
        return $weights;
    }

    private function ComposeConsumptionProfileFromModel(array $model, int $targetTimestamp): array
    {
        $weekday = max(1, min(7, (int)date('N', $targetTimestamp)));
        $weekdayKey = (string)$weekday;
        $seasonWeights = $this->GetConsumptionSeasonWeights($targetTimestamp);

        $global = is_array($model['globalHourlyKWh'] ?? null)
            ? array_values($model['globalHourlyKWh'])
            : array_fill(0, 24, 0.0);
        $rawHourly = [];

        for ($h = 0; $h < 24; $h++) {
            $sum = 0.0;
            $weight = 0.0;
            $support = 0.0;
            foreach ($seasonWeights as $season => $seasonWeight) {
                $candidate = $model['profiles'][$season][$weekdayKey] ?? null;
                if (!is_array($candidate) || count($candidate) !== 24) continue;
                $w = max(0.0, (float)$seasonWeight);
                $sum += max(0.0, (float)($candidate[$h] ?? 0.0)) * $w;
                $weight += $w;
                $support += max(0.0, (float)($model['slotWeights'][$season][$weekdayKey] ?? 0.0)) * $w;
            }

            $globalValue = max(0.0, (float)($global[$h] ?? 0.0));
            if ($weight > 0.000001) {
                $weekdayValue = $sum / $weight;
                // Ein eigenes Wochentags-/Saisonprofil soll nicht bereits nach nur
                // wenigen Vergleichstagen einen einzelnen Ausreißertag vollständig
                // übernehmen. Das Slot-Profil wird daher mit dem stabilen globalen
                // Stundenprofil "eingeschwungen". Mit wachsender Datenbasis nähert
                // sich die Gewichtung automatisch 100 % dem individuellen Wochentag.
                $confidence = $support > 0.0 ? min(1.0, $support / ($support + 4.0)) : 0.0;
                if ($globalValue > 0.0) {
                    $rawHourly[$h] = $weekdayValue * $confidence + $globalValue * (1.0 - $confidence);
                } else {
                    $rawHourly[$h] = $weekdayValue;
                }
            } else {
                $rawHourly[$h] = $globalValue;
            }
        }

        // Falls das Modell noch einzelne völlig leere Stunden enthält, aus dem
        // konfigurierten Tages-Fallback nur diese Lücken auffüllen.
        $fallbackHourly = max(0.0, $this->ReadPropertyFloat('FallbackDailyConsumptionKWh')) / 24.0;
        for ($h = 0; $h < 24; $h++) {
            if (!is_finite($rawHourly[$h]) || $rawHourly[$h] < 0.000001) {
                $rawHourly[$h] = $fallbackHourly;
            }
        }

        $safety = 1.0 + max(0.0, $this->ReadPropertyFloat('ConsumptionForecastSafetyPct')) / 100.0;
        $forecastHourly = array_map(
            static fn($v) => max(0.0, (float)$v) * $safety,
            $rawHourly
        );

        $weekdayNames = [
            1 => 'Montag', 2 => 'Dienstag', 3 => 'Mittwoch', 4 => 'Donnerstag',
            5 => 'Freitag', 6 => 'Samstag', 7 => 'Sonntag'
        ];
        $seasonNames = [
            'winter' => 'Winter', 'spring' => 'Frühling',
            'summer' => 'Sommer', 'autumn' => 'Herbst'
        ];
        $seasonParts = [];
        foreach ($seasonWeights as $season => $weight) {
            if ((float)$weight < 0.005) continue;
            $seasonParts[] = ($seasonNames[$season] ?? $season)
                . ' ' . number_format((float)$weight * 100.0, 0, ',', '.') . ' %';
        }

        $source = 'Archiv gelernt – ' . ($weekdayNames[$weekday] ?? ('Tag ' . $weekday))
            . ', saisonal ' . implode(' / ', $seasonParts)
            . ', ' . (int)($model['validDays'] ?? 0) . ' Tage';
        if ((int)($model['evSessions'] ?? 0) > 0) {
            $source .= ', ' . (int)$model['evSessions'] . ' Autoladungen ausgeschlossen';
        }

        return [
            'version' => 2,
            'hourlyKWh' => $forecastHourly,
            'rawHourlyKWh' => $rawHourly,
            'dailyKWh' => array_sum($forecastHourly),
            'validDays' => (int)($model['validDays'] ?? 0),
            'source' => $source,
            'updated' => time(),
            'targetDate' => date('Y-m-d', $targetTimestamp),
            'weekday' => $weekday,
            'seasonWeights' => $seasonWeights,
            'excludedEVSessions' => (int)($model['evSessions'] ?? 0),
            'excludedEVKWh' => (float)($model['evKWh'] ?? 0.0),
            'seasonalModel' => $model
        ];
    }

    private function GetConsumptionForecastHourlyForTimestamp(array $profile, int $timestamp, bool $withSafety = true): array
    {
        if (isset($profile['seasonalModel']) && is_array($profile['seasonalModel'])) {
            $composed = $this->ComposeConsumptionProfileFromModel($profile['seasonalModel'], $timestamp);
            $key = $withSafety ? 'hourlyKWh' : 'rawHourlyKWh';
            if (isset($composed[$key]) && is_array($composed[$key]) && count($composed[$key]) === 24) {
                return array_values($composed[$key]);
            }
        }

        $key = $withSafety ? 'hourlyKWh' : 'rawHourlyKWh';
        if (isset($profile[$key]) && is_array($profile[$key]) && count($profile[$key]) === 24) {
            return array_values($profile[$key]);
        }
        if (isset($profile['hourlyKWh']) && is_array($profile['hourlyKWh']) && count($profile['hourlyKWh']) === 24) {
            return array_values($profile['hourlyKWh']);
        }
        return array_fill(0, 24, max(0.0, $this->ReadPropertyFloat('FallbackDailyConsumptionKWh')) / 24.0);
    }

    private function FindConsumptionArchiveStartDay(int $archiveID, int $varID): int
    {
        $currentMonth = strtotime(date('Y-m-01 00:00:00'));
        $oldestMonth = 0;
        $foundAny = false;
        $emptyBeforeHistory = 0;

        // Maximal 15 Jahre zurück suchen. Sobald hinter bereits gefundenen Daten
        // zwölf Monate am Stück leer sind, ist der Archivbeginn sicher überschritten.
        for ($m = 0; $m < 180; $m++) {
            $monthStart = strtotime('-' . $m . ' months', $currentMonth);
            $monthEnd = min(time(), strtotime('+1 month', $monthStart) - 1);
            if ($monthEnd <= $monthStart) continue;

            $probe = @AC_GetLoggedValues($archiveID, $varID, $monthStart, $monthEnd, 1);
            if (is_array($probe) && count($probe) > 0) {
                $foundAny = true;
                $oldestMonth = $monthStart;
                $emptyBeforeHistory = 0;
            } elseif ($foundAny) {
                $emptyBeforeHistory++;
                if ($emptyBeforeHistory >= 12) break;
            }
        }

        if ($oldestMonth <= 0) return 0;

        $monthEnd = strtotime('+1 month', $oldestMonth);
        for ($day = $oldestMonth; $day < $monthEnd; $day = strtotime('+1 day', $day)) {
            $dayEnd = min(time(), strtotime('+1 day', $day) - 1);
            $probe = @AC_GetLoggedValues($archiveID, $varID, $day, $dayEnd, 1);
            if (is_array($probe) && count($probe) > 0) return $day;
        }
        return $oldestMonth;
    }

    private function GetConsumptionDayForProfileLearning(int $archiveID, int $varID, int $dayStart): ?array
    {
        // Die Lernfunktion liest Archiv-Rohwerte ausschließlich speicherschonend in
        // begrenzten Seiten. Ein Rückfall auf die alte Ganz-Tages-Rohwertabfrage darf
        // hier nicht mehr stattfinden, da hochfrequent geloggte Verbrauchswerte sonst
        // das PHP-Speicherlimit der IP-Symcon-Instanz überschreiten können.
        $day = $this->GetHourlyConsumptionForLearningDay($archiveID, $varID, $dayStart);
        if (is_array($day)
            && isset($day['hourlyKWh'])
            && is_array($day['hourlyKWh'])
            && count($day['hourlyKWh']) === 24
            && array_sum(array_map('floatval', $day['hourlyKWh'])) > 0.1
        ) {
            return $day;
        }
        return null;
    }

    private function BuildImmediateConsumptionProfileSeed(int $archiveID, int $varID): ?array
    {
        $configuredDays = max(3, min(90, $this->ReadPropertyInteger('LearningDays')));
        // Maximal 14 abgeschlossene Tage synchron lesen; der vollständige Archivlauf
        // folgt blockweise. Zwei Wochen liefern bereits jeden Wochentag mehrfach und
        // halten den Button trotzdem reaktionsschnell.
        $seedDays = min(14, $configuredDays);
        $acc = $this->CreateConsumptionAccumulator();
        for ($age = 1; $age <= $seedDays; $age++) {
            $dayStart = strtotime('-' . $age . ' days 00:00:00');
            $day = $this->GetConsumptionDayForProfileLearning($archiveID, $varID, $dayStart);
            if (is_array($day)) $this->AddConsumptionDayToAccumulator($acc, $dayStart, $day);
        }

        if ((int)($acc['validDays'] ?? 0) < 1) return null;
        $model = $this->FinalizeConsumptionAccumulator($acc);
        $result = $this->ComposeConsumptionProfileFromModel($model, strtotime('tomorrow 12:00:00'));
        $result['updated'] = time();
        $result['archiveRebuild'] = true;
        $result['immediateSeed'] = true;
        $result['source'] = 'Archiv-Startprofil – ' . (int)($model['validDays'] ?? 0) . ' Tage; vollständige Archiv-Neuberechnung läuft';
        return $result;
    }

    private function GetHourlyConsumptionForLearningDay(int $archiveID, int $varID, int $dayStart): ?array
    {
        $dayEnd = $dayStart + 86400;
        if ($dayEnd > strtotime('today 00:00:00')) return null;

        // Grundprofil ausschließlich aus Stundenaggregaten lesen. Damit bleiben pro
        // Lerntag nur 24 Datensätze im Speicher – unabhängig von der Rohwert-Frequenz.
        $hourlyRawWh = $this->GetHourlyConsumptionWhFromAggregates($archiveID, $varID, $dayStart, $dayEnd);
        if (!is_array($hourlyRawWh) || count($hourlyRawWh) !== 24) return null;

        // Sonderlast Autoladen getrennt analysieren. Der erkannte Zusatzverbrauch wird
        // ausschließlich vom Lernprofil abgezogen; das eigentliche Verbrauchsarchiv
        // bleibt unverändert und kann im Diagramm weiterhin vollständig dargestellt werden.
        $ev = $this->GetEVChargingAnalysisForDay($archiveID, $varID, $dayStart);
        $hourlyEVWh = is_array($ev['hourlyWh'] ?? null)
            ? array_values($ev['hourlyWh'])
            : array_fill(0, 24, 0.0);

        $hourlyCleanWh = [];
        for ($h = 0; $h < 24; $h++) {
            $hourlyCleanWh[$h] = max(
                0.0,
                (float)($hourlyRawWh[$h] ?? 0.0) - max(0.0, (float)($hourlyEVWh[$h] ?? 0.0))
            );
        }

        return [
            'hourlyKWh' => array_map(static fn($wh) => max(0.0, (float)$wh) / 1000.0, $hourlyCleanWh),
            'rawHourlyKWh' => array_map(static fn($wh) => max(0.0, (float)$wh) / 1000.0, $hourlyRawWh),
            'evHourlyKWh' => array_map(static fn($wh) => max(0.0, (float)$wh) / 1000.0, $hourlyEVWh),
            'evSessions' => (int)($ev['sessions'] ?? 0),
            'evKWh' => max(0.0, (float)($ev['kWh'] ?? 0.0))
        ];
    }

    private function GetEVChargingAnalysisForDay(int $archiveID, int $varID, int $dayStart, bool $forceRefresh = false): array
    {
        $empty = [
            'hourlyWh' => array_fill(0, 24, 0.0),
            'sessions' => 0,
            'kWh' => 0.0,
            'rawEdges' => 0,
            'rawTrackedSessions' => 0
        ];
        if ($archiveID <= 0 || $varID <= 0 || $dayStart <= 0) return $empty;

        $fullDayEnd = $dayStart + 86400;
        $analysisEnd = min($fullDayEnd, time());
        if ($analysisEnd <= $dayStart) return $empty;

        // Abgeschlossene Tage verändern sich nicht mehr und werden deshalb im Modul-
        // Buffer zwischengespeichert. So kann auch eine längere Diagramm-Historie ohne
        // wiederholte Minuten-Aggregat-Abfragen flüssig geblättert werden.
        $isPastDay = $fullDayEnd <= strtotime('today 00:00:00');
        $evThresholdKW = max(1.0, $this->ReadPropertyFloat('EVChargingDetectionThresholdKW'));
        $evMaxEnergyKWh = max(0.1, $this->ReadPropertyFloat('EVChargingMaxEnergyKWh'));
        $evMinRiseKW = max(0.5, $this->ReadPropertyFloat('EVChargingMinRiseKW'));
        $pattern = $this->GetEVChargingPattern();
        $patternUpdated = (int)($pattern['updated'] ?? 0);
        $evExpectedRiseKW = max(0.5, $this->ReadPropertyFloat('EVChargingExpectedRiseKW'));
        $evRiseToleranceKW = max(0.2, $this->ReadPropertyFloat('EVChargingRiseToleranceKW'));
        $evMinimumDurationMinutes = max(1, $this->ReadPropertyInteger('EVChargingMinimumDurationMinutes'));
        $futureDetectionEnabled = $this->ReadPropertyBoolean('EVFutureDetectionEnabled');
        $dateKey = date('Y-m-d', $dayStart);
        $cacheKey = $dateKey . '|' . $archiveID . '|' . $varID
            . '|v12|threshold=' . number_format($evThresholdKW, 3, '.', '')
            . '|maxenergy=' . number_format($evMaxEnergyKWh, 3, '.', '')
            . '|rise=' . number_format($evMinRiseKW, 3, '.', '')
            . '|expected=' . number_format($evExpectedRiseKW, 3, '.', '')
            . '|tolerance=' . number_format($evRiseToleranceKW, 3, '.', '')
            . '|duration=' . $evMinimumDurationMinutes
            . '|future=' . ($futureDetectionEnabled ? '1' : '0')
            . '|pattern=' . $patternUpdated;

        // Ein expliziter Archiv-Suchlauf speichert positive Treffer dauerhaft. Dadurch
        // kann das Lastprofil die nachträglich gefundenen Ladeanteile auch nach einem
        // Neustart sofort wieder abziehen, ohne denselben Tag erneut minutenweise zu lesen.
        if ($isPastDay && !$forceRefresh) {
            $stored = json_decode($this->ReadAttributeString('EVArchiveDetectionsJSON'), true);
            $saved = is_array($stored) ? ($stored[$dateKey] ?? null) : null;
            if (is_array($saved)
                && (int)($saved['version'] ?? 0) === 12
                && abs((float)($saved['thresholdKW'] ?? 0.0) - $evThresholdKW) < 0.0001
                && abs((float)($saved['maxEnergyKWh'] ?? 0.0) - $evMaxEnergyKWh) < 0.0001
                && abs((float)($saved['minRiseKW'] ?? 0.0) - $evMinRiseKW) < 0.0001
                && abs((float)($saved['expectedRiseKW'] ?? 0.0) - $evExpectedRiseKW) < 0.0001
                && abs((float)($saved['riseToleranceKW'] ?? 0.0) - $evRiseToleranceKW) < 0.0001
                && (int)($saved['minimumDurationMinutes'] ?? 0) === $evMinimumDurationMinutes
                && isset($saved['hourlyWh']) && is_array($saved['hourlyWh']) && count($saved['hourlyWh']) === 24
            ) {
                return [
                    'hourlyWh' => array_values($saved['hourlyWh']),
                    'sessions' => (int)($saved['sessions'] ?? 0),
                    'kWh' => max(0.0, (float)($saved['kWh'] ?? 0.0)),
                    'details' => is_array($saved['details'] ?? null) ? array_values($saved['details']) : []
                ];
            }
        }

        // Der Schalter betrifft ausschließlich die automatische Erkennung neuer
        // Ladevorgänge. Manuell im Archiv gefundene und gespeicherte Treffer werden
        // weiterhin verwendet, damit sie aus dem Lastprofil ausgeschlossen bleiben.
        if (!$forceRefresh && !$futureDetectionEnabled) {
            return $empty;
        }

        if ($isPastDay && !$forceRefresh) {
            $cache = json_decode((string)$this->GetBuffer('ConsumptionEVAnalysisCache'), true);
            if (is_array($cache) && isset($cache[$cacheKey]) && is_array($cache[$cacheKey])) {
                $cached = $cache[$cacheKey];
                if (isset($cached['hourlyWh']) && is_array($cached['hourlyWh']) && count($cached['hourlyWh']) === 24) {
                    return $cached;
                }
            }
        }

        // Vier Stunden Rand erfassen auch Ladevorgänge, die kurz vor Mitternacht
        // beginnen oder nach Mitternacht enden. Für den aktuellen Tag nie in die
        // Zukunft lesen.
        $readStart = max(0, $dayStart - 4 * 3600);
        $readEnd = min($fullDayEnd + 4 * 3600, time());
        // WICHTIG: Bei einer expliziten Archivsuche wird die Rohwertsuche IMMER
        // ausgeführt. Sie darf nicht von der 1-Minuten-Aggregation abhängen. Genau dieser
        // Frühabbruch führte bisher dazu, dass trotz vorhandener Rohwerte der Variable
        // HousePowerVariable (beim Nutzer #50354) 0 Roh-Flanken gemeldet werden konnten.
        $rawEdges = [];
        $rawScanStats = ['rows' => 0, 'maxRiseW' => 0.0, 'latestTs' => 0];
        if ($forceRefresh) {
            $rawEdges = $this->FindEVChargingRawStartEdges($archiveID, $varID, $readStart, $readEnd);
            $diag = json_decode((string)$this->GetBuffer('EVRawScanStats'), true);
            if (is_array($diag)) $rawScanStats = array_merge($rawScanStats, $diag);
        }

        // Die explizite Archivsuche darf NICHT von Minutenaggregaten abhängen.
        // Die Roh-Flanken wurden bereits direkt aus HousePowerVariable gelesen; deshalb
        // werden daraus jetzt auch die vollständigen Ladephasen direkt aus Rohwerten
        // verfolgt. Genau der alte Frühabbruch bei fehlenden 1-Minuten-Aggregaten führte
        // zu "Roh-Flanken gefunden, aber 0 Ladungen".
        $rawSessions = [];
        if ($forceRefresh && count($rawEdges) > 0) {
            $rawSessions = $this->BuildEVChargingSessionsFromRawEdges($archiveID, $varID, $rawEdges, $readStart, $readEnd);
        }

        $points = $this->GetMinuteConsumptionPowerPoints($archiveID, $varID, $readStart, $readEnd);
        $sessions = count($points) >= 2
            ? $this->DetectEVChargingSessions($points, $readStart, $readEnd, $pattern)
            : [];
        if (count($rawSessions) > 0) {
            $sessions = $this->MergeEVChargingSessions($sessions, $rawSessions);
        }
        if (count($points) < 2 && count($sessions) === 0) {
            $empty['rawEdges'] = count($rawEdges);
            $empty['rawTrackedSessions'] = count($rawSessions);
            $empty['rawEdgeTimestamps'] = array_values(array_map(static fn($edge) => (int)($edge['start'] ?? 0), $rawEdges));
            $empty['rawScannedRows'] = (int)($rawScanStats['rows'] ?? 0);
            $empty['maxRawRiseW'] = (float)($rawScanStats['maxRiseW'] ?? 0.0);
            $empty['latestRawValueTs'] = (int)($rawScanStats['latestTs'] ?? 0);
            return $empty;
        }

        if (count($sessions) > 0) {
            $refinedSessions = [];
            foreach ($sessions as $session) {
                $refinedSessions[] = $this->RefineEVChargingSessionWithRawValues($archiveID, $varID, $session, $readStart, $readEnd);
            }
            $sessions = $refinedSessions;
        }
        if (count($sessions) === 0) {
            $empty['rawEdges'] = count($rawEdges);
            $empty['rawTrackedSessions'] = count($rawSessions);
            $empty['rawEdgeTimestamps'] = array_values(array_map(static fn($edge) => (int)($edge['start'] ?? 0), $rawEdges));
            $empty['rawScannedRows'] = (int)($rawScanStats['rows'] ?? 0);
            $empty['maxRawRiseW'] = (float)($rawScanStats['maxRiseW'] ?? 0.0);
            $empty['latestRawValueTs'] = (int)($rawScanStats['latestTs'] ?? 0);
            if ($isPastDay) {
                $cache = json_decode((string)$this->GetBuffer('ConsumptionEVAnalysisCache'), true);
                if (!is_array($cache)) $cache = [];
                $cache[$cacheKey] = $empty;
                if (count($cache) > 120) $cache = array_slice($cache, -120, null, true);
                $this->SetBuffer('ConsumptionEVAnalysisCache', json_encode($cache));
            }
            return $empty;
        }

        $hourlyEVWh = array_fill(0, 24, 0.0);
        $sessionCount = 0;
        $evWh = 0.0;
        $details = [];
        $pointCount = count($points);

        // Sobald eine Ladephase erkannt ist, wird fuer die Berechnung NICHT mehr die
        // schwankende gemessene Zusatzlast verwendet. Der vom Benutzer bekannte
        // Plausibilitaetswert ist zugleich die feste Fahrzeug-Ladeleistung. Dieser Wert
        // wird vom Ladebeginn bis zum erkannten Ende abgezogen, jedoch hoechstens bis zur
        // konfigurierten maximalen Energie pro Ladevorgang.
        $fixedChargePowerW = max(1000.0, $evThresholdKW * 1000.0);
        $maxSessionEnergyWh = max(100.0, $evMaxEnergyKWh * 1000.0);
        $maxSessionDurationS = (int)floor(($maxSessionEnergyWh / $fixedChargePowerW) * 3600.0);
        $maxSessionDurationS = max(60, $maxSessionDurationS);

        foreach ($sessions as $session) {
            $sessionStart = (int)($session['start'] ?? 0);
            $detectedSessionEnd = (int)($session['end'] ?? 0);
            if ($sessionStart <= 0 || $detectedSessionEnd <= $sessionStart) continue;

            // Harte Energieobergrenze: z. B. 14,4 kWh bei 6,5 kW entsprechen rund
            // 133 Minuten maximal anrechenbarer Fahrzeugladung.
            $energyLimitedEnd = $sessionStart + $maxSessionDurationS;
            $sessionEnd = min($detectedSessionEnd, $energyLimitedEnd);
            if ($sessionEnd <= $sessionStart) continue;

            $overlapStart = max($dayStart, $sessionStart);
            $overlapEnd = min($analysisEnd, $sessionEnd);
            if ($overlapEnd <= $overlapStart) continue;

            if ($sessionStart >= $dayStart && $sessionStart < $fullDayEnd) $sessionCount++;

            $sessionEnergyWh = min(
                $maxSessionEnergyWh,
                $fixedChargePowerW * (($sessionEnd - $sessionStart) / 3600.0)
            );
            $details[] = [
                'start' => $sessionStart,
                'end' => $sessionEnd,
                'detectedEnd' => $detectedSessionEnd,
                'baselineW' => max(0.0, (float)($session['baselineW'] ?? 0.0)),
                'chargePowerW' => $fixedChargePowerW,
                'initialRiseW' => max(0.0, (float)($session['initialRiseW'] ?? 0.0)),
                'plateauCoverage' => max(0.0, min(1.0, (float)($session['plateauCoverage'] ?? 0.0))),
                'confirmedDrop' => !empty($session['confirmedDrop']),
                'patternMatch' => !empty($session['patternMatch']),
                'energyLimited' => $energyLimitedEnd < $detectedSessionEnd,
                'maxEnergyKWh' => $evMaxEnergyKWh,
                'kWh' => $sessionEnergyWh / 1000.0
            ];

            // Den festen Ladeleistungswert sekundengenau auf die betroffenen Stunden
            // verteilen. Nur dieser Anteil wird orange dargestellt und aus dem Lastprofil
            // herausgerechnet; das originale Verbrauchsarchiv bleibt unveraendert.
            $cursor = $overlapStart;
            while ($cursor < $overlapEnd) {
                $hour = max(0, min(23, (int)date('G', $cursor)));
                $hourEnd = min($overlapEnd, strtotime(date('Y-m-d H:00:00', $cursor)) + 3600);
                if ($hourEnd <= $cursor) break;
                $wh = $fixedChargePowerW * (($hourEnd - $cursor) / 3600.0);
                $hourlyEVWh[$hour] += $wh;
                $evWh += $wh;
                $cursor = $hourEnd;
            }
        }

        $result = [
            'hourlyWh' => $hourlyEVWh,
            'sessions' => $sessionCount,
            'kWh' => $evWh / 1000.0,
            'details' => $details,
            'rawEdges' => count($rawEdges),
            'rawTrackedSessions' => count($rawSessions),
            'rawEdgeTimestamps' => array_values(array_map(static fn($edge) => (int)($edge['start'] ?? 0), $rawEdges)),
            'rawScannedRows' => (int)($rawScanStats['rows'] ?? 0),
            'maxRawRiseW' => (float)($rawScanStats['maxRiseW'] ?? 0.0),
            'latestRawValueTs' => (int)($rawScanStats['latestTs'] ?? 0)
        ];

        if ($isPastDay) {
            $cache = json_decode((string)$this->GetBuffer('ConsumptionEVAnalysisCache'), true);
            if (!is_array($cache)) $cache = [];
            $cache[$cacheKey] = $result;
            if (count($cache) > 120) $cache = array_slice($cache, -120, null, true);
            $this->SetBuffer('ConsumptionEVAnalysisCache', json_encode($cache));
        }
        return $result;
    }

    private function FindEVChargingRawStartEdges(int $archiveID, int $varID, int $rangeStart, int $rangeEnd): array
    {
        if ($archiveID <= 0 || $varID <= 0 || $rangeEnd <= $rangeStart) {
            $this->SetBuffer('EVRawScanStats', json_encode(['rows' => 0, 'maxRiseW' => 0.0, 'latestTs' => 0, 'varID' => $varID]));
            return [];
        }

        $minRiseW = max(500.0, $this->ReadPropertyFloat('EVChargingMinRiseKW') * 1000.0);
        $expectedRiseW = max(500.0, $this->ReadPropertyFloat('EVChargingExpectedRiseKW') * 1000.0);
        $toleranceW = max(200.0, $this->ReadPropertyFloat('EVChargingRiseToleranceKW') * 1000.0);
        $edgeFloorW = max(1500.0, $minRiseW);

        // Direkte Rohwertsuche in 30-Minuten-Bloecken. Keine Stunden-/Minuten-
        // Vorauswahl und kein 5.000er-Limit mehr. Damit werden die tatsaechlichen
        // Werte von HousePowerVariable (z. B. #50354) untersucht. Die kurzen Bloecke
        // halten Speicher und Archivlast klein und erfassen auch Sekundenflanken.
        $blockSeconds = 30 * 60;
        $overlapSeconds = 30;
        $blockStart = $rangeStart;
        $edges = [];
        $lastAcceptedTs = 0;
        $lastAcceptedIndex = -1;
        $scannedRows = 0;
        $maxObservedRiseW = 0.0;
        $latestTs = 0;

        while ($blockStart < $rangeEnd) {
            $coreStart = $blockStart;
            $coreEnd = min($rangeEnd, $blockStart + $blockSeconds);
            $rawStart = max($rangeStart, $coreStart - $overlapSeconds);
            $rawEnd = min($rangeEnd, $coreEnd + $overlapSeconds);
            $rows = $this->GetRawConsumptionPowerPointsWindow($archiveID, $varID, $rawStart, $rawEnd, 0);
            $scannedRows += count($rows);
            if (count($rows) >= 2) {
                $latestTs = max($latestTs, (int)($rows[count($rows)-1]['ts'] ?? 0));
                $rowCount = count($rows);
                for ($i = 1; $i < $rowCount; $i++) {
                    $ts = (int)($rows[$i]['ts'] ?? 0);
                    if ($ts < $coreStart || $ts >= $coreEnd) continue;

                    $lookbackStart = $ts - 20;
                    $lowW = max(0.0, (float)($rows[$i - 1]['value'] ?? 0.0));
                    $lowTs = (int)($rows[$i - 1]['ts'] ?? $ts);
                    for ($k = $i - 1; $k >= 0; $k--) {
                        $kTs = (int)($rows[$k]['ts'] ?? 0);
                        if ($kTs < $lookbackStart) break;
                        $v = max(0.0, (float)($rows[$k]['value'] ?? 0.0));
                        if ($v < $lowW) { $lowW = $v; $lowTs = $kTs; }
                    }

                    $highW = max(0.0, (float)($rows[$i]['value'] ?? 0.0));
                    $riseW = $highW - $lowW;
                    $maxObservedRiseW = max($maxObservedRiseW, $riseW);
                    if ($riseW < $edgeFloorW) continue;

                    $history = [];
                    $histFrom = $ts - 5 * 60;
                    $histTo = $ts - 5;
                    for ($k = $i - 1; $k >= 0; $k--) {
                        $hTs = (int)($rows[$k]['ts'] ?? 0);
                        if ($hTs < $histFrom) break;
                        if ($hTs <= $histTo) $history[] = max(0.0, (float)($rows[$k]['value'] ?? 0.0));
                    }
                    $baselineW = count($history) >= 2 ? $this->Median($history) : $lowW;
                    $riseVsBaselineW = $highW - $baselineW;
                    $effectiveRiseW = max($riseW, $riseVsBaselineW);
                    $maxObservedRiseW = max($maxObservedRiseW, $effectiveRiseW);
                    if ($effectiveRiseW < $edgeFloorW) continue;

                    // Gleiche Startphase nicht mehrfach zaehlen; mehrstufige Starts
                    // innerhalb von 20 s werden auf die hoechste Stufe aktualisiert.
                    if ($lastAcceptedTs > 0 && ($ts - $lastAcceptedTs) >= 20 && ($ts - $lastAcceptedTs) < 10 * 60) continue;

                    $edge = [
                        'start' => $ts,
                        'fromTs' => $lowTs,
                        'fromW' => $lowW,
                        'toW' => $highW,
                        'baselineW' => max(0.0, $baselineW),
                        'riseW' => $effectiveRiseW,
                        'expectedMatch' => abs($effectiveRiseW - $expectedRiseW) <= max($toleranceW, $expectedRiseW * 0.45)
                    ];

                    if ($lastAcceptedTs > 0 && ($ts - $lastAcceptedTs) < 20 && $lastAcceptedIndex >= 0) {
                        if ($edge['riseW'] > (float)($edges[$lastAcceptedIndex]['riseW'] ?? 0.0)) {
                            $edge['start'] = (int)($edges[$lastAcceptedIndex]['start'] ?? $ts);
                            $edge['fromTs'] = (int)($edges[$lastAcceptedIndex]['fromTs'] ?? $lowTs);
                            $edge['fromW'] = min((float)($edges[$lastAcceptedIndex]['fromW'] ?? $lowW), $lowW);
                            $edge['baselineW'] = min((float)($edges[$lastAcceptedIndex]['baselineW'] ?? $baselineW), $baselineW);
                            $edges[$lastAcceptedIndex] = $edge;
                        }
                    } else {
                        $edges[] = $edge;
                        $lastAcceptedIndex = count($edges) - 1;
                        $lastAcceptedTs = $ts;
                    }
                }
            }
            $blockStart = $coreEnd;
        }

        $this->SetBuffer('EVRawScanStats', json_encode([
            'rows' => $scannedRows,
            'maxRiseW' => $maxObservedRiseW,
            'latestTs' => $latestTs,
            'varID' => $varID
        ]));
        return $edges;
    }

    private function BuildEVChargingSessionsFromRawEdges(int $archiveID, int $varID, array $edges, int $rangeStart, int $rangeEnd): array
    {
        if ($archiveID <= 0 || $varID <= 0 || count($edges) === 0 || $rangeEnd <= $rangeStart) return [];

        usort($edges, static fn($a, $b) => ((int)($a['start'] ?? 0)) <=> ((int)($b['start'] ?? 0)));

        $sessions = [];
        $minRiseW = max(500.0, $this->ReadPropertyFloat('EVChargingMinRiseKW') * 1000.0);
        $expectedRiseW = max(500.0, $this->ReadPropertyFloat('EVChargingExpectedRiseKW') * 1000.0);
        $toleranceW = max(200.0, $this->ReadPropertyFloat('EVChargingRiseToleranceKW') * 1000.0);
        $minDurationS = max(60, $this->ReadPropertyInteger('EVChargingMinimumDurationMinutes') * 60);
        $maxDurationS = 8 * 3600;
        $lowConfirmS = 60;
        $blockSeconds = 15 * 60;

        foreach ($edges as $edge) {
            $startTs = (int)($edge['start'] ?? 0);
            $baselineW = max(0.0, (float)($edge['baselineW'] ?? 0.0));
            $initialRiseW = max(0.0, (float)($edge['riseW'] ?? 0.0));
            if ($startTs <= 0 || $startTs < $rangeStart || $startTs >= $rangeEnd) continue;
            if ($initialRiseW < $minRiseW) continue;

            // Eine zweite Flanke innerhalb eines bereits gefundenen Ladevorgangs ist kein
            // neuer Start. Das ist z. B. bei mehrstufigem Hochfahren des Onboard-Laders
            // wichtig (2,5 -> 6,8 -> 11,6 kW innerhalb weniger Sekunden).
            $insideExisting = false;
            foreach ($sessions as $existing) {
                if ($startTs >= (int)($existing['start'] ?? 0) && $startTs <= (int)($existing['end'] ?? 0) + 120) {
                    $insideExisting = true;
                    break;
                }
            }
            if ($insideExisting) continue;

            // Ab der echten Roh-Flanke ausschließlich Rohwerte verfolgen. Minutenaggregate
            // sind hier bewusst nicht mehr Teil der Trefferentscheidung. Dadurch kann eine
            // eindeutig gefundene Startflanke nicht nachträglich durch eine geglättete
            // Minutenprüfung wieder verworfen werden.
            $activeExtraW = max(1800.0, min($minRiseW * 0.55, $expectedRiseW * 0.45));
            $returnExtraW = max(900.0, min(1800.0, $expectedRiseW * 0.25));
            $scanEnd = min($rangeEnd, $startTs + $maxDurationS);
            $cursor = max($rangeStart, $startTs - 5);
            $endTs = 0;
            $lowSince = 0;
            $highSeconds = 0.0;
            $extraWh = 0.0;
            $hourlyWhByKey = [];
            $highExtras = [];
            $prevTs = 0;
            $prevW = 0.0;
            $lastSeenTs = 0;
            $lastHighTs = 0;
            $guard = 0;

            while ($cursor < $scanEnd && $guard < 1000 && $endTs <= 0) {
                $guard++;
                $blockEnd = min($scanEnd, $cursor + $blockSeconds);
                $rows = $this->GetRawConsumptionPowerPointsWindow($archiveID, $varID, $cursor, $blockEnd, 0);
                if (count($rows) === 0) {
                    $cursor = $blockEnd;
                    continue;
                }
                usort($rows, static fn($a, $b) => ((int)($a['ts'] ?? 0)) <=> ((int)($b['ts'] ?? 0)));

                foreach ($rows as $row) {
                    $ts = (int)($row['ts'] ?? 0);
                    $valueW = max(0.0, (float)($row['value'] ?? 0.0));
                    if ($ts < $startTs) {
                        $prevTs = $ts;
                        $prevW = $valueW;
                        continue;
                    }
                    if ($lastSeenTs > 0 && $ts <= $lastSeenTs) continue;
                    $lastSeenTs = $ts;

                    if ($prevTs <= 0) {
                        $prevTs = $ts;
                        $prevW = $valueW;
                        continue;
                    }

                    $segStart = max($startTs, $prevTs);
                    $segEnd = min($scanEnd, $ts);
                    if ($segEnd > $segStart) {
                        $dt = $segEnd - $segStart;
                        $prevExtraW = max(0.0, $prevW - $baselineW);
                        $capW = max($minRiseW, $expectedRiseW + $toleranceW);
                        $integratedExtraW = min($prevExtraW, $capW);
                        $extraWh += $integratedExtraW * ($dt / 3600.0);
                        if ($integratedExtraW > 0.0) {
                            $hourCursor = $segStart;
                            while ($hourCursor < $segEnd) {
                                $hourEnd = min($segEnd, strtotime(date('Y-m-d H:00:00', $hourCursor)) + 3600);
                                if ($hourEnd <= $hourCursor) break;
                                $hourKey = date('Y-m-d-H', $hourCursor);
                                if (!isset($hourlyWhByKey[$hourKey])) $hourlyWhByKey[$hourKey] = 0.0;
                                $hourlyWhByKey[$hourKey] += $integratedExtraW * (($hourEnd - $hourCursor) / 3600.0);
                                $hourCursor = $hourEnd;
                            }
                        }
                        if ($prevExtraW >= $activeExtraW) {
                            $highSeconds += $dt;
                            $lastHighTs = $segEnd;
                            if (count($highExtras) < 2000) $highExtras[] = $prevExtraW;
                        }
                    }

                    $extraW = max(0.0, $valueW - $baselineW);
                    if ($extraW <= $returnExtraW) {
                        if ($lowSince <= 0) $lowSince = $ts;
                        if (($ts - $startTs) >= $minDurationS && ($ts - $lowSince) >= $lowConfirmS) {
                            $endTs = $lowSince;
                            break;
                        }
                    } else {
                        // Erst eine echte Rückkehr in die Nähe der Grundlast darf die
                        // Ladephase beenden. Zwischenstufen oder normale Hauslast während
                        // des Ladens setzen die Niedrigphase zurück.
                        $lowSince = 0;
                        if ($extraW >= $activeExtraW) {
                            $lastHighTs = $ts;
                            if (count($highExtras) < 2000) $highExtras[] = $extraW;
                        }
                    }

                    $prevTs = $ts;
                    $prevW = $valueW;
                }
                unset($rows);
                $cursor = $blockEnd;
            }

            // Bei historischen Daten sollte normalerweise eine Rückkehr zur Grundlast
            // vorhanden sein. Falls die Aufzeichnung kurz danach endet, aber bereits eine
            // klare, lange Hochlastphase vorliegt, bis zum letzten sicheren Hochlastwert
            // übernehmen statt einen eindeutigen Ladevorgang komplett zu verwerfen.
            if ($endTs <= $startTs && $lastHighTs > $startTs && ($lastHighTs - $startTs) >= $minDurationS) {
                $endTs = $lastHighTs;
            }

            $durationS = $endTs - $startTs;
            if ($durationS < $minDurationS || $highSeconds < 120) continue;

            $usable = array_values(array_filter($highExtras, static fn($v) => $v >= 1000.0));
            $chargePowerW = count($usable) > 0 ? $this->Median($usable) : $initialRiseW;
            // Zusätzliche Hausverbraucher während des Ladens dürfen die gelernte
            // Fahrzeugleistung nicht nach oben ziehen. Die typische konfigurierte
            // Ladeleistung plus Toleranz ist deshalb die Obergrenze für den Abzug.
            $chargePowerW = min($chargePowerW, max($minRiseW, $expectedRiseW + $toleranceW));
            if ($chargePowerW < max(1500.0, $minRiseW * 0.50)) continue;

            $extraKWh = max(0.0, $extraWh / 1000.0);
            if ($extraKWh < 0.20) {
                // Falls der letzte Integrationsabschnitt wegen Blockgrenze fehlt, aus
                // Dauer und robuster Ladeleistung konservativ abschätzen.
                $extraKWh = ($chargePowerW * ($durationS / 3600.0)) / 1000.0;
            }
            if ($extraKWh < 0.20 || $extraKWh > 22.0) continue;

            $sessions[] = [
                'start' => $startTs,
                'end' => $endTs,
                'baselineW' => $baselineW,
                'chargePowerW' => $chargePowerW,
                'initialRiseW' => $initialRiseW,
                'plateauCoverage' => 1.0,
                'confirmedDrop' => $lowSince > 0 && $endTs === $lowSince,
                'patternMatch' => abs($chargePowerW - $expectedRiseW) <= max($toleranceW, $expectedRiseW * 0.40),
                'extraKWh' => $extraKWh,
                'hourlyWhByKey' => $hourlyWhByKey,
                'edgeType' => 'raw-rise-tracked'
            ];
        }
        return $sessions;
    }

    private function MergeEVChargingSessions(array $primary, array $additional): array
    {
        $all = array_merge($primary, $additional);
        if (count($all) <= 1) return $all;
        usort($all, static fn($a, $b) => ((int)($a['start'] ?? 0)) <=> ((int)($b['start'] ?? 0)));
        $merged = [];
        foreach ($all as $session) {
            $start = (int)($session['start'] ?? 0);
            $end = (int)($session['end'] ?? 0);
            if ($start <= 0 || $end <= $start) continue;
            $n = count($merged);
            if ($n > 0) {
                $prevStart = (int)($merged[$n - 1]['start'] ?? 0);
                $prevEnd = (int)($merged[$n - 1]['end'] ?? 0);
                if ($start <= $prevEnd + 5 * 60 && $end >= $prevStart - 5 * 60) {
                    // Bei doppelter Erkennung desselben Ladevorgangs die Variante mit der
                    // echten Rohwert-Startflanke bevorzugen.
                    if (($session['edgeType'] ?? '') === 'raw-archive-rise') $merged[$n - 1] = $session;
                    continue;
                }
            }
            $merged[] = $session;
        }
        return $merged;
    }

    private function GetMinuteConsumptionPowerPoints(int $archiveID, int $varID, int $rangeStart, int $rangeEnd): array
    {
        if ($archiveID <= 0 || $varID <= 0 || $rangeEnd <= $rangeStart) return [];
        // Aggregationsstufe 6 = 1 Minute. Neben dem Mittelwert werden bewusst auch
        // Min/Max samt Zeitpunkten behalten. Damit erkennen wir schnelle Schaltflanken
        // innerhalb einer Minute (z. B. 1,2 kW -> 8,5 kW in wenigen Sekunden), ohne
        // komplette Tages-Rohwertlisten in den PHP-Speicher zu laden.
        $rows = @AC_GetAggregatedValues($archiveID, $varID, 6, $rangeStart, $rangeEnd - 1, 0);
        if (!is_array($rows) || count($rows) === 0) return [];

        $points = [];
        foreach (array_reverse($rows) as $row) {
            $ts = (int)($row['TimeStamp'] ?? 0);
            if ($ts < $rangeStart || $ts >= $rangeEnd) continue;
            $avg = max(0.0, (float)($row['Avg'] ?? 0.0));
            $min = max(0.0, (float)($row['Min'] ?? $avg));
            $max = max(0.0, (float)($row['Max'] ?? $avg));
            $minTime = (int)($row['MinTime'] ?? $ts);
            $maxTime = (int)($row['MaxTime'] ?? $ts);
            $points[] = [
                'ts' => $ts,
                'value' => $avg,
                'min' => $min,
                'max' => $max,
                'minTime' => $minTime,
                'maxTime' => $maxTime
            ];
        }
        return $points;
    }

    private function GetRawConsumptionPowerPointsWindow(int $archiveID, int $varID, int $rangeStart, int $rangeEnd, int $limit = 2500): array
    {
        if ($archiveID <= 0 || $varID <= 0 || $rangeEnd <= $rangeStart) return [];
        // Nur kleine Zeitfenster rund um eine bereits erkannte Kandidatenflanke lesen.
        // AC_GetLoggedValues wird absichtlich NICHT für ganze Tage verwendet.
        $apiLimit = $limit <= 0 ? 0 : max(100, min(10000, $limit));
        $rows = @AC_GetLoggedValues($archiveID, $varID, $rangeStart, $rangeEnd, $apiLimit);
        if (!is_array($rows) || count($rows) === 0) return [];
        $points = [];
        foreach (array_reverse($rows) as $row) {
            $ts = (int)($row['TimeStamp'] ?? 0);
            if ($ts < $rangeStart || $ts > $rangeEnd) continue;
            $points[] = ['ts' => $ts, 'value' => max(0.0, (float)($row['Value'] ?? 0.0))];
        }
        return $points;
    }

    private function RefineEVChargingSessionWithRawValues(int $archiveID, int $varID, array $session, int $rangeStart, int $rangeEnd): array
    {
        $start = (int)($session['start'] ?? 0);
        $end = (int)($session['end'] ?? 0);
        $baselineW = max(0.0, (float)($session['baselineW'] ?? 0.0));
        $chargePowerW = max(0.0, (float)($session['chargePowerW'] ?? 0.0));
        $configuredRiseW = max(500.0, $this->ReadPropertyFloat('EVChargingMinRiseKW') * 1000.0);
        if ($start <= 0 || $end <= $start) return $session;

        // Start: im kleinen Rohdatenfenster die erste echte Aufwärtsflanke suchen.
        $startRows = $this->GetRawConsumptionPowerPointsWindow(
            $archiveID, $varID,
            max($rangeStart, $start - 5 * 60),
            min($rangeEnd, $start + 5 * 60)
        );
        $highThreshold = $baselineW + max(2200.0, min($configuredRiseW * 0.60, max(2200.0, $chargePowerW * 0.55)));
        $lowThreshold = $baselineW + max(1000.0, min(1800.0, $configuredRiseW * 0.30));
        for ($i = 1; $i < count($startRows); $i++) {
            $prevW = (float)$startRows[$i - 1]['value'];
            $curW = (float)$startRows[$i]['value'];
            if ($prevW <= $lowThreshold && $curW >= $highThreshold && ($curW - $prevW) >= max(1800.0, $configuredRiseW * 0.55)) {
                $start = (int)$startRows[$i]['ts'];
                $session['rawStartConfirmed'] = true;
                $session['rawStartFromW'] = $prevW;
                $session['rawStartToW'] = $curW;
                break;
            }
        }

        // Ende: analog die erste echte Abwärtsflanke zurück Richtung Grundlast suchen.
        $endRows = $this->GetRawConsumptionPowerPointsWindow(
            $archiveID, $varID,
            max($rangeStart, $end - 5 * 60),
            min($rangeEnd, $end + 5 * 60)
        );
        $endLowThreshold = $baselineW + max(1200.0, min(2200.0, max(1200.0, $chargePowerW * 0.35)));
        for ($i = 1; $i < count($endRows); $i++) {
            $prevW = (float)$endRows[$i - 1]['value'];
            $curW = (float)$endRows[$i]['value'];
            if ($prevW >= $highThreshold && $curW <= $endLowThreshold && ($prevW - $curW) >= max(1800.0, $configuredRiseW * 0.50)) {
                $end = (int)$endRows[$i]['ts'];
                $session['rawEndConfirmed'] = true;
                $session['rawEndFromW'] = $prevW;
                $session['rawEndToW'] = $curW;
                break;
            }
        }

        if ($end > $start) {
            $session['start'] = $start;
            $session['end'] = $end;
        }
        return $session;
    }

    private function GetHourlyConsumptionWhFromAggregates(int $archiveID, int $varID, int $dayStart, int $dayEnd): ?array
    {
        if ($archiveID <= 0 || $varID <= 0 || $dayEnd <= $dayStart) return null;
        $rows = @AC_GetAggregatedValues($archiveID, $varID, 0, $dayStart, $dayEnd - 1, 0);
        if (!is_array($rows) || count($rows) === 0) return null;

        $hourlyWh = array_fill(0, 24, 0.0);
        $have = false;
        foreach ($rows as $row) {
            $ts = (int)($row['TimeStamp'] ?? 0);
            if ($ts < $dayStart || $ts >= $dayEnd) continue;
            $duration = max(0, (int)($row['Duration'] ?? 3600));
            if ($duration <= 0) continue;
            $avgW = max(0.0, (float)($row['Avg'] ?? 0.0));
            $hour = max(0, min(23, (int)date('G', $ts)));
            $hourlyWh[$hour] += $avgW * ($duration / 3600.0);
            $have = true;
        }
        return $have ? $hourlyWh : null;
    }

    private function GetPagedConsumptionPowerPoints(int $archiveID, int $varID, int $rangeStart, int $rangeEnd): array
    {
        if ($archiveID <= 0 || $varID <= 0 || $rangeEnd <= $rangeStart) return [];

        $pageLimit = 1500;
        $bucketSeconds = 60;
        $cursorEnd = $rangeEnd;
        $buckets = [];
        $guard = 0;

        while ($cursorEnd >= $rangeStart && $guard < 10000) {
            $guard++;
            $rows = @AC_GetLoggedValues($archiveID, $varID, $rangeStart, $cursorEnd, $pageLimit);
            if (!is_array($rows) || count($rows) === 0) break;

            $rowCount = count($rows);
            $minTs = null;
            foreach ($rows as $row) {
                $ts = (int)($row['TimeStamp'] ?? 0);
                if ($ts < $rangeStart || $ts > $rangeEnd) continue;
                $value = max(0.0, (float)($row['Value'] ?? 0.0));
                if ($minTs === null || $ts < $minTs) $minTs = $ts;

                $bucket = (int)floor(($ts - $rangeStart) / $bucketSeconds);
                if (!isset($buckets[$bucket])) {
                    $buckets[$bucket] = [
                        'firstTs' => $ts, 'firstValue' => $value,
                        'lastTs' => $ts, 'lastValue' => $value,
                        'minTs' => $ts, 'minValue' => $value,
                        'maxTs' => $ts, 'maxValue' => $value
                    ];
                    continue;
                }

                if ($ts < $buckets[$bucket]['firstTs']) {
                    $buckets[$bucket]['firstTs'] = $ts;
                    $buckets[$bucket]['firstValue'] = $value;
                }
                if ($ts > $buckets[$bucket]['lastTs']) {
                    $buckets[$bucket]['lastTs'] = $ts;
                    $buckets[$bucket]['lastValue'] = $value;
                }
                if ($value < $buckets[$bucket]['minValue']) {
                    $buckets[$bucket]['minTs'] = $ts;
                    $buckets[$bucket]['minValue'] = $value;
                }
                if ($value > $buckets[$bucket]['maxValue']) {
                    $buckets[$bucket]['maxTs'] = $ts;
                    $buckets[$bucket]['maxValue'] = $value;
                }
            }
            unset($rows);

            if ($minTs === null || $minTs <= $rangeStart || $rowCount < $pageLimit) break;
            $nextEnd = $minTs - 1;
            if ($nextEnd >= $cursorEnd) break;
            $cursorEnd = $nextEnd;
        }

        $pointMap = [];
        foreach ($buckets as $bucket) {
            foreach ([
                ['ts' => $bucket['firstTs'], 'value' => $bucket['firstValue']],
                ['ts' => $bucket['minTs'], 'value' => $bucket['minValue']],
                ['ts' => $bucket['maxTs'], 'value' => $bucket['maxValue']],
                ['ts' => $bucket['lastTs'], 'value' => $bucket['lastValue']]
            ] as $point) {
                $pointMap[(string)$point['ts']] = $point;
            }
        }
        unset($buckets);

        $prev = @AC_GetLoggedValues($archiveID, $varID, 0, $rangeStart - 1, 1);
        if (is_array($prev) && count($prev) > 0) {
            $pointMap[(string)$rangeStart] = [
                'ts' => $rangeStart,
                'value' => max(0.0, (float)($prev[0]['Value'] ?? 0.0))
            ];
        }

        if (count($pointMap) === 0) return [];
        ksort($pointMap, SORT_NUMERIC);
        $points = array_values($pointMap);
        if ((int)$points[0]['ts'] > $rangeStart) {
            array_unshift($points, [
                'ts' => $rangeStart,
                'value' => max(0.0, (float)$points[0]['value'])
            ]);
        }
        return $points;
    }

    private function IntegrateConsumptionPointsToHourlyWh(array $points, int $dayStart, int $dayEnd): ?array
    {
        if (count($points) < 2 || $dayEnd <= $dayStart) return null;
        $hourlyWh = array_fill(0, 24, 0.0);
        $have = false;

        for ($i = 0; $i < count($points); $i++) {
            $segmentStart = max($dayStart, (int)$points[$i]['ts']);
            $segmentEnd = ($i + 1 < count($points))
                ? min($dayEnd, (int)$points[$i + 1]['ts'])
                : $dayEnd;
            if ($segmentEnd <= $segmentStart) continue;

            $powerW = max(0.0, (float)$points[$i]['value']);
            $cursor = $segmentStart;
            while ($cursor < $segmentEnd) {
                $hour = max(0, min(23, (int)date('G', $cursor)));
                $hourEnd = min($segmentEnd, strtotime(date('Y-m-d H:00:00', $cursor)) + 3600);
                if ($hourEnd <= $cursor) break;
                $hourlyWh[$hour] += $powerW * (($hourEnd - $cursor) / 3600.0);
                $cursor = $hourEnd;
                $have = true;
            }
        }
        return $have ? $hourlyWh : null;
    }

    private function DetectEVChargingSessions(array $points, int $rangeStart, int $rangeEnd, array $learnedPattern = []): array
    {
        $sessions = [];
        $count = count($points);
        if ($count < 6) return $sessions;

        $absoluteThresholdW = max(1000.0, $this->ReadPropertyFloat('EVChargingDetectionThresholdKW') * 1000.0);
        $minimumRiseW = max(500.0, $this->ReadPropertyFloat('EVChargingMinRiseKW') * 1000.0);
        $expectedRiseW = max(500.0, $this->ReadPropertyFloat('EVChargingExpectedRiseKW') * 1000.0);
        $riseToleranceW = max(200.0, $this->ReadPropertyFloat('EVChargingRiseToleranceKW') * 1000.0);
        $minDurationS = max(60, $this->ReadPropertyInteger('EVChargingMinimumDurationMinutes') * 60);
        $baselineWindowS = 20 * 60;
        $maxSessionKWh = 20.0;
        $minSessionKWh = 0.25;

        $patternSamples = max(0, (int)($learnedPattern['samples'] ?? 0));
        $patternPowerW = max(0.0, (float)($learnedPattern['chargePowerKW'] ?? 0.0) * 1000.0);
        $targetRiseW = ($patternSamples >= 2 && $patternPowerW >= 2000.0) ? $patternPowerW : $expectedRiseW;
        // Das gelernte Muster darf die vom Benutzer konfigurierte typische Ladeleistung
        // nur sanft nachführen. Es darf niemals eine klare Startflanke ausfiltern.
        $targetRiseW = max($expectedRiseW - $riseToleranceW, min($expectedRiseW + $riseToleranceW, $targetRiseW));

        $i = 1;
        while ($i < $count - 2) {
            $ts = (int)($points[$i]['ts'] ?? 0);
            if ($ts < $rangeStart || $ts >= $rangeEnd) { $i++; continue; }

            // Grundlast unmittelbar vor dem Ladebeginn. Median verhindert, dass kurze
            // normale Hauslast-Spitzen die Referenz unbrauchbar machen.
            $historyValues = [];
            $historyStart = $ts - $baselineWindowS;
            for ($k = $i - 1; $k >= 0; $k--) {
                $hTs = (int)($points[$k]['ts'] ?? 0);
                if ($hTs < $historyStart) break;
                $historyValues[] = max(0.0, (float)($points[$k]['value'] ?? 0.0));
            }
            if (count($historyValues) < 3) { $i++; continue; }
            $baselineW = $this->Median($historyValues);

            $avgW = max(0.0, (float)($points[$i]['value'] ?? 0.0));
            $prevAvgW = max(0.0, (float)($points[$i - 1]['value'] ?? 0.0));
            $minW = max(0.0, (float)($points[$i]['min'] ?? $avgW));
            $maxW = max(0.0, (float)($points[$i]['max'] ?? $avgW));
            $maxTime = (int)($points[$i]['maxTime'] ?? $ts);

            // Startkriterium: Der ungefähre Leistungsanstieg ist entscheidend.
            // Beispiel aus dem realen Archiv: ca. 1,2 kW -> 7,3...8,5 kW,
            // also rund 6...7 kW zusätzliche Last innerhalb weniger Sekunden.
            // Die Reihenfolge von MinTime/MaxTime wird absichtlich NICHT vorausgesetzt,
            // da Archive bei Aggregaten nicht immer eine belastbare Flankenreihenfolge liefern.
            $edgeInsideMinuteW = max(0.0, $maxW - $minW);
            $edgeVsBaselineW = max(0.0, $maxW - $baselineW);
            $edgeVsPreviousMinuteW = max(0.0, $avgW - $prevAvgW);
            $candidateRiseW = max($edgeInsideMinuteW, $edgeVsBaselineW, $edgeVsPreviousMinuteW);

            $matchesExpectedRise = abs($candidateRiseW - $targetRiseW) <= $riseToleranceW;
            $isStrongRise = $candidateRiseW >= $minimumRiseW;
            if (!$matchesExpectedRise && !$isStrongRise) { $i++; continue; }

            // Direkt nach dem Sprung muss die Last mehrere Minuten deutlich über der
            // vorherigen Grundlast bleiben. Das verhindert Fehlalarme durch kurze Spitzen.
            $holdExtraW = max(1800.0, min($targetRiseW - $riseToleranceW * 0.50, $candidateRiseW * 0.60));
            $holdExtraW = max(1800.0, $holdExtraW);
            $highMinutes = 0;
            for ($k = $i; $k < min($count, $i + 6); $k++) {
                $v = max(0.0, (float)($points[$k]['value'] ?? 0.0));
                $vMax = max($v, (float)($points[$k]['max'] ?? $v));
                if ($v >= $baselineW + $holdExtraW || $vMax >= $baselineW + $minimumRiseW) $highMinutes++;
            }
            if ($highMinutes < 2) { $i++; continue; }

            $startIndex = $i;
            $startTs = ($maxTime >= $ts && $maxTime < $ts + 60) ? $maxTime : $ts;
            $returnBandW = max(1200.0, min(2500.0, $targetRiseW * 0.28));
            $sessionHighValues = [];
            $lowMinutes = 0;
            $endTs = 0;
            $endIndex = 0;
            $confirmedDrop = false;

            for ($j = $startIndex; $j < $count; $j++) {
                $pTs = (int)($points[$j]['ts'] ?? 0);
                if ($pTs >= $rangeEnd) break;
                $pAvg = max(0.0, (float)($points[$j]['value'] ?? 0.0));
                $pMin = max(0.0, (float)($points[$j]['min'] ?? $pAvg));
                $pMax = max(0.0, (float)($points[$j]['max'] ?? $pAvg));
                $pMinTime = (int)($points[$j]['minTime'] ?? $pTs);

                $extraAvg = max(0.0, $pAvg - $baselineW);
                if ($extraAvg >= max(1200.0, $targetRiseW * 0.35) || $pMax >= $baselineW + $minimumRiseW) {
                    $sessionHighValues[] = $extraAvg > 0 ? $extraAvg : max(0.0, $pMax - $baselineW);
                    $lowMinutes = 0;
                } elseif ($pAvg <= $baselineW + $returnBandW || $pMin <= $baselineW + $returnBandW) {
                    $lowMinutes++;
                } else {
                    $lowMinutes = 0;
                }

                // Ende: zwei aufeinanderfolgende Minuten zurück nahe Grundlast.
                // Eine einzelne Minute darf wegen anderer Verbraucher schwanken.
                if ($j > $startIndex + 1 && $lowMinutes >= 2) {
                    $endTs = ($pMinTime >= $pTs && $pMinTime < $pTs + 60) ? $pMinTime : $pTs;
                    $endIndex = $j;
                    $confirmedDrop = true;
                    break;
                }
            }

            if ($endTs <= $startTs) {
                // Für abgeschlossene historische Tage verlangen wir eine Rückkehr der Last.
                // Ein offener Vorgang am aktuellen Rand wird nicht vorschnell klassifiziert.
                $i++;
                continue;
            }

            $durationS = $endTs - $startTs;
            if ($durationS < $minDurationS) {
                $i = max($i + 1, $endIndex > 0 ? $endIndex : $i + 1);
                continue;
            }

            $usableHigh = array_values(array_filter($sessionHighValues, static fn($v) => $v > 500.0));
            if (count($usableHigh) < 2) { $i++; continue; }
            $medianExtraW = $this->Median($usableHigh);

            // Die typische Zusatzleistung muss zum konfigurierten/erlernten Ladeanstieg
            // passen oder zumindest oberhalb des Mindestanstiegs liegen. Keine weitere
            // Plateau-Quote kann einen klaren Ladevorgang wieder verwerfen.
            $powerMatches = abs($medianExtraW - $targetRiseW) <= max($riseToleranceW, $targetRiseW * 0.35);
            if (!$powerMatches && $medianExtraW < $minimumRiseW * 0.75) {
                $i = max($i + 1, $endIndex > 0 ? $endIndex : $i + 1);
                continue;
            }

            $extraWh = 0.0;
            $capW = max($minimumRiseW, $targetRiseW + $riseToleranceW);
            for ($k = $startIndex; $k < $count; $k++) {
                $segStart = max($startTs, (int)($points[$k]['ts'] ?? 0));
                if ($segStart >= $endTs) break;
                $segEnd = ($k + 1 < $count) ? min($endTs, (int)($points[$k + 1]['ts'] ?? 0)) : $endTs;
                if ($segEnd <= $segStart) continue;
                $extraW = max(0.0, (float)($points[$k]['value'] ?? 0.0) - $baselineW);
                $extraW = min($extraW, $capW);
                $extraWh += $extraW * (($segEnd - $segStart) / 3600.0);
            }
            $extraKWh = $extraWh / 1000.0;
            if ($extraKWh < $minSessionKWh || $extraKWh > $maxSessionKWh) {
                $i = max($i + 1, $endIndex > 0 ? $endIndex : $i + 1);
                continue;
            }

            $patternMatch = abs($medianExtraW - $targetRiseW) <= max($riseToleranceW, $targetRiseW * 0.30);
            $sessions[] = [
                'start' => $startTs,
                'end' => $endTs,
                'baselineW' => $baselineW,
                'chargePowerW' => $medianExtraW,
                'initialRiseW' => $candidateRiseW,
                'plateauCoverage' => 1.0,
                'confirmedDrop' => $confirmedDrop,
                'patternMatch' => $patternMatch,
                'extraKWh' => $extraKWh,
                'thresholdW' => $absoluteThresholdW,
                'minRiseW' => $minimumRiseW,
                'expectedRiseW' => $expectedRiseW,
                'riseToleranceW' => $riseToleranceW,
                'edgeType' => $matchesExpectedRise ? 'expected-rise' : 'strong-rise'
            ];

            $i = max($i + 1, $endIndex > 0 ? $endIndex + 1 : $i + 1);
        }
        return $sessions;
    }

    private function GetEVChargingPattern(): array
    {
        $pattern = json_decode($this->ReadAttributeString('EVChargingPatternJSON'), true);
        if (!is_array($pattern)) return [];
        // Ein Muster ist nur fuer die Einstellungen gueltig, mit denen es gelernt wurde.
        // Aendert der Benutzer Schwelle oder Mindestanstieg, beeinflusst das alte Muster
        // die neue Archivsuche nicht; nach dem Suchlauf wird automatisch neu gelernt.
        $thresholdKW = max(1.0, $this->ReadPropertyFloat('EVChargingDetectionThresholdKW'));
        $maxEnergyKWh = max(0.1, $this->ReadPropertyFloat('EVChargingMaxEnergyKWh'));
        $minRiseKW = max(0.5, $this->ReadPropertyFloat('EVChargingMinRiseKW'));
        $expectedRiseKW = max(0.5, $this->ReadPropertyFloat('EVChargingExpectedRiseKW'));
        $riseToleranceKW = max(0.2, $this->ReadPropertyFloat('EVChargingRiseToleranceKW'));
        $minimumDurationMinutes = max(1, $this->ReadPropertyInteger('EVChargingMinimumDurationMinutes'));
        if (isset($pattern['thresholdKW']) && abs((float)$pattern['thresholdKW'] - $thresholdKW) > 0.0001) return [];
        if (isset($pattern['maxEnergyKWh']) && abs((float)$pattern['maxEnergyKWh'] - $maxEnergyKWh) > 0.0001) return [];
        if (isset($pattern['minRiseKW']) && abs((float)$pattern['minRiseKW'] - $minRiseKW) > 0.0001) return [];
        if (isset($pattern['expectedRiseKW']) && abs((float)$pattern['expectedRiseKW'] - $expectedRiseKW) > 0.0001) return [];
        if (isset($pattern['riseToleranceKW']) && abs((float)$pattern['riseToleranceKW'] - $riseToleranceKW) > 0.0001) return [];
        if (isset($pattern['minimumDurationMinutes']) && (int)$pattern['minimumDurationMinutes'] !== $minimumDurationMinutes) return [];
        return $pattern;
    }

    private function RebuildEVChargingPatternFromStoredDetections(): array
    {
        $stored = json_decode($this->ReadAttributeString('EVArchiveDetectionsJSON'), true);
        if (!is_array($stored)) $stored = [];

        $powers = [];
        $durations = [];
        $energies = [];
        foreach ($stored as $day) {
            if (!is_array($day) || (int)($day['version'] ?? 0) !== 12) continue;
            foreach (($day['details'] ?? []) as $detail) {
                if (!is_array($detail)) continue;
                $powerKW = max(0.0, (float)($detail['chargePowerW'] ?? 0.0) / 1000.0);
                $start = (int)($detail['start'] ?? 0);
                $end = (int)($detail['end'] ?? 0);
                $kWh = max(0.0, (float)($detail['kWh'] ?? 0.0));
                if ($powerKW < 1.0 || $powerKW > 22.0 || $end <= $start || $kWh <= 0.0) continue;
                $powers[] = $powerKW;
                $durations[] = ($end - $start) / 60.0;
                $energies[] = $kWh;
            }
        }

        if (count($powers) === 0) {
            $pattern = [
                'version' => 1,
                'samples' => 0,
                'thresholdKW' => max(1.0, $this->ReadPropertyFloat('EVChargingDetectionThresholdKW')),
                'maxEnergyKWh' => max(0.1, $this->ReadPropertyFloat('EVChargingMaxEnergyKWh')),
                'minRiseKW' => max(0.5, $this->ReadPropertyFloat('EVChargingMinRiseKW')),
                'expectedRiseKW' => max(0.5, $this->ReadPropertyFloat('EVChargingExpectedRiseKW')),
                'riseToleranceKW' => max(0.2, $this->ReadPropertyFloat('EVChargingRiseToleranceKW')),
                'minimumDurationMinutes' => max(1, $this->ReadPropertyInteger('EVChargingMinimumDurationMinutes')),
                'updated' => time()
            ];
            $this->WriteAttributeString('EVChargingPatternJSON', json_encode($pattern));
            return $pattern;
        }

        $pattern = [
            'version' => 1,
            'samples' => count($powers),
            'thresholdKW' => max(1.0, $this->ReadPropertyFloat('EVChargingDetectionThresholdKW')),
            'maxEnergyKWh' => max(0.1, $this->ReadPropertyFloat('EVChargingMaxEnergyKWh')),
            'minRiseKW' => max(0.5, $this->ReadPropertyFloat('EVChargingMinRiseKW')),
            'expectedRiseKW' => max(0.5, $this->ReadPropertyFloat('EVChargingExpectedRiseKW')),
            'riseToleranceKW' => max(0.2, $this->ReadPropertyFloat('EVChargingRiseToleranceKW')),
            'minimumDurationMinutes' => max(1, $this->ReadPropertyInteger('EVChargingMinimumDurationMinutes')),
            'chargePowerKW' => round($this->Median($powers), 3),
            'durationMin' => round($this->Median($durations), 1),
            'sessionKWh' => round($this->Median($energies), 3),
            'updated' => time()
        ];
        $this->WriteAttributeString('EVChargingPatternJSON', json_encode($pattern));
        return $pattern;
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
        $isPastDay = $dayEnd <= strtotime('today 00:00:00');
        $cacheKey = date('Y-m-d', $dayStart) . '|' . $archiveID . '|' . $varID . '|agg';

        if ($isPastDay) {
            $cache = json_decode((string)$this->GetBuffer('ConsumptionHourlyCache'), true);
            if (is_array($cache) && isset($cache[$cacheKey]) && is_array($cache[$cacheKey]) && count($cache[$cacheKey]) === 24) {
                return array_values($cache[$cacheKey]);
            }
        }

        // Auch die Diagramm-Istwerte ausschließlich aus Archiv-Aggregaten lesen.
        // Abgeschlossene Tage benötigen nur 24 Stundenaggregate. Für heute werden
        // 1-Minuten-Aggregate integriert, damit die laufende Stunde nicht fälschlich
        // als volle Stunde hochgerechnet wird.
        $integrationEnd = min($dayEnd, time());
        if ($integrationEnd <= $dayStart) return null;
        if ($isPastDay) {
            $hourlyWh = $this->GetHourlyConsumptionWhFromAggregates($archiveID, $varID, $dayStart, $integrationEnd);
        } else {
            $points = $this->GetMinuteConsumptionPowerPoints($archiveID, $varID, $dayStart, $integrationEnd);
            $hourlyWh = count($points) >= 2
                ? $this->IntegrateConsumptionPointsToHourlyWh($points, $dayStart, $integrationEnd)
                : null;
        }
        if (!is_array($hourlyWh) || count($hourlyWh) !== 24) return null;

        $result = array_map(static fn($wh) => max(0.0, (float)$wh) / 1000.0, $hourlyWh);
        if ($isPastDay) {
            $cache = json_decode((string)$this->GetBuffer('ConsumptionHourlyCache'), true);
            if (!is_array($cache)) $cache = [];
            $cache[$cacheKey] = $result;
            if (count($cache) > 120) $cache = array_slice($cache, -120, null, true);
            $this->SetBuffer('ConsumptionHourlyCache', json_encode($cache));
        }
        return $result;
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
        $dayEnd = $dayStart + 86400;
        $isPastDay = $dayEnd <= strtotime('today 00:00:00');
        $surfaceFingerprint = sha1($this->ReadPropertyString('PVSurfaces') . '|' . $this->ReadPropertyInteger('PVActualPowerVariable'));
        $cacheKey = date('Y-m-d', $dayStart) . '|' . $surfaceFingerprint;
        if ($isPastDay) {
            $cache = json_decode((string)$this->GetBuffer('PVActualHourlyCache'), true);
            if (is_array($cache) && isset($cache[$cacheKey]) && is_array($cache[$cacheKey])) {
                return $cache[$cacheKey];
            }
        }

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
        if ($isPastDay) {
            $cache = json_decode((string)$this->GetBuffer('PVActualHourlyCache'), true);
            if (!is_array($cache)) $cache = [];
            $cache[$cacheKey] = $result;
            if (count($cache) > 45) $cache = array_slice($cache, -45, null, true);
            $this->SetBuffer('PVActualHourlyCache', json_encode($cache));
        }
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

    private function BuildCurrentPriceArchivePoints(array $prices): array
    {
        $provider = $this->ReadPropertyInteger('PriceProvider');
        $now = time();
        $points = [];
        foreach ($prices as $p) {
            $start = (int)($p['start'] ?? 0);
            $end = (int)($p['end'] ?? 0);
            if ($start <= 0 || $end <= $start || $start > $now) continue;

            // EPEX/aWATTar/benutzerdefinierter EPEX-Tarif werden intern zwar in
            // 15-Minuten-Slots erweitert, der Tarif selbst gilt aber stündlich.
            // Deshalb nur den Start jeder vollen Stunde archivieren. Bei einer eigenen
            // JSON-Quelle bleiben deren normalisierte Slotstarts erhalten.
            if ($provider !== 2 && date('i:s', $start) !== '00:00') continue;
            $points[$start] = (float)($p['priceCt'] ?? 0.0);
        }
        ksort($points);
        return $points;
    }

    private function SyncCurrentPriceArchiveTimeline(array $prices): void
    {
        $archiveID = $this->FindArchive();
        $priceVarID = (int)@$this->GetIDForIdent('CurrentPrice');
        if ($archiveID <= 0 || $priceVarID <= 0 || !function_exists('AC_AddLoggedValues')) return;

        $points = $this->BuildCurrentPriceArchivePoints($prices);
        if (count($points) === 0) return;

        try {
            // Zufällige Live-Schreibzeitpunkte verhindern. Das Modul pflegt die
            // Preis-Zeitreihe selbst mit den originalen Tarifstarts.
            if (AC_GetLoggingStatus($archiveID, $priceVarID)) AC_SetLoggingStatus($archiveID, $priceVarID, false);
            if (AC_GetAggregationType($archiveID, $priceVarID) !== 0) AC_SetAggregationType($archiveID, $priceVarID, 0);

            $timestamps = array_map('intval', array_keys($points));
            $fromTs = min($timestamps);
            $toTs = min(time(), max($timestamps) + ($this->ReadPropertyInteger('PriceProvider') === 2 ? 900 : 3600) - 1);

            // v1.10.39: einmalige Reparatur des noch bekannten historischen Bereichs.
            // Nur der Zeitraum, dessen echte Preise noch in PricesJSON vorhanden sind,
            // wird bereinigt. Aeltere unbekannte Preiswerte bleiben unangetastet.
            if ($this->ReadAttributeInteger('PriceArchiveAlignmentVersion') < 1) {
                @AC_DeleteVariableData($archiveID, $priceVarID, $fromTs, $toTs);
                $this->AddArchiveLoggedValues($archiveID, $priceVarID, $points);
                $this->WriteAttributeInteger('PriceArchiveAlignmentVersion', 1);
                $this->WriteAttributeInteger('PriceArchiveLastSyncedTs', max($timestamps));
                $this->DebugLog('Preisarchiv', 'v1.10.39: Preisarchiv rueckwirkend aus PricesJSON neu ausgerichtet | ' . date('d.m.Y H:i:s', $fromTs) . ' bis ' . date('d.m.Y H:i:s', $toTs) . ' | Punkte=' . count($points));
                return;
            }

            // Laufende Synchronisierung idempotent: vorhandene exakte Tarifstarts
            // beibehalten, geaenderte Tarife am gleichen Startzeitpunkt ersetzen.
            $existingRows = @AC_GetLoggedValues($archiveID, $priceVarID, $fromTs, $toTs, 0);
            $existing = [];
            if (is_array($existingRows)) {
                foreach ($existingRows as $row) {
                    $ts = (int)($row['TimeStamp'] ?? 0);
                    if ($ts > 0) $existing[$ts] = (float)($row['Value'] ?? 0.0);
                }
            }
            $toAdd = [];
            foreach ($points as $ts => $price) {
                $ts = (int)$ts;
                if (!array_key_exists($ts, $existing)) {
                    $toAdd[$ts] = (float)$price;
                    continue;
                }
                if (abs((float)$existing[$ts] - (float)$price) > 0.00001) {
                    @AC_DeleteVariableData($archiveID, $priceVarID, $ts, $ts);
                    $toAdd[$ts] = (float)$price;
                }
            }
            if (count($toAdd) > 0) $this->AddArchiveLoggedValues($archiveID, $priceVarID, $toAdd);
            $this->WriteAttributeInteger('PriceArchiveLastSyncedTs', max($timestamps));
        } catch (Throwable $e) {
            $this->DebugLog('Preisarchiv', 'Synchronisierung fehlgeschlagen: ' . $e->getMessage(), 0);
        }
    }

    private function ArchiveCurrentPriceAtTariffStart(int $slotStart, float $priceCt): void
    {
        if ($slotStart <= 0 || $slotStart > time()) return;
        $provider = $this->ReadPropertyInteger('PriceProvider');
        if ($provider !== 2) {
            $slotStart = strtotime(date('Y-m-d H:00:00', $slotStart));
        }
        if ($slotStart <= 0) return;
        if ($this->ReadAttributeInteger('PriceArchiveLastSyncedTs') === $slotStart) return;

        $archiveID = $this->FindArchive();
        $priceVarID = (int)@$this->GetIDForIdent('CurrentPrice');
        if ($archiveID <= 0 || $priceVarID <= 0 || !function_exists('AC_AddLoggedValues')) return;
        try {
            if (AC_GetLoggingStatus($archiveID, $priceVarID)) AC_SetLoggingStatus($archiveID, $priceVarID, false);
            $existing = @AC_GetLoggedValues($archiveID, $priceVarID, $slotStart, $slotStart, 1);
            $same = is_array($existing) && count($existing) > 0
                && (int)($existing[0]['TimeStamp'] ?? 0) === $slotStart
                && abs((float)($existing[0]['Value'] ?? 0.0) - $priceCt) <= 0.00001;
            if (!$same) {
                @AC_DeleteVariableData($archiveID, $priceVarID, $slotStart, $slotStart);
                $this->AddArchiveLoggedValues($archiveID, $priceVarID, [$slotStart => $priceCt]);
            }
            $this->WriteAttributeInteger('PriceArchiveLastSyncedTs', $slotStart);
        } catch (Throwable $e) {
            $this->DebugLog('Preisarchiv', 'Tarifstart konnte nicht archiviert werden: ' . $e->getMessage(), 0);
        }
    }

    private function FindCurrentPrice(array $prices): float
    {
        $now = time();
        foreach ($prices as $p) if ($now >= $p['start'] && $now < $p['end']) return (float)$p['priceCt'];
        return 0.0;
    }

    private function UpdateCurrentPriceVariable(?array $prices = null): void
    {
        if ($prices === null) {
            // Während RecalculateInternal() ein neues Preisraster lädt, darf ein
            // paralleler ControlTimer den archivierten aktuellen Preis nicht aus
            // dem noch alten PricesJSON zurückschreiben. Der Berechnungslauf setzt
            // CurrentPrice nach dem Speichern des neuen Preisrasters selbst.
            if ($this->ReadAttributeInteger('CalculationLockUntil') > time()) {
                return;
            }
            $prices = json_decode($this->ReadAttributeString('PricesJSON'), true);
        }
        if (!is_array($prices) || count($prices) === 0) return;

        $now = time();
        $known = false;
        $priceCt = 0.0;
        $priceStart = 0;
        foreach ($prices as $p) {
            $start = (int)($p['start'] ?? 0);
            $end = (int)($p['end'] ?? 0);
            if ($start <= 0 || $end <= $start) continue;
            if ($now >= $start && $now < $end) {
                $priceCt = (float)($p['priceCt'] ?? 0.0);
                $priceStart = $start;
                $known = true;
                break;
            }
        }
        if (!$known) return;

        // Unabhaengig vom Zeitpunkt dieses Timerlaufs wird der Preis im Archiv auf
        // den Beginn seines Tarifintervalls gelegt (bei EPEX 60 min auf HH:00:00).
        $this->ArchiveCurrentPriceAtTariffStart($priceStart, $priceCt);

        $id = (int)@$this->GetIDForIdent('CurrentPrice');
        if ($id <= 0) return;
        $old = (float)GetValue($id);
        if (abs($old - $priceCt) > 0.00001) {
            SetValue($id, $priceCt);
        }
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
            $this->MaintainVariable($this->PVCalibrationIdent('Expected', $idx), 'PV Kalibrierung Prognose ' . $name, VARIABLETYPE_FLOAT, '~Electricity', 300 + $idx * 2, true);
            $this->MaintainVariable($this->PVCalibrationIdent('Actual', $idx), 'PV Kalibrierung Ist ' . $name, VARIABLETYPE_FLOAT, '~Electricity', 301 + $idx * 2, true);
            $forecastVarID = (int)@$this->GetIDForIdent($this->PVCalibrationIdent('Expected', $idx));
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
            // Prognose und Ist bilden ab v1.9.98 ein gemeinsames Stundenpaar.
            $actualID = (int)@$this->GetIDForIdent($this->PVCalibrationIdent('Actual', $idx));
            if ($actualID > 0) {
                @IPS_SetHidden($actualID, true);
                try { @AC_SetLoggingStatus($archiveID, $actualID, true); } catch (Throwable $e) {}
            }
        }

        // Netzbezug / Netzeinspeisung (W) für Fallback der realen Einspeisestatistik sicher archivieren.
        $gridVarID = $this->ReadPropertyInteger('PVCalibrationFeedInVariable');
        if ($gridVarID > 0 && @IPS_VariableExists($gridVarID)) {
            try {
                if (!AC_GetLoggingStatus($archiveID, $gridVarID)) AC_SetLoggingStatus($archiveID, $gridVarID, true);
                if (AC_GetAggregationType($archiveID, $gridVarID) !== 0) AC_SetAggregationType($archiveID, $gridVarID, 0);
            } catch (Throwable $e) {
                $this->DebugLog('ArchiveStorage', 'Netzbezug/Netzeinspeisung ' . $gridVarID . ': ' . $e->getMessage(), 0);
            }
        }

        // Optionale kumulative Netzeinspeise-Energievariable (kWh) für die
        // Einspeise-Statistik sicher archivieren. Die vorhandene Aggregationsart wird
        // bewusst nicht verändert; benötigt werden die originalen geloggten Zählerstände.
        $gridEnergyVarID = $this->ReadPropertyInteger('GridExportEnergyVariable');
        if ($gridEnergyVarID > 0 && @IPS_VariableExists($gridEnergyVarID)) {
            try {
                if (!AC_GetLoggingStatus($archiveID, $gridEnergyVarID)) AC_SetLoggingStatus($archiveID, $gridEnergyVarID, true);
            } catch (Throwable $e) {
                $this->DebugLog('ArchiveStorage', 'Netzeinspeisung Energie (kWh) ' . $gridEnergyVarID . ': ' . $e->getMessage(), 0);
            }
        }

        // Den berechneten Einspeisetarif als saubere Tarif-Zeitreihe archivieren.
        // Automatisches Logging bleibt bewusst AUS: SetValue(CurrentPrice) kann zu einer
        // beliebigen Refresh-Uhrzeit erfolgen. Die Archivwerte werden stattdessen vom
        // Modul exakt auf die Gültigkeitszeit des Tarifs (EPEX 60 min: volle Stunde)
        // geschrieben. So entstehen keine künstlichen Zwischenpunkte wie 13:24:17.
        $currentPriceID = (int)@$this->GetIDForIdent('CurrentPrice');
        if ($currentPriceID > 0) {
            try {
                if (AC_GetLoggingStatus($archiveID, $currentPriceID)) AC_SetLoggingStatus($archiveID, $currentPriceID, false);
                if (AC_GetAggregationType($archiveID, $currentPriceID) !== 0) AC_SetAggregationType($archiveID, $currentPriceID, 0);
                if (function_exists('AC_SetGraphStatus')) @AC_SetGraphStatus($archiveID, $currentPriceID, false);
                $cachedPriceTimeline = json_decode($this->ReadAttributeString('PricesJSON'), true);
                if (is_array($cachedPriceTimeline) && count($cachedPriceTimeline) > 0) {
                    $this->SyncCurrentPriceArchiveTimeline($cachedPriceTimeline);
                }
            } catch (Throwable $e) {
                $this->DebugLog('ArchiveStorage', 'Aktueller Einspeisepreis ' . $currentPriceID . ': ' . $e->getMessage(), 0);
            }
        }

        // Ab v1.10.01 werden vorhandene Kalibrierarchive bei Updates niemals pauschal gelöscht.

        $feedVars = [
            'FeedInArchiveKWh' => ['Einspeiseautomatik Energie je Fenster', '~Electricity', 360],
            'FeedInArchiveEUR' => ['Einspeiseautomatik Erlös je Fenster', '', 361],
            'FeedInArchiveTargetKWh' => ['Einspeiseautomatik Planmenge je Fenster', '~Electricity', 362],
            'FeedInArchiveWindow' => ['Einspeiseautomatik Fenster', '', 363],
            'FeedInArchiveStartTs' => ['Einspeiseautomatik Startzeit', '', 364],
            'FeedInArchiveEndTs' => ['Einspeiseautomatik Endzeit', '', 365]
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
                $idClean = (int)@$this->GetIDForIdent($this->PVCalibrationIdent('Expected', $idxClean));
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
            return [(int)@$this->GetIDForIdent($this->PVCalibrationIdent('Expected', $idx)), 0];
        }
        return [0, 0];
    }

    private function AddArchiveLoggedValues(int $archiveID, int $variableID, array $values): void
    {
        if ($archiveID <= 0 || $variableID <= 0 || count($values) === 0 || !function_exists('AC_AddLoggedValues')) return;
        ksort($values);
        $rows = [];
        $now = time();
        foreach ($values as $ts => $value) {
            $ts = (int)$ts;
            if ($ts > $now) {
                $this->DebugLog('Archiv', 'Zukunftswert verworfen | Variable=' . $variableID . ' | Zeit=' . date('d.m.Y H:i:s', $ts), 0);
                continue;
            }
            $rows[] = ['TimeStamp'=>$ts, 'Value'=>(float)$value];
        }
        if (count($rows) === 0) return;

        // AC_AddLoggedValues() akzeptiert nur Variablen mit aktivem Logging.
        // Einige vom Modul selbst gepflegte Archiv-Zeitreihen (z. B. CurrentPrice)
        // haben automatisches Logging absichtlich AUS, damit ein normales SetValue()
        // keinen Punkt zur zufaelligen Refresh-Uhrzeit erzeugt. Fuer den gezielten
        // historischen Schreibvorgang Logging deshalb nur temporaer aktivieren und
        // danach exakt auf den vorherigen Zustand zurueckstellen.
        $restoreLogging = false;
        try {
            if (function_exists('AC_GetLoggingStatus') && function_exists('AC_SetLoggingStatus')) {
                $wasLogging = (bool)AC_GetLoggingStatus($archiveID, $variableID);
                if (!$wasLogging) {
                    AC_SetLoggingStatus($archiveID, $variableID, true);
                    $restoreLogging = true;
                    if (!AC_GetLoggingStatus($archiveID, $variableID)) {
                        throw new Exception('Archiv-Logging konnte fuer Variable ' . $variableID . ' nicht aktiviert werden.');
                    }
                }
            }
            foreach (array_chunk($rows, 2000) as $chunk) {
                AC_AddLoggedValues($archiveID, $variableID, $chunk);
            }
            if (function_exists('AC_ReAggregateVariable')) @AC_ReAggregateVariable($archiveID, $variableID);
        } finally {
            if ($restoreLogging && function_exists('AC_SetLoggingStatus')) {
                @AC_SetLoggingStatus($archiveID, $variableID, false);
            }
        }
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
            $expectedID = (int)@$this->GetIDForIdent($this->PVCalibrationIdent('Expected', $idx));
            $actualID = (int)@$this->GetIDForIdent($this->PVCalibrationIdent('Actual', $idx));
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
        // Prognosen nicht mehr vorab ins Archiv schreiben. Stattdessen wird für jede
        // Fläche/Stunde der erste verfügbare Roh-Forecast intern eingefroren. Nach Ende
        // der Stunde schreibt FinalizePVCalibrationCompletedHours Prognose und Ist
        // gemeinsam mit identischem Endzeitstempel in die Kalibrierungsvariablen.
        $pending = json_decode($this->ReadAttributeString('PVCalibrationPendingForecastJSON'), true);
        if (!is_array($pending)) $pending = [];
        $currentHour = strtotime(date('Y-m-d H:00:00'));

        foreach ($surfaces as $idx => $surface) {
            if (empty($surface['Active']) || empty($surface['AutoCalibrate'])) continue;
            $name = trim((string)($surface['Name'] ?? 'PV')); if ($name === '') $name = 'PV ' . ($idx + 1);
            $map = is_array($surfaceForecastHours[$name] ?? null) ? $surfaceForecastHours[$name] : [];
            if (!isset($pending[(string)$idx]) || !is_array($pending[(string)$idx])) $pending[(string)$idx] = [];
            foreach ($map as $ts => $kWh) {
                $ts = (int)$ts; $kWh = max(0.0, (float)$kWh);
                if ($ts < $currentHour) continue;
                // Erster Forecast für eine Stunde bleibt verbindlich; spätere Refreshes
                // verändern diesen Kalibrierungswert nicht mehr.
                if (!array_key_exists((string)$ts, $pending[(string)$idx])) {
                    $pending[(string)$idx][(string)$ts] = $kWh;
                }
            }
            ksort($pending[(string)$idx], SORT_NUMERIC);
        }

        // Alte, nicht mehr verwendbare Pending-Einträge begrenzen.
        $keepFrom = time() - max(7, $this->ReadPropertyInteger('PVCalibrationDays') + 3) * 86400;
        foreach ($pending as $idx => $hours) {
            if (!is_array($hours)) { unset($pending[$idx]); continue; }
            foreach ($hours as $ts => $_) if ((int)$ts < $keepFrom) unset($pending[$idx][$ts]);
        }
        $this->WriteAttributeString('PVCalibrationPendingForecastJSON', json_encode($pending));
    }

    private function IsPVCalibrationHourExcluded(int $startTs, int $endTs): bool
    {
        $periods = json_decode($this->ReadAttributeString('PVCalibrationExcludedPeriodsJSON'), true);
        if (!is_array($periods)) $periods = [];
        $activeFrom = $this->ReadAttributeInteger('PVCalibrationExclusionActiveFromTs');
        if ($activeFrom > 0) $periods[] = ['fromTs'=>$activeFrom, 'toTs'=>time()];
        foreach ($periods as $p) {
            if (!is_array($p)) continue;
            $a=(int)($p['fromTs']??0); $b=(int)($p['toTs']??0);
            if ($a < $endTs && $b > $startTs) return true;
        }
        return false;
    }

    private function ReadSurfaceActualEnergyKWhForHour(int $archiveID, array $surface, int $startTs, int $endTs): ?float
    {
        $sum = 0.0; $have = false;
        foreach (['PVVariable1','PVVariable2','PVVariable3'] as $field) {
            $id=(int)($surface[$field]??0); if($id<=0 || !@IPS_VariableExists($id)) continue;
            $rows=@AC_GetAggregatedValues($archiveID,$id,0,$startTs,$endTs-1,0);
            if(!is_array($rows) || count($rows)===0) continue;
            foreach($rows as $r){
                $dur=max(0,(int)($r['Duration']??3600));
                $sum += max(0.0,(float)($r['Avg']??0.0))*$dur/3600.0/1000.0;
                $have=true;
            }
        }
        return $have ? $sum : null;
    }

    private function FinalizePVCalibrationCompletedHours(): void
    {
        if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') < 1) return;
        $archiveID=$this->FindArchive(); if($archiveID<=0) return;
        $surfaces=json_decode($this->ReadPropertyString('PVSurfaces'),true); if(!is_array($surfaces))return;
        $pending=json_decode($this->ReadAttributeString('PVCalibrationPendingForecastJSON'),true); if(!is_array($pending))$pending=[];
        $now=time(); $written=0;

        foreach($surfaces as $idx=>$surface){
            if(empty($surface['Active']) || empty($surface['AutoCalibrate']))continue;
            $expectedID=(int)@$this->GetIDForIdent($this->PVCalibrationIdent('Expected', $idx));
            $actualID=(int)@$this->GetIDForIdent($this->PVCalibrationIdent('Actual', $idx));
            if($expectedID<=0 || $actualID<=0)continue;
            $hours=is_array($pending[(string)$idx]??null)?$pending[(string)$idx]:[];
            foreach($hours as $startRaw=>$expectedKWh){
                $startTs=(int)$startRaw; $endTs=$startTs+3600;
                if($startTs<=0 || $endTs>$now)continue;
                // Nur komplett gültige Stunden erzeugen ein Paar. Bei Sperre/Abregelung
                // werden Prognose UND Ist verworfen.
                if($this->IsPVCalibrationHourExcluded($startTs,$endTs)){
                    unset($pending[(string)$idx][$startRaw]); continue;
                }
                $actualKWh=$this->ReadSurfaceActualEnergyKWhForHour($archiveID,$surface,$startTs,$endTs);
                if($actualKWh===null){ continue; }

                $e=@AC_GetLoggedValues($archiveID,$expectedID,$endTs,$endTs,1);
                $a=@AC_GetLoggedValues($archiveID,$actualID,$endTs,$endTs,1);
                if(!is_array($e)||count($e)===0) $this->AddArchiveLoggedValues($archiveID,$expectedID,[$endTs=>max(0.0,(float)$expectedKWh)]);
                if(!is_array($a)||count($a)===0) $this->AddArchiveLoggedValues($archiveID,$actualID,[$endTs=>max(0.0,(float)$actualKWh)]);
                unset($pending[(string)$idx][$startRaw]); $written++;
            }
        }
        $this->WriteAttributeString('PVCalibrationPendingForecastJSON',json_encode($pending));
        if($written>0)$this->DebugLog('PV-Kalibrierarchiv',$written.' Prognose/Ist-Paare abgeschlossener Stunden gespeichert.');
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

    public function BackfillPVCalibrationPairs(): string
    {
        $archiveID=$this->FindArchive();
        $surfaces=json_decode($this->ReadPropertyString('PVSurfaces'),true);
        if($archiveID<=0 || !is_array($surfaces)){
            $msg='Kalibrierung nachtragen: Archiv oder PV-Flächen nicht verfügbar.';
            $this->SetActionFeedback($msg); return $msg;
        }
        $days=max(1,$this->ReadPropertyInteger('PVCalibrationDays'));
        $from=time()-($days+3)*86400; $added=0; $missingForecast=0; $blocked=0;
        foreach($surfaces as $idx=>$surface){
            if(empty($surface['Active']) || empty($surface['AutoCalibrate']))continue;
            $expectedID=(int)@$this->GetIDForIdent($this->PVCalibrationIdent('Expected', $idx));
            $actualID=(int)@$this->GetIDForIdent($this->PVCalibrationIdent('Actual', $idx));
            if($expectedID<=0 || $actualID<=0)continue;
            $eRows=@AC_GetLoggedValues($archiveID,$expectedID,$from,time(),0); if(!is_array($eRows))$eRows=[];
            $forecast=[];
            foreach($eRows as $r){$end=(int)($r['TimeStamp']??0);$v=(float)($r['Value']??0);if($end>0&&$v>0)$forecast[$end]=$v;}
            if(count($forecast)===0){$missingForecast++;continue;}
            foreach($forecast as $endTs=>$exp){
                $startTs=$endTs-3600;if($startTs<=0||$endTs>time())continue;
                if($this->IsPVCalibrationHourExcluded($startTs,$endTs)){$blocked++;continue;}
                $exists=@AC_GetLoggedValues($archiveID,$actualID,$endTs,$endTs,1);
                if(is_array($exists)&&count($exists)>0)continue;
                $act=$this->ReadSurfaceActualEnergyKWhForHour($archiveID,$surface,$startTs,$endTs);
                if($act===null)continue;
                $this->AddArchiveLoggedValues($archiveID,$actualID,[$endTs=>$act]);$added++;
            }
        }
        $this->UpdatePVCalibrationState(true);
        $msg='Kalibrierung nachtragen: '.$added.' fehlende Ist-Werte zu vorhandenen historischen Prognosen ergänzt.'
            .($missingForecast>0?' Für '.$missingForecast.' Fläche(n) waren im Zeitraum keine historischen Prognosewerte vorhanden.':'')
            .($blocked>0?' '.$blocked.' gesperrte Stunden wurden ausgelassen.':'');
        $this->SetActionFeedback($msg); return $msg;
    }

    private function BuildPVCalibrationFromArchive(array $legacyCalibration = []): array
    {
        if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') < 1) return $legacyCalibration;
        $archiveID=$this->FindArchive(); if($archiveID<=0)return $legacyCalibration;
        $surfaces=json_decode($this->ReadPropertyString('PVSurfaces'),true); if(!is_array($surfaces))return $legacyCalibration;
        $result=[]; $days=max(1,$this->ReadPropertyInteger('PVCalibrationDays'));
        $startWindow=strtotime(date('Y-m-d 00:00:00',time()-($days+2)*86400));

        foreach($surfaces as $idx=>$surface){
            $name=trim((string)($surface['Name']??'PV')); if($name==='')$name='PV '.($idx+1);
            $key=$this->SurfaceKey($name,$idx);
            $expectedID=(int)@$this->GetIDForIdent($this->PVCalibrationIdent('Expected', $idx));
            $actualID=(int)@$this->GetIDForIdent($this->PVCalibrationIdent('Actual', $idx));
            if($expectedID<=0 || $actualID<=0)continue;
            $eRows=@AC_GetLoggedValues($archiveID,$expectedID,$startWindow,time(),0); if(!is_array($eRows))$eRows=[];
            $aRows=@AC_GetLoggedValues($archiveID,$actualID,$startWindow,time(),0); if(!is_array($aRows))$aRows=[];
            $expected=[];$actual=[];
            foreach($eRows as $r){$ts=(int)($r['TimeStamp']??0);if($ts>0)$expected[$ts]=(float)($r['Value']??0.0);}
            foreach($aRows as $r){$ts=(int)($r['TimeStamp']??0);if($ts>0)$actual[$ts]=(float)($r['Value']??0.0);}

            $entry=['factor'=>1.0,'energySamples'=>[],'seasonalArchive'=>[],'storageMode'=>'paired forecast/actual archive'];
            foreach($expected as $endTs=>$expKWh){
                if(!array_key_exists($endTs,$actual))continue;
                $startTs=$endTs-3600;
                if($startTs<=0 || $this->IsPVCalibrationHourExcluded($startTs,$endTs))continue;
                $actKWh=(float)$actual[$endTs];
                if($expKWh<=0 || $actKWh<0)continue;
                $entry['energySamples'][]=['ts'=>$startTs,'endTs'=>$endTs,'expectedKWh'=>(float)$expKWh,'actualKWh'=>$actKWh,'hour'=>(int)date('G',$startTs),'intervals'=>1];
            }
            $tmp=$this->RecalculatePVCalibrationFactors([$key=>$entry],$key);$result[$key]=$tmp[$key]??$entry;
        }
        return $result;
    }

    private function StoreFeedInStatisticArchive(float $delivered, float $revenue, float $target, int $startTs, int $endTs): void
    {
        $archiveID = $this->FindArchive(); if ($archiveID <= 0 || $this->ReadAttributeInteger('ArchiveStorageMigrationVersion') < 1) return;
        $ts=$endTs; $map = ['FeedInArchiveKWh'=>$delivered,'FeedInArchiveEUR'=>$revenue,'FeedInArchiveTargetKWh'=>$target,'FeedInArchiveWindow'=>1.0,'FeedInArchiveStartTs'=>(float)$startTs,'FeedInArchiveEndTs'=>(float)$endTs];
        foreach ($map as $ident=>$value) {
            $id=(int)@$this->GetIDForIdent($ident); if($id<=0) continue;
            try { AC_AddLoggedValues($archiveID,$id,[['TimeStamp'=>$ts,'Value'=>(float)$value]]); } catch(Throwable $e){ $this->DebugLog('FeedInArchive',$e->getMessage(),0); }
        }
    }

    private function ReadFeedInStatisticsFromArchive(): array
    {
        if ($this->ReadAttributeInteger('ArchiveStorageMigrationVersion') < 1) return [];
        $archiveID=$this->FindArchive(); if($archiveID<=0) return [];
        $ids=['kwh'=>(int)@$this->GetIDForIdent('FeedInArchiveKWh'),'eur'=>(int)@$this->GetIDForIdent('FeedInArchiveEUR'),'target'=>(int)@$this->GetIDForIdent('FeedInArchiveTargetKWh'),'window'=>(int)@$this->GetIDForIdent('FeedInArchiveWindow'),'start'=>(int)@$this->GetIDForIdent('FeedInArchiveStartTs'),'end'=>(int)@$this->GetIDForIdent('FeedInArchiveEndTs')];
        if($ids['kwh']<=0||$ids['eur']<=0||$ids['target']<=0||$ids['window']<=0) return [];
        $maps=[];
        foreach($ids as $k=>$id){ $maps[$k]=[]; if($id<=0) continue; $rows=@AC_GetLoggedValues($archiveID,$id,0,time(),0); if(is_array($rows)) foreach($rows as $r)$maps[$k][(int)$r['TimeStamp']]=(float)$r['Value']; }
        $out=[]; foreach($maps['window'] as $ts=>$one){ $kwh=(float)($maps['kwh'][$ts]??0); $eur=(float)($maps['eur'][$ts]??0); $start=(int)round((float)($maps['start'][$ts]??$ts)); $end=(int)round((float)($maps['end'][$ts]??$ts)); $out[]=['start'=>$start,'end'=>$end,'targetKWh'=>(float)($maps['target'][$ts]??0),'deliveredKWh'=>$kwh,'priceCt'=>$kwh>0?$eur/$kwh*100.0:0.0,'revenueEUR'=>$eur,'completed'=>true,'reason'=>'price','finishReason'=>'Archiv']; }
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

        // Plansegmente für die Anzeige zu Stundenwerten addieren. Bei einem über mehrere
        // Preisstunden zusammengefassten Plan darf nicht die Gesamtenergie in jedem Balken erscheinen.
        foreach (($plan['slots'] ?? []) as $slot) {
            $segments = isset($slot['segments']) && is_array($slot['segments']) ? $slot['segments'] : [$slot];
            foreach ($segments as $segment) {
                $slotStart = (int)($segment['start'] ?? 0);
                $slotEnd = isset($segment['end']) ? (int)$segment['end'] : ($slotStart + 900);
                if ($slotEnd <= $slotStart) continue;
                foreach ($hours as $hStart => &$h) {
                    $overlapStart = max($slotStart, $h['start']);
                    $overlapEnd = min($slotEnd, $h['end']);
                    if ($overlapEnd <= $overlapStart) continue;

                    $slotDuration = max(1, $slotEnd - $slotStart);
                    $fraction = ($overlapEnd - $overlapStart) / $slotDuration;
                    $h['energyKWh'] += (float)($segment['energyKWh'] ?? 0.0) * $fraction;

                    if (($segment['reason'] ?? 'price') === 'pv_space') {
                        $h['reasonPVSpace'] = true;
                    } else {
                        $h['reasonPrice'] = true;
                    }
                }
                unset($h);
            }
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
            foreach (($plan['slots'] ?? []) as $s) {
                $segments = isset($s['segments']) && is_array($s['segments']) ? $s['segments'] : [$s];
                foreach ($segments as $segment) {
                    $segStart = (int)($segment['start'] ?? ($segment['priceIntervalStart'] ?? 0));
                    $segEnd = (int)($segment['end'] ?? ($segment['priceIntervalEnd'] ?? 0));
                    if ($segStart < (int)$p['end'] && $segEnd > (int)$p['start']) {
                        $overlapStart = max($segStart, (int)$p['start']);
                        $overlapEnd = min($segEnd, (int)$p['end']);
                        $segDuration = max(1, $segEnd - $segStart);
                        $fraction = max(0.0, ($overlapEnd - $overlapStart) / $segDuration);
                        $slot = $segment;
                        $slot['energyKWh'] = max(0.0, (float)($segment['energyKWh'] ?? 0.0)) * $fraction;
                        break 2;
                    }
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

        if (preg_match('/Archiv gelernt\\s*[–-]\\s*([^,]+),\\s*saisonal\\s*([^,]+),\\s*(\\d+)\\s+Tage(?:,\\s*(\\d+)\\s+Autoladungen ausgeschlossen)?/ui', $source, $m)) {
            $text = 'aus Archiv · ' . (int)$m[3] . ' gültige Tage · ' . trim((string)$m[1]) . ' · ' . trim((string)$m[2]);
            if (!empty($m[4])) $text .= ' · ' . (int)$m[4] . ' Autoladungen ausgeschlossen';
            return $text;
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


    private function ResetFeedInStatisticsFromTodayOnce(): void
    {
        // v1.10.41: Die Einspeise-Statistik beginnt einmalig mit dem Tag des Updates neu.
        // Roharchive (Einspeise-kWh, CurrentPrice, Netzleistung, Verbrauch usw.) bleiben
        // vollständig erhalten. Entfernt werden nur abgeleitete Statistikdaten vor heute.
        if ($this->ReadAttributeInteger('FeedInStatisticsResetVersion') >= 1) return;

        $cutoff = strtotime('today 00:00:00');
        if ($cutoff <= 0) return;

        try {
            // Detaillierte Automatikläufe nur ab heute behalten. Ein vor Mitternacht
            // gestarteter Lauf gehört nach der bestehenden Statistiklogik zum Starttag
            // und wird deshalb bewusst nicht in den Neustart übernommen.
            $stats = json_decode($this->ReadAttributeString('FeedInStatisticsJSON'), true);
            if (!is_array($stats)) $stats = [];
            $kept = [];
            foreach ($stats as $row) {
                if (!is_array($row)) continue;
                $ts = (int)($row['start'] ?? $row['end'] ?? 0);
                if ($ts >= $cutoff) $kept[] = $row;
            }
            $this->WriteAttributeString('FeedInStatisticsJSON', json_encode($kept));

            // Den alten fortgeschriebenen Tageszähler vollständig verwerfen. Er ist nur
            // noch Fallback und soll den sauberen Neustart aus kWh- und Preisarchiv nicht
            // mit historischen Durchschnittswerten beeinflussen.
            $this->WriteAttributeString('GridExportDailyJSON', '{}');

            // Die versteckten, vom Modul erzeugten Automatik-Archivwerte vor heute
            // entfernen. Messarchive des Benutzers werden ausdrücklich nicht verändert.
            $archiveID = $this->FindArchive();
            if ($archiveID > 0) {
                foreach (['FeedInArchiveKWh','FeedInArchiveEUR','FeedInArchiveTargetKWh','FeedInArchiveWindow','FeedInArchiveStartTs','FeedInArchiveEndTs'] as $ident) {
                    $varID = (int)@$this->GetIDForIdent($ident);
                    if ($varID > 0 && @IPS_VariableExists($varID)) {
                        $deleted = @AC_DeleteVariableData($archiveID, $varID, 0, $cutoff - 1);
                        if ($deleted === false) throw new Exception('Alte Statistik-Archivdaten konnten nicht gelöscht werden: ' . $ident);
                    }
                }
            }

            $this->WriteAttributeInteger('FeedInStatisticsLastRenderTs', 0);
            $this->WriteAttributeInteger('FeedInStatisticsResetVersion', 1);
            $this->DebugLog('Einspeise-Statistik', 'v1.10.41: Statistik einmalig ab ' . date('d.m.Y 00:00:00', $cutoff) . ' neu gestartet; Roharchive unverändert.');
        } catch (Throwable $e) {
            // Marker absichtlich nicht setzen: Bei einem temporären Archivfehler wird
            // der einmalige Reset beim nächsten ApplyChanges erneut versucht.
            $this->DebugLog('Einspeise-Statistik', 'Neustart fehlgeschlagen: ' . $e->getMessage(), 0);
        }
    }


    private function GetGridExportHourlyStatisticsFromArchive(int $startTs, int $endTs, array $automationRuns): array
    {
        $archiveID = $this->FindArchive();
        if ($archiveID <= 0 || $endTs <= $startTs) return [];
        $effectiveEnd = min($endTs, time());
        if ($effectiveEnd <= $startTs) return [];

        // Preis-Zeitreihe mit den echten Tarifstarts aufbauen. Das Preisarchiv ist
        // ab v1.10.39/40 auf die Tarif-Gültigkeitszeiten ausgerichtet; PricesJSON
        // ergänzt den aktuell geladenen Bereich ohne zusätzliche Archivschreibungen.
        $priceVarID = (int)@$this->GetIDForIdent('CurrentPrice');
        $pricePoints = [];
        if ($priceVarID > 0) {
            $prevPrice = @AC_GetLoggedValues($archiveID, $priceVarID, 0, $startTs - 1, 1);
            if (is_array($prevPrice) && count($prevPrice) > 0) {
                $pricePoints[$startTs] = (float)$prevPrice[0]['Value'];
            }
            $loggedPrices = @AC_GetLoggedValues($archiveID, $priceVarID, $startTs, $effectiveEnd, 0);
            if (is_array($loggedPrices)) {
                foreach (array_reverse($loggedPrices) as $row) {
                    $ts = (int)($row['TimeStamp'] ?? 0);
                    if ($ts >= $startTs && $ts <= $effectiveEnd) $pricePoints[$ts] = (float)($row['Value'] ?? 0.0);
                }
            }
        }
        $cachedPrices = json_decode($this->ReadAttributeString('PricesJSON'), true);
        if (is_array($cachedPrices)) {
            foreach ($cachedPrices as $p) {
                $ps = (int)($p['start'] ?? 0); $pe = (int)($p['end'] ?? 0);
                if ($pe <= $startTs || $ps >= $effectiveEnd || $pe <= $ps) continue;
                $pricePoints[max($startTs, $ps)] = (float)($p['priceCt'] ?? 0.0);
            }
        }
        ksort($pricePoints);
        $priceChangeTs = array_map('intval', array_keys($pricePoints));
        $priceAt = static function(int $ts) use ($pricePoints): ?float {
            $found = null;
            foreach ($pricePoints as $pts => $price) {
                if ((int)$pts > $ts) break;
                $found = (float)$price;
            }
            return $found;
        };

        // Nur echte preisgesteuerte Einspeiseautomatik als grünes Fenster werten.
        $windows = [];
        foreach ($automationRuns as $r) {
            if (!is_array($r)) continue;
            if (isset($r['reason']) && (string)$r['reason'] !== '' && (string)$r['reason'] !== 'price') continue;
            $s = (int)($r['start'] ?? 0); $e = (int)($r['end'] ?? 0);
            if ($s <= 0) continue;
            if ($e <= $s) $e = $s + 1;
            if ($e <= $startTs || $s >= $effectiveEnd) continue;
            $windows[] = [max($startTs, $s), min($effectiveEnd, $e)];
        }
        // Einen aktuell noch laufenden Preis-Einspeisevorgang ebenfalls berücksichtigen.
        if ($this->ReadAttributeString('ActiveFeedInPlanKey') !== '' && $this->ReadAttributeString('ActiveFeedInReason') === 'price') {
            $s = $this->ReadAttributeInteger('ActiveFeedInStartedTs');
            if ($s > 0 && $s < $effectiveEnd && $effectiveEnd > $startTs) {
                $windows[] = [max($startTs, $s), $effectiveEnd];
            }
        }
        usort($windows, static function(array $a, array $b): int { return $a[0] <=> $b[0]; });
        $isAutoAt = static function(int $ts) use ($windows): bool {
            foreach ($windows as $w) {
                if ($ts < $w[0]) return false;
                if ($ts >= $w[0] && $ts < $w[1]) return true;
            }
            return false;
        };
        $windowBreaks = [];
        foreach ($windows as $w) { $windowBreaks[] = (int)$w[0]; $windowBreaks[] = (int)$w[1]; }

        $hourly = [];
        $addPiece = static function(int $pieceStart, int $pieceEnd, float $kWh) use (&$hourly, $priceAt, $isAutoAt): void {
            if ($pieceEnd <= $pieceStart || $kWh <= 0.0) return;
            $hourTs = strtotime(date('Y-m-d H:00:00', $pieceStart));
            $key = date('Y-m-d H:00', $hourTs);
            if (!isset($hourly[$key])) {
                $hourly[$key] = ['autoKWh'=>0.0,'autoEUR'=>0.0,'otherKWh'=>0.0,'otherEUR'=>0.0];
            }
            $sampleTs = $pieceStart + intdiv(max(0, $pieceEnd - $pieceStart), 2);
            $auto = $isAutoAt($sampleTs);
            $price = $priceAt($pieceStart);
            $eur = $price === null ? 0.0 : $kWh * $price / 100.0;
            if ($auto) {
                $hourly[$key]['autoKWh'] += $kWh;
                $hourly[$key]['autoEUR'] += $eur;
            } else {
                $hourly[$key]['otherKWh'] += $kWh;
                $hourly[$key]['otherEUR'] += $eur;
            }
        };

        $energyVarID = $this->ReadPropertyInteger('GridExportEnergyVariable');
        if ($energyVarID > 0 && @IPS_VariableExists($energyVarID)) {
            $values = @AC_GetLoggedValues($archiveID, $energyVarID, $startTs, $effectiveEnd, 0);
            if (!is_array($values)) $values = [];
            $values = array_reverse($values);
            $prev = @AC_GetLoggedValues($archiveID, $energyVarID, 0, $startTs - 1, 1);
            if (is_array($prev) && count($prev) > 0) {
                array_unshift($values, ['TimeStamp'=>$startTs, 'Value'=>(float)$prev[0]['Value']]);
            } elseif (count($values) > 0 && (int)$values[0]['TimeStamp'] > $startTs) {
                array_unshift($values, ['TimeStamp'=>$startTs, 'Value'=>(float)$values[0]['Value']]);
            }
            if ($effectiveEnd >= time() - 5) {
                $lastTs = count($values) > 0 ? (int)$values[count($values)-1]['TimeStamp'] : 0;
                if ($lastTs < $effectiveEnd) $values[] = ['TimeStamp'=>$effectiveEnd, 'Value'=>(float)GetValue($energyVarID)];
            }

            for ($i=1; $i<count($values); $i++) {
                $t1 = max($startTs, (int)$values[$i-1]['TimeStamp']);
                $t2 = min($effectiveEnd, (int)$values[$i]['TimeStamp']);
                if ($t2 <= $t1) continue;
                $v1 = (float)$values[$i-1]['Value']; $v2 = (float)$values[$i]['Value'];
                $delta = $v2 - $v1;
                if ($delta < 0.0) {
                    $resetKWh = max(0.0, $v2);
                    if ($resetKWh > 0.0) $addPiece($t2, min($effectiveEnd, $t2 + 1), $resetKWh);
                    continue;
                }
                if ($delta <= 0.0) continue;

                $breaks = [$t1, $t2];
                $h = strtotime(date('Y-m-d H:00:00', $t1)) + 3600;
                while ($h > $t1 && $h < $t2) { $breaks[] = $h; $h += 3600; }
                foreach ($priceChangeTs as $pts) if ($pts > $t1 && $pts < $t2) $breaks[] = $pts;
                foreach ($windowBreaks as $wb) if ($wb > $t1 && $wb < $t2) $breaks[] = $wb;
                $breaks = array_values(array_unique(array_map('intval', $breaks))); sort($breaks);
                $duration = $t2 - $t1;
                for ($b=0; $b<count($breaks)-1; $b++) {
                    $ps=$breaks[$b]; $pe=$breaks[$b+1]; if ($pe <= $ps) continue;
                    $addPiece($ps, $pe, $delta * (($pe-$ps)/$duration));
                }
            }
        } else {
            // Fallback ohne kWh-Zähler: reale Netzleistung integrieren. Wie in der
            // Tagesstatistik werden Archivlücken nur maximal 180 Sekunden fortgeschrieben.
            $varID = $this->ReadPropertyInteger('PVCalibrationFeedInVariable');
            if ($varID > 0 && @IPS_VariableExists($varID)) {
                $values = @AC_GetLoggedValues($archiveID, $varID, $startTs, $effectiveEnd, 0);
                if (!is_array($values)) $values = [];
                $values = array_reverse($values);
                $prev = @AC_GetLoggedValues($archiveID, $varID, 0, $startTs - 1, 1);
                if (is_array($prev) && count($prev) > 0) array_unshift($values, ['TimeStamp'=>$startTs,'Value'=>$prev[0]['Value']]);
                elseif (count($values)>0 && (int)$values[0]['TimeStamp']>$startTs) array_unshift($values, ['TimeStamp'=>$startTs,'Value'=>$values[0]['Value']]);
                $invert = $this->ReadPropertyBoolean('PVCalibrationFeedInInvert');
                for ($i=0; $i<count($values); $i++) {
                    $segStart=max($startTs,(int)$values[$i]['TimeStamp']);
                    $nextTs=($i+1<count($values))?(int)$values[$i+1]['TimeStamp']:$effectiveEnd;
                    $segEnd=min($effectiveEnd,$nextTs,$segStart+180);
                    if($segEnd<=$segStart)continue;
                    $raw1=(float)$values[$i]['Value']; $w1=max(0.0,$invert?-$raw1:$raw1);
                    $w2=$w1;
                    if($i+1<count($values)){ $raw2=(float)$values[$i+1]['Value']; $w2=max(0.0,$invert?-$raw2:$raw2); }
                    $full=max(1,$nextTs-(int)$values[$i]['TimeStamp']);
                    $fraction=min(1.0,($segEnd-$segStart)/$full);
                    $endW=$w1+($w2-$w1)*$fraction;
                    $avgW=max(0.0,($w1+$endW)/2.0);
                    if($avgW<=0.0)continue;
                    $breaks=[$segStart,$segEnd];
                    $h=strtotime(date('Y-m-d H:00:00',$segStart))+3600;
                    while($h>$segStart&&$h<$segEnd){$breaks[]=$h;$h+=3600;}
                    foreach($priceChangeTs as $pts)if($pts>$segStart&&$pts<$segEnd)$breaks[]=$pts;
                    foreach($windowBreaks as $wb)if($wb>$segStart&&$wb<$segEnd)$breaks[]=$wb;
                    $breaks=array_values(array_unique(array_map('intval',$breaks)));sort($breaks);
                    for($b=0;$b<count($breaks)-1;$b++){
                        $ps=$breaks[$b];$pe=$breaks[$b+1];if($pe<=$ps)continue;
                        $addPiece($ps,$pe,$avgW*(($pe-$ps)/3600.0)/1000.0);
                    }
                }
            }
        }

        foreach ($hourly as &$r) {
            foreach (['autoKWh','autoEUR','otherKWh','otherEUR'] as $k) $r[$k] = round(max(0.0,(float)$r[$k]), 4);
        }
        unset($r);
        return $hourly;
    }

    private function RenderFeedInStatisticsHTML(): string
    {
        // Archiv und detaillierte Laufhistorie zusammenführen. FeedInStatisticsJSON enthält
        // Start/Ende/PlanKey der realen Automatikläufe und darf nicht ignoriert werden, nur
        // weil bereits einzelne Archivpunkte existieren. Detaillierte JSON-Läufe haben
        // Vorrang; Archivdaten ergänzen nur ältere, noch nicht enthaltene Fenster.
        $archiveStats = $this->ReadAttributeInteger('ArchiveStorageMigrationVersion') >= 1 ? $this->ReadFeedInStatisticsFromArchive() : [];
        if (!is_array($archiveStats)) $archiveStats = [];
        $jsonStats = json_decode($this->ReadAttributeString('FeedInStatisticsJSON'), true);
        if (!is_array($jsonStats)) $jsonStats = [];
        $stats = []; $seenRuns = [];
        foreach ($jsonStats as $r) {
            if (!is_array($r)) continue;
            $start=(int)($r['start']??0); $end=(int)($r['end']??0); $k=(float)($r['deliveredKWh']??0.0);
            $sig = (string)($r['planKey']??'') . '|' . $start . '|' . $end . '|' . round($k,3);
            $seenRuns[$sig]=true; $stats[]=$r;
        }
        foreach ($archiveStats as $r) {
            if (!is_array($r)) continue;
            $ts=(int)($r['start']??$r['end']??0); $k=(float)($r['deliveredKWh']??0.0);
            // Ein Archivpunkt gilt als bereits vertreten, wenn ein detaillierter Lauf mit
            // praktisch gleicher Menge innerhalb von +/- 6 Stunden endet. So werden alte
            // Migrationen nicht doppelt gezählt, fehlende Archiv-only-Fenster aber erhalten.
            $duplicate=false;
            foreach ($jsonStats as $jr) {
                if (!is_array($jr)) continue;
                $je=(int)($jr['end']??$jr['start']??0); $jk=(float)($jr['deliveredKWh']??0.0);
                if ($je>0 && abs($je-$ts)<=21600 && abs($jk-$k)<=0.02) { $duplicate=true; break; }
            }
            if (!$duplicate) $stats[]=$r;
        }
        // GridExportDailyJSON bleibt nur noch als Fallback für ältere Zeiträume erhalten,
        // für die noch keine archivierte Preis-Zeitreihe existiert. Die kWh-Auswertung
        // selbst kommt ausschließlich aus dem realen Einspeisearchiv.
        $legacyDaily=json_decode($this->ReadAttributeString('GridExportDailyJSON'),true); if(!is_array($legacyDaily))$legacyDaily=[];
        $autoByDay=[];
        foreach($stats as $r){$ts=(int)($r['start']??$r['end']??0);if($ts<=0)continue;$d=date('Y-m-d',$ts);if(!isset($autoByDay[$d]))$autoByDay[$d]=['kWh'=>0.0,'eur'=>0.0,'target'=>0.0,'windows'=>0];$autoByDay[$d]['kWh']+=max(0.0,(float)($r['deliveredKWh']??0));$autoByDay[$d]['eur']+=max(0.0,(float)($r['revenueEUR']??0));$autoByDay[$d]['target']+=max(0.0,(float)($r['targetKWh']??0));$autoByDay[$d]['windows']++;}
        $dates=array_unique(array_merge(array_keys($autoByDay),array_keys($legacyDaily),[date('Y-m-d')])); sort($dates); $first=strtotime($dates[0].' 00:00:00'); $last=strtotime(end($dates).' 00:00:00');

        // Für jeden sichtbaren Tag gilt ausschließlich die zeitintegrierte reale
        // Netzeinspeisung aus dem IP-Symcon-Archiv. Ein fehlender Archivwert bedeutet
        // 0 kWh und fällt NICHT auf einen alten GridExportDailyJSON-Zähler zurück.
        $archiveEnd = min(time(), strtotime('+1 day', $last));
        $archiveDaily = $this->GetGridExportDailyFromArchive($first, $archiveEnd);
        $pricedDaily = $this->GetGridExportRevenueDailyFromArchive($first, $archiveEnd);

        $makeRow=function(int $ts) use($autoByDay,$archiveDaily,$pricedDaily,$legacyDaily): array {
            $key=date('Y-m-d',$ts);
            $a=$autoByDay[$key]??['kWh'=>0,'eur'=>0,'target'=>0,'windows'=>0];
            $totalK=max(0.0,(float)($archiveDaily[$key]??0.0));

            // Automatik-kWh exakt EINMAL von der realen Tages-Gesamteinspeisung
            // abziehen. Der grüne Automatikanteil bleibt aus den real gemessenen
            // Automatikfenstern erhalten; Blau ist ausschließlich der verbleibende Rest.
            $autoK=max(0.0,(float)$a['kWh']);
            $autoE=max(0.0,(float)$a['eur']);
            $otherK=max(0.0,$totalK-$autoK);

            // Ab v1.10.37 wird der Gesamt-Erlös eines Tages bevorzugt direkt aus den
            // realen kWh-Zählerdifferenzen und dem dazu zeitlich gültigen archivierten
            // Einspeisetarif berechnet. Erst wenn für einen historischen Tag noch nicht
            // genügend Preis-Historie vorhanden ist, wird auf die alte Erlösbasis zurückgefallen.
            $priced=$pricedDaily[$key]??null;
            $pricedKWh=is_array($priced)?max(0.0,(float)($priced['pricedKWh']??0.0)):0.0;
            $coverageOk=$totalK<=0.0001 || ($pricedKWh+max(0.05,$totalK*0.02) >= $totalK);
            if($coverageOk && is_array($priced)){
                $totalE=(float)($priced['eur']??0.0);
                $otherE=max(0.0,$totalE-$autoE);
            } else {
                $legacy=$legacyDaily[$key]??['kWh'=>0.0,'eur'=>0.0];
                $legacyTotalK=max(0.0,(float)($legacy['kWh']??0.0));
                $legacyTotalE=max(0.0,(float)($legacy['eur']??0.0));
                $legacyOtherK=max(0.0,$legacyTotalK-$autoK);
                $legacyOtherE=max(0.0,$legacyTotalE-$autoE);
                $otherE=$legacyOtherK>0.0001 ? ($legacyOtherE/$legacyOtherK)*$otherK : 0.0;
            }

            return [
                'label'=>date('d',$ts),
                'weekLabel'=>['So','Mo','Di','Mi','Do','Fr','Sa'][(int)date('w',$ts)].' '.date('d.m.',$ts),
                'date'=>date('d.m.Y',$ts),
                'autoKWh'=>round($autoK,3),
                'autoEUR'=>round($autoE,3),
                'otherKWh'=>round($otherK,3),
                'otherEUR'=>round(max(0.0,$otherE),3),
                'targetKWh'=>round((float)$a['target'],3),
                'windows'=>(int)$a['windows']
            ];
        };
        $sumRows=function(array $rows): array {$sum=['autoKWh'=>0.0,'autoEUR'=>0.0,'otherKWh'=>0.0,'otherEUR'=>0.0];foreach($rows as $row)foreach($sum as $k=>$_)$sum[$k]+=(float)$row[$k];return $sum;};
        $monthNames=[1=>'Januar',2=>'Februar',3=>'März',4=>'April',5=>'Mai',6=>'Juni',7=>'Juli',8=>'August',9=>'September',10=>'Oktober',11=>'November',12=>'Dezember']; $months=[];
        $startMonth=strtotime(date('Y-m-01 00:00:00',$first)); $endMonth=strtotime(date('Y-m-01 00:00:00',$last));
        for($m=$startMonth;$m<=$endMonth;$m=strtotime('+1 month',$m)){$rows=[];$n=(int)date('t',$m);for($d=1;$d<=$n;$d++)$rows[]=$makeRow(strtotime(date('Y-m-',$m).sprintf('%02d',$d).' 00:00:00'));$months[]=['key'=>date('Y-m',$m),'label'=>$monthNames[(int)date('n',$m)].' '.date('Y',$m),'isCurrent'=>date('Y-m',$m)===date('Y-m'),'rows'=>$rows,'sum'=>$sumRows($rows)];}
        $monday=function(int $ts): int {return strtotime('monday this week',strtotime(date('Y-m-d 12:00:00',$ts)));}; $startWeek=$monday($first); $endWeek=$monday($last); $weeks=[];
        for($w=$startWeek;$w<=$endWeek;$w=strtotime('+7 days',$w)){$rows=[];for($i=0;$i<7;$i++)$rows[]=$makeRow(strtotime('+'.$i.' days',$w));$we=strtotime('+6 days',$w);$weeks[]=['key'=>date('o-W',$w),'label'=>'KW '.date('W',$w).' · '.date('d.m.',$w).' – '.date('d.m.Y',$we),'isCurrent'=>$w===$monday(time()),'rows'=>$rows,'sum'=>$sumRows($rows)];}

        // Tagesansicht: 24 Stunden direkt aus dem Einspeise-/Preisarchiv bilden.
        // Die kWh werden an Stunden-, Tarif- und Automatikgrenzen aufgeteilt, damit
        // sowohl Energiemenge als auch Erlös je Stunde korrekt zugeordnet werden.
        $hourlyStats = $this->GetGridExportHourlyStatisticsFromArchive($first, $archiveEnd, $stats);
        $days = [];
        for ($d=$first; $d<=$last; $d=strtotime('+1 day', $d)) {
            $rows=[];
            for ($h=0; $h<24; $h++) {
                $hourTs = strtotime(date('Y-m-d', $d) . ' ' . sprintf('%02d', $h) . ':00:00');
                $hourKey = date('Y-m-d H:00', $hourTs);
                $r = $hourlyStats[$hourKey] ?? ['autoKWh'=>0.0,'autoEUR'=>0.0,'otherKWh'=>0.0,'otherEUR'=>0.0];
                $rows[] = [
                    'label'=>sprintf('%02d:00', $h),
                    'hourLabel'=>sprintf('%02d:00', $h),
                    'date'=>date('d.m.Y', $d),
                    'autoKWh'=>round((float)$r['autoKWh'],3),
                    'autoEUR'=>round((float)$r['autoEUR'],3),
                    'otherKWh'=>round((float)$r['otherKWh'],3),
                    'otherEUR'=>round((float)$r['otherEUR'],3),
                    'targetKWh'=>0.0,
                    'windows'=>0
                ];
            }
            $days[]=['key'=>date('Y-m-d',$d),'label'=>date('d.m.Y',$d),'isCurrent'=>date('Y-m-d',$d)===date('Y-m-d'),'rows'=>$rows,'sum'=>$sumRows($rows)];
        }
        $highchartsJS=$this->GetHighchartsJavaScript();$id='sbo_feed_stats_'.$this->InstanceID;$html='<div style="font-family:Tahoma,Arial,-apple-system,BlinkMacSystemFont,Segoe UI,sans-serif;color:#fff;width:100%"><b>Einspeise-Statistik</b><br><span style="font-size:11px">Aktualisiert: ' . date('d.m.Y H:i:s') . '</span><br><span style="font-size:11px">Blau: Einspeisung außerhalb der Automatik · Grün: Einspeisung während der Automatik. Gelb transparente Balken zeigen jeweils überlagert den zugehörigen Erlös.</span><br>';if($highchartsJS==='')return $html.'<div style="margin-top:8px">Highcharts lokal nicht verfügbar.</div></div>';
        $html.='<div id="'.$id.'" style="display:block;width:100%;max-width:none;min-width:0;height:430px;margin-top:8px;box-sizing:border-box"></div><div style="display:flex;justify-content:center;align-items:center;gap:12px;margin:4px 0 8px;flex-wrap:wrap"><button id="'.$id.'_prev" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:16px;min-width:46px;padding:3px 12px;cursor:pointer">&#8592;</button><span id="'.$id.'_date" style="min-width:235px;text-align:center;font-weight:bold"></span><button id="'.$id.'_next" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:16px;min-width:46px;padding:3px 12px;cursor:pointer">&#8594;</button><button id="'.$id.'_today" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;min-width:72px;padding:4px 12px;font-weight:bold;cursor:pointer">Heute</button><span style="width:8px"></span><button id="'.$id.'_day" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;min-width:72px;padding:4px 12px;font-weight:bold;cursor:pointer">Tag</button><button id="'.$id.'_week" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;min-width:72px;padding:4px 12px;font-weight:bold;cursor:pointer">Woche</button><button id="'.$id.'_month" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;min-width:72px;padding:4px 12px;font-weight:bold;cursor:pointer">Monat</button></div><div id="'.$id.'_summary" style="font-size:11px;text-align:center"></div><script>'.$highchartsJS.'</script><script>(function(){';
        $html.='var views={day:'.json_encode($days,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES).',week:'.json_encode($weeks,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES).',month:'.json_encode($months,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES).'},id='.json_encode($id).',store="sbo_feed_stats_view_'.$this->InstanceID.'",mode="month",idx=0,chart=null,resizeObserver=null;try{var sm=localStorage.getItem(store);if(sm==="day"||sm==="week"||sm==="month")mode=sm}catch(x){}function e(s){return document.getElementById(id+s)}function f(v,n){return Highcharts.numberFormat(Number(v)||0,n,",",".")}function currentIndex(){var v=views[mode];for(var i=0;i<v.length;i++)if(v[i].isCurrent)return i;return Math.max(0,v.length-1)}function restoreIndex(){var v=views[mode],saved="";try{saved=localStorage.getItem(store+"_"+mode+"_key")||""}catch(x){}if(saved){for(var i=0;i<v.length;i++)if(v[i].key===saved)return i}return currentIndex()}function select(m){mode=m;idx=restoreIndex();try{localStorage.setItem(store,mode)}catch(x){}draw()}function draw(){var v=views[mode];if(!v.length)return;idx=Math.max(0,Math.min(idx,v.length-1));try{localStorage.setItem(store+"_"+mode+"_key",v[idx].key)}catch(x){}var m=v[idx],a=[],o=[],ae=[],oe=[],c=[];m.rows.forEach(function(r){c.push(mode==="day"?r.hourLabel:(mode==="week"?r.weekLabel:r.label));a.push({y:r.autoKWh,custom:r});o.push({y:r.otherKWh,custom:r});ae.push({y:r.autoEUR,custom:r});oe.push({y:r.otherEUR,custom:r})});chart=Highcharts.chart(e(""),{chart:{type:"column",backgroundColor:"transparent",animation:false,style:{fontFamily:"Tahoma,Arial,-apple-system,BlinkMacSystemFont,Segoe UI,sans-serif"}},title:{text:null},credits:{enabled:false},legend:{itemStyle:{color:"#fff",fontWeight:"normal",fontSize:"10px"}},xAxis:{categories:c,tickInterval:mode==="day"?1:undefined,labels:{rotation:mode==="day"?-45:0,style:{color:"#fff",fontSize:"10px"}}},yAxis:[{min:0,title:{text:"kWh",style:{color:"#fff"}},labels:{style:{color:"#fff"}},gridLineColor:"rgba(255,255,255,.18)"},{min:0,opposite:true,title:{text:"€",style:{color:"#ffe082"}},labels:{format:"{value:.2f} €",style:{color:"#ffe082"}},gridLineWidth:0}],tooltip:{shared:true,useHTML:true,formatter:function(){var r=this.points&&this.points[0]?this.points[0].point.custom:{};return "<b>"+(r.date||"")+(mode==="day"?" · "+(r.hourLabel||""):"")+"</b><br><span style=\\"color:#2f7ed8\\">Außerhalb Automatik: <b>"+f(r.otherKWh,2)+" kWh</b></span> / <span style=\\"color:#ffe082\\">"+f(r.otherEUR,2)+" €</span><br><span style=\\"color:#38a169\\">Während Automatik: <b>"+f(r.autoKWh,2)+" kWh</b></span> / <span style=\\"color:#ffe082\\">"+f(r.autoEUR,2)+" €</span><br>Gesamt: <b>"+f(Number(r.autoKWh)+Number(r.otherKWh),2)+" kWh / "+f(Number(r.autoEUR)+Number(r.otherEUR),2)+" €</b>"+(r.targetKWh>0?"<br>Automatik geplant: "+f(r.targetKWh,2)+" kWh":"")}},plotOptions:{column:{borderWidth:0,grouping:false}},series:[{name:"Außerhalb Automatik kWh",data:o,pointPlacement:-0.22,pointPadding:0.16,yAxis:0,zIndex:1},{name:"Außerhalb Automatik Erlös",data:oe,color:"rgba(255,213,79,.38)",pointPlacement:-0.22,pointPadding:0.34,yAxis:1,zIndex:2},{name:"Während Automatik kWh",data:a,color:"#38a169",pointPlacement:0.22,pointPadding:0.16,yAxis:0,zIndex:1},{name:"Während Automatik Erlös",data:ae,color:"rgba(255,213,79,.38)",pointPlacement:0.22,pointPadding:0.34,yAxis:1,zIndex:2}]});e("_date").innerHTML=m.label+(m.isCurrent?" &ndash; Heute":"");var s=m.sum;e("_summary").innerHTML=(mode==="day"?"Tag":(mode==="week"?"Woche":"Monat"))+" · Außerhalb Automatik: <b>"+f(s.otherKWh,2)+" kWh / "+f(s.otherEUR,2)+" €</b> &middot; Während Automatik: <b>"+f(s.autoKWh,2)+" kWh / "+f(s.autoEUR,2)+" €</b> &middot; Gesamt: <b>"+f(Number(s.autoKWh)+Number(s.otherKWh),2)+" kWh / "+f(Number(s.autoEUR)+Number(s.otherEUR),2)+" €</b>";e("_prev").disabled=idx<=0;e("_next").disabled=idx>=v.length-1;e("_day").disabled=mode==="day";e("_week").disabled=mode==="week";e("_month").disabled=mode==="month"}idx=restoreIndex();e("_prev").onclick=function(){if(idx>0){idx--;draw()}};e("_next").onclick=function(){if(idx<views[mode].length-1){idx++;draw()}};e("_today").onclick=function(){idx=currentIndex();draw()};e("_day").onclick=function(){select("day")};e("_week").onclick=function(){select("week")};e("_month").onclick=function(){select("month")};draw();var host=e("");function rf(){if(!chart||!host)return;try{chart.setSize(host.clientWidth||null,null,false);chart.reflow()}catch(x){}}if(typeof ResizeObserver!=="undefined"&&host){resizeObserver=new ResizeObserver(function(){setTimeout(rf,0)});resizeObserver.observe(host);if(host.parentElement)resizeObserver.observe(host.parentElement);setTimeout(rf,50);setTimeout(rf,300)}else if(typeof window!=="undefined"){window.addEventListener("resize",function(){setTimeout(rf,0)});setTimeout(rf,100)}})();</script></div>';return $html;
    }

    private function RenderConsumptionProfileChartHTML(array $profile): string
    {
        $highchartsJS = $this->GetHighchartsJavaScript();
        $chartId = 'sbo_consumption_profile_' . $this->InstanceID;
        $days = [];
        $archiveID = $this->FindArchive();
        $varID = $this->ReadPropertyInteger('HousePowerVariable');

        // Nicht mehr hart auf sechs Tage Vergangenheit begrenzen. Angezeigt wird das
        // konfigurierte Lernfenster (max. 90 Tage), begrenzt auf den tatsächlich im
        // saisonalen Modell bekannten Archivbeginn. Damit kann der Benutzer die Tage,
        // aus denen das Lastprofil gelernt wurde, auch rückwirkend kontrollieren.
        $todayStart = strtotime('today 00:00:00');
        $historyDays = max(7, min(90, $this->ReadPropertyInteger('LearningDays')));
        $firstDisplayDay = strtotime('-' . ($historyDays - 1) . ' days', $todayStart);
        $model = isset($profile['seasonalModel']) && is_array($profile['seasonalModel'])
            ? $profile['seasonalModel']
            : [];
        $archiveFrom = (int)($model['archiveFrom'] ?? 0);
        if ($archiveFrom > 0) {
            $archiveFromDay = strtotime(date('Y-m-d', $archiveFrom) . ' 00:00:00');
            if ($archiveFromDay > $firstDisplayDay) $firstDisplayDay = $archiveFromDay;
        }

        for ($dayStart = $firstDisplayDay; $dayStart <= $todayStart; $dayStart = strtotime('+1 day', $dayStart)) {
            // Im Diagramm bewusst das REINE gelernte Profil darstellen. Der konfigurierbare
            // Verbrauchs-Sicherheitsaufschlag bleibt unverändert in Planung/Prognose aktiv,
            // gehört aber nicht in eine Kurve mit der Bezeichnung "gelerntes Lastprofil".
            $learnedForDay = $this->GetConsumptionForecastHourlyForTimestamp($profile, $dayStart + 12 * 3600, false);
            $daySource = trim((string)($profile['source'] ?? $this->ReadAttributeString('ConsumptionLearningSource')));
            if (!empty($model)) {
                $composedForDay = $this->ComposeConsumptionProfileFromModel($model, $dayStart + 12 * 3600);
                $daySource = trim((string)($composedForDay['source'] ?? $daySource));
            }

            $actual = ($archiveID > 0 && $varID > 0 && @IPS_VariableExists($varID))
                ? $this->GetHourlyConsumptionForDay($archiveID, $varID, $dayStart)
                : null;
            $ev = ($archiveID > 0 && $varID > 0 && @IPS_VariableExists($varID))
                ? $this->GetEVChargingAnalysisForDay($archiveID, $varID, $dayStart)
                : ['hourlyWh' => array_fill(0, 24, 0.0), 'sessions' => 0, 'kWh' => 0.0];
            $evHourlyWh = is_array($ev['hourlyWh'] ?? null)
                ? array_values($ev['hourlyWh'])
                : array_fill(0, 24, 0.0);

            $rows = [];
            $actualTotal = 0.0;
            $evTotal = 0.0;
            $actualHasValues = false;
            $now = time();
            for ($h = 0; $h < 24; $h++) {
                $hourStart = $dayStart + $h * 3600;
                $actualBaseValue = null;
                $evValue = null;
                if (is_array($actual) && $hourStart <= $now) {
                    $totalValue = max(0.0, (float)($actual[$h] ?? 0.0));
                    $detectedEV = max(0.0, (float)($evHourlyWh[$h] ?? 0.0) / 1000.0);
                    $detectedEV = min($totalValue, $detectedEV);
                    $actualBaseValue = round(max(0.0, $totalValue - $detectedEV), 3);
                    $evValue = round($detectedEV, 3);
                    $actualTotal += $totalValue;
                    $evTotal += $detectedEV;
                    $actualHasValues = true;
                }
                $rows[] = [
                    'label' => str_pad((string)$h, 2, '0', STR_PAD_LEFT) . ':00',
                    'forecastKWh' => round(max(0.0, (float)($learnedForDay[$h] ?? 0.0)), 3),
                    'actualBaseKWh' => $actualBaseValue,
                    'evKWh' => $evValue
                ];
            }

            $days[] = [
                'date' => date('Y-m-d', $dayStart),
                'label' => date('d.m.Y', $dayStart),
                'source' => $daySource,
                'forecastTotalKWh' => round(array_sum($learnedForDay), 3),
                'actualTotalKWh' => $actualHasValues ? round($actualTotal, 3) : null,
                'evTotalKWh' => $actualHasValues ? round($evTotal, 3) : null,
                'evSessions' => (int)($ev['sessions'] ?? 0),
                'rows' => $rows
            ];
        }

        $html = '<div style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;color:#fff;width:100%"><b>Verbrauch / gelerntes Lastprofil</b><br><span style="font-size:11px">Aktualisiert: ' . date('d.m.Y H:i:s') . '</span><br><span style="font-size:11px">Gelerntes Grundlastprofil im Vergleich zum tatsächlichen Verbrauch; erkannte Autoladung wird orange separat dargestellt und beim Lernen abgezogen.</span><br><span id="' . $chartId . '_source" style="font-size:11px;color:#bbb"></span><br>';
        if ($highchartsJS === '') return $html . '<div style="margin-top:8px">Highcharts lokal nicht verfügbar.</div></div>';

        $html .= '<div id="' . $chartId . '" style="width:100%;height:410px;margin-top:8px"></div><div style="display:flex;justify-content:center;align-items:center;gap:12px;margin:4px 0 8px"><button id="' . $chartId . '_prev" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:16px;min-width:46px">&#8592;</button><span id="' . $chartId . '_date" style="min-width:150px;text-align:center;font-weight:bold"></span><button id="' . $chartId . '_next" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:16px;min-width:46px">&#8594;</button><button id="' . $chartId . '_today" type="button" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:12px;min-width:72px;font-weight:bold;padding:4px 12px;cursor:pointer">Heute</button></div><div id="' . $chartId . '_summary" style="font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;font-size:11px;color:#fff;text-align:center"></div><script>' . $highchartsJS . '</script><script>(function(){';
        $html .= 'var days=' . json_encode($days) . ',id=' . json_encode($chartId) . ',key=' . json_encode('sbo_consumption_selected_day_' . $this->InstanceID) . ',idx=Math.max(0,days.length-1),chart=null;try{var sd=localStorage.getItem(key);if(sd){for(var si=0;si<days.length;si++){if(days[si].date===sd){idx=si;break;}}}}catch(e){}function e(s){return document.getElementById(id+s)}function draw(){if(days.length){try{localStorage.setItem(key,days[idx].date)}catch(e){}}if(!days.length||typeof Highcharts==="undefined")return;var d=days[idx],c=[],f=[],a=[],v=[];for(var j=0;j<d.rows.length;j++){var r=d.rows[j];c.push(r.label);f.push(r.forecastKWh);a.push(r.actualBaseKWh);v.push(r.evKWh)}chart=Highcharts.chart(id,{chart:{type:"column",backgroundColor:"transparent",animation:false,style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif"}},title:{text:null},credits:{enabled:false},legend:{itemStyle:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#fff",fontWeight:"normal"}},xAxis:{categories:c,lineColor:"#fff",tickColor:"#fff",labels:{style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#fff"}}},yAxis:{min:0,title:{text:"kWh",style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#fff"}},labels:{style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"10px",color:"#fff"}},gridLineColor:"rgba(255,255,255,.18)"},tooltip:{shared:true,valueSuffix:" kWh",style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif"}},plotOptions:{column:{borderWidth:0,grouping:false,stacking:"normal",groupPadding:.06,pointPadding:.02}},series:[{name:"Gelerntes Lastprofil",data:f,stack:"forecast",zIndex:1,dataLabels:{enabled:true,formatter:function(){return this.y>=.15?Highcharts.numberFormat(this.y,1,",","."):""},style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",fontSize:"9px",fontWeight:"normal",color:"#fff",textOutline:"none"}}},{name:"Ist-Verbrauch ohne Autoladung",data:a,stack:"actual",zIndex:2,color:"rgba(255,213,79,.38)",pointPadding:.20},{name:"Autoladung",data:v,stack:"actual",zIndex:3,color:"#ff9800",pointPadding:.20}]});e("_date").innerHTML=d.label+(idx===days.length-1?" &ndash; Heute":"");var src=e("_source");if(src){src.textContent=d.source?"Lastprofil: "+d.source:""}var evText=(d.evTotalKWh!==null&&d.evTotalKWh>=.05)?" &middot; <span style=\"color:#ffb74d\">Autoladung: <b>"+Highcharts.numberFormat(d.evTotalKWh,2,",",".")+" kWh</b>"+(d.evSessions>0?" ("+d.evSessions+")":"")+"</span>":"";e("_summary").innerHTML="Gelernt: <b>"+Highcharts.numberFormat(d.forecastTotalKWh,2,",",".")+" kWh</b> &middot; <span style=\"color:#ffe082\">Ist gesamt: <b>"+(d.actualTotalKWh===null?"–":Highcharts.numberFormat(d.actualTotalKWh,2,",",".")+" kWh")+"</b></span>"+evText;e("_prev").disabled=idx<=0;e("_next").disabled=idx>=days.length-1}function init(){e("_prev").onclick=function(){if(idx>0){idx--;draw()}};e("_next").onclick=function(){if(idx<days.length-1){idx++;draw()}};e("_today").onclick=function(){var t=new Date(),y=t.getFullYear()+"-"+String(t.getMonth()+1).padStart(2,"0")+"-"+String(t.getDate()).padStart(2,"0");for(var q=0;q<days.length;q++){if(days[q].date===y){idx=q;break;}}draw()};draw()}if(document.readyState==="loading")document.addEventListener("DOMContentLoaded",init);else setTimeout(init,0)})();</script></div>';
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

        // Die kombinierte Prognose wird bereits in StorePVForecastHistory() gespeichert.
        // Dort werden vollständig vergangene Stunden eingefroren, während die aktuelle
        // und zukünftige Stunden weiterhin mit neuen Forecast-Abrufen aktualisiert werden.
        // Diese Historie darf hier NICHT noch einmal aus dem aktuellen Forecast überschrieben
        // werden, sonst stammen Provider-Linien und blauer Kombinationsbalken für vergangene
        // Stunden aus unterschiedlichen Prognoseständen.
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
                'powerW' => 0.0, 'gridTargetW' => 0.0, 'dispatchPowerW' => 0.0,
                'expectedLoadW' => 0.0, 'expectedGridExportW' => 0.0, 'energyKWh' => 0.0
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

        }

        // Planenergie separat genau einmal auf Stunden verteilen. Die Preisquelle kann
        // intern 15-Minuten-Slots liefern; deshalb darf die Gesamtenergie eines Plans
        // nicht innerhalb jeder Viertelstunde erneut addiert werden.
        foreach (($plan['slots'] ?? []) as $slot) {
            $segments = isset($slot['segments']) && is_array($slot['segments']) ? $slot['segments'] : [$slot];
            foreach ($segments as $segment) {
                $segStart = (int)($segment['start'] ?? ($segment['priceIntervalStart'] ?? 0));
                $segEnd = (int)($segment['end'] ?? ($segment['priceIntervalEnd'] ?? 0));
                if ($segStart <= 0 || $segEnd <= $segStart) continue;
                foreach ($hourBuckets as $hourTs => &$bucket) {
                    $hourEnd = $hourTs + 3600;
                    $overlapStart = max($segStart, $hourTs);
                    $overlapEnd = min($segEnd, $hourEnd);
                    if ($overlapEnd <= $overlapStart) continue;

                    $segmentDuration = max(1, $segEnd - $segStart);
                    $fraction = ($overlapEnd - $overlapStart) / $segmentDuration;
                    $bucket['selected'] = true;
                    if (($segment['reason'] ?? '') === 'pv_space') {
                        $bucket['reason'] = 'pv_space';
                    } elseif ($bucket['reason'] === '') {
                        $bucket['reason'] = 'price';
                    }
                    $bucket['gridTargetW'] = max($bucket['gridTargetW'], (float)($segment['gridTargetW'] ?? $this->GetConfiguredGridFeedInTargetW()));
                    $bucket['dispatchPowerW'] = max($bucket['dispatchPowerW'], (float)($segment['powerW'] ?? 0.0));
                    $bucket['expectedLoadW'] = max($bucket['expectedLoadW'], (float)($segment['expectedLoadW'] ?? 0.0));
                    $bucket['expectedGridExportW'] = max($bucket['expectedGridExportW'], (float)($segment['expectedGridExportW'] ?? 0.0));
                    $bucket['powerW'] = $bucket['expectedGridExportW'];
                    $bucket['energyKWh'] += max(0.0, (float)($segment['energyKWh'] ?? 0.0)) * $fraction;
                }
                unset($bucket);
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
                'gridTargetW' => round($bucket['gridTargetW'], 1),
                'dispatchPowerW' => round($bucket['dispatchPowerW'], 1),
                'expectedLoadW' => round($bucket['expectedLoadW'], 1),
                'expectedGridExportW' => round($bucket['expectedGridExportW'], 1),
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
            $html .= 'tooltip:{useHTML:true,backgroundColor:"rgba(30,30,30,0.96)",borderColor:"#888888",style:{fontFamily:"Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif",color:"#ffffff",fontSize:"11px"},formatter:function(){var r=this.point.custom;return "<span style=\\"font-family:Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;color:#fff\\"><b>"+r.label+"</b><br>Börsenpreis: <b>"+Highcharts.numberFormat(r.marketCt,2,",",".")+" ct/kWh</b><br>Berechneter Tarif: "+Highcharts.numberFormat(r.priceCt,2,",",".")+" ct/kWh"+(r.selected?"<br><b>"+(r.reason==="pv_space"?"Speicher für PV freihalten":"Preisoptimierung")+"</b><br>Netz-Ziel: "+Highcharts.numberFormat(r.gridTargetW/1000,2,",",".")+" kW<br>WR-Dispatch: "+Highcharts.numberFormat(r.dispatchPowerW/1000,2,",",".")+" kW<br>Erw. Eigenverbrauch: "+Highcharts.numberFormat(r.expectedLoadW/1000,2,",",".")+" kW<br>Rechnerische Netzeinspeisung: "+Highcharts.numberFormat(r.expectedGridExportW/1000,2,",",".")+" kW<br>Energie: "+Highcharts.numberFormat(r.energyKWh,2,",",".")+" kWh":"")+"</span>";}},';
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
