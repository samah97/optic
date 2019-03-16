<?php
	//include all DAO files
	require_once('class/sql/Connection.class.php');
	require_once('class/sql/ConnectionFactory.class.php');
	require_once('class/sql/ConnectionProperty.class.php');
	require_once('class/sql/QueryExecutor.class.php');
	require_once('class/sql/Transaction.class.php');
	require_once('class/sql/SqlQuery.class.php');
	require_once('class/core/ArrayList.class.php');
	require_once('class/dao/DAOFactory.class.php');
	require_once('class/Functions/Database/Database.php');
 	
	require_once('class/dao/AmbianceDAO.class.php');
	require_once('class/dto/Ambiance.class.php');
	require_once('class/mysql/AmbianceMySqlDAO.class.php');
	require_once('class/mysql/ext/AmbianceMySqlExtDAO.class.php');
	require_once('class/Functions/AmbianceEXT.class.php');
	require_once('class/dao/AntecedentDiseaseDAO.class.php');
	require_once('class/dto/AntecedentDisease.class.php');
	require_once('class/mysql/AntecedentDiseaseMySqlDAO.class.php');
	require_once('class/mysql/ext/AntecedentDiseaseMySqlExtDAO.class.php');
	require_once('class/Functions/AntecedentDiseaseEXT.class.php');
	require_once('class/dao/ConsulationFsDAO.class.php');
	require_once('class/dto/ConsulationF.class.php');
	require_once('class/mysql/ConsulationFsMySqlDAO.class.php');
	require_once('class/mysql/ext/ConsulationFsMySqlExtDAO.class.php');
	require_once('class/Functions/ConsulationFsEXT.class.php');
	require_once('class/dao/ConsultationVpDAO.class.php');
	require_once('class/dto/ConsultationVp.class.php');
	require_once('class/mysql/ConsultationVpMySqlDAO.class.php');
	require_once('class/mysql/ext/ConsultationVpMySqlExtDAO.class.php');
	require_once('class/Functions/ConsultationVpEXT.class.php');
	require_once('class/dao/ControlDAO.class.php');
	require_once('class/dto/Control.class.php');
	require_once('class/mysql/ControlMySqlDAO.class.php');
	require_once('class/mysql/ext/ControlMySqlExtDAO.class.php');
	require_once('class/Functions/ControlEXT.class.php');
	require_once('class/dao/DiseaseDAO.class.php');
	require_once('class/dto/Disease.class.php');
	require_once('class/mysql/DiseaseMySqlDAO.class.php');
	require_once('class/mysql/ext/DiseaseMySqlExtDAO.class.php');
	require_once('class/Functions/DiseaseEXT.class.php');
	require_once('class/dao/FunctionalSignDAO.class.php');
	require_once('class/dto/FunctionalSign.class.php');
	require_once('class/mysql/FunctionalSignMySqlDAO.class.php');
	require_once('class/mysql/ext/FunctionalSignMySqlExtDAO.class.php');
	require_once('class/Functions/FunctionalSignEXT.class.php');
	require_once('class/dao/PatientInfoDAO.class.php');
	require_once('class/dto/PatientInfo.class.php');
	require_once('class/mysql/PatientInfoMySqlDAO.class.php');
	require_once('class/mysql/ext/PatientInfoMySqlExtDAO.class.php');
	require_once('class/Functions/PatientInfoEXT.class.php');
	require_once('class/dao/ReasonConsultationDAO.class.php');
	require_once('class/dto/ReasonConsultation.class.php');
	require_once('class/mysql/ReasonConsultationMySqlDAO.class.php');
	require_once('class/mysql/ext/ReasonConsultationMySqlExtDAO.class.php');
	require_once('class/Functions/ReasonConsultationEXT.class.php');
	require_once('class/dao/RefContactDAO.class.php');
	require_once('class/dto/RefContact.class.php');
	require_once('class/mysql/RefContactMySqlDAO.class.php');
	require_once('class/mysql/ext/RefContactMySqlExtDAO.class.php');
	require_once('class/Functions/RefContactEXT.class.php');
	require_once('class/dao/RefEyeglassesDAO.class.php');
	require_once('class/dto/RefEyeglasse.class.php');
	require_once('class/mysql/RefEyeglassesMySqlDAO.class.php');
	require_once('class/mysql/ext/RefEyeglassesMySqlExtDAO.class.php');
	require_once('class/Functions/RefEyeglassesEXT.class.php');
	require_once('class/dao/RefractionHistoryDAO.class.php');
	require_once('class/dto/RefractionHistory.class.php');
	require_once('class/mysql/RefractionHistoryMySqlDAO.class.php');
	require_once('class/mysql/ext/RefractionHistoryMySqlExtDAO.class.php');
	require_once('class/Functions/RefractionHistoryEXT.class.php');
	require_once('class/dao/TypeCorrectionDAO.class.php');
	require_once('class/dto/TypeCorrection.class.php');
	require_once('class/mysql/TypeCorrectionMySqlDAO.class.php');
	require_once('class/mysql/ext/TypeCorrectionMySqlExtDAO.class.php');
	require_once('class/Functions/TypeCorrectionEXT.class.php');
	require_once('class/dao/VisualAntecedentDAO.class.php');
	require_once('class/dto/VisualAntecedent.class.php');
	require_once('class/mysql/VisualAntecedentMySqlDAO.class.php');
	require_once('class/mysql/ext/VisualAntecedentMySqlExtDAO.class.php');
	require_once('class/Functions/VisualAntecedentEXT.class.php');
	require_once('class/dao/VisualNeedDAO.class.php');
	require_once('class/dto/VisualNeed.class.php');
	require_once('class/mysql/VisualNeedMySqlDAO.class.php');
	require_once('class/mysql/ext/VisualNeedMySqlExtDAO.class.php');
	require_once('class/Functions/VisualNeedEXT.class.php');
	require_once('class/dao/VisualProblemDAO.class.php');
	require_once('class/dto/VisualProblem.class.php');
	require_once('class/mysql/VisualProblemMySqlDAO.class.php');
	require_once('class/mysql/ext/VisualProblemMySqlExtDAO.class.php');
	require_once('class/Functions/VisualProblemEXT.class.php');
	require_once('class/dao/WearTypeDAO.class.php');
	require_once('class/dto/WearType.class.php');
	require_once('class/mysql/WearTypeMySqlDAO.class.php');
	require_once('class/mysql/ext/WearTypeMySqlExtDAO.class.php');
	require_once('class/Functions/WearTypeEXT.class.php');
	require_once('class/dao/WorkStationDAO.class.php');
	require_once('class/dto/WorkStation.class.php');
	require_once('class/mysql/WorkStationMySqlDAO.class.php');
	require_once('class/mysql/ext/WorkStationMySqlExtDAO.class.php');
	require_once('class/Functions/WorkStationEXT.class.php');
	require_once('class/dao/UsersDAO.class.php');
	require_once('class/dto/User.class.php');
	require_once('class/mysql/UsersMySqlDAO.class.php');
	require_once('class/mysql/ext/UsersMySqlExtDAO.class.php');
	require_once('class/Functions/UsersEXT.class.php');
	
	require_once('class/dao/MedicationIntakeDAO.class.php');
	require_once('class/dto/MedicationIntake.class.php');
	require_once('class/mysql/MedicationIntakeMySqlDAO.class.php');
	require_once('class/mysql/ext/MedicationIntakeMySqlExtDAO.class.php');
	require_once('class/Functions/MedicationIntakeEXT.class.php');

	require_once('class/dao/CoverTestDAO.class.php');
	require_once('class/dto/CoverTest.class.php');
	require_once('class/mysql/CoverTestMySqlDAO.class.php');
	require_once('class/mysql/ext/CoverTestMySqlExtDAO.class.php');
	require_once('class/Functions/CoverTestEXT.class.php');
	require_once('class/dao/HarmonDistanceDAO.class.php');
	require_once('class/dto/HarmonDistance.class.php');
	require_once('class/mysql/HarmonDistanceMySqlDAO.class.php');
	require_once('class/mysql/ext/HarmonDistanceMySqlExtDAO.class.php');
	require_once('class/Functions/HarmonDistanceEXT.class.php');
	require_once('class/dao/KeratomeryDAO.class.php');
	require_once('class/dto/Keratomery.class.php');
	require_once('class/mysql/KeratomeryMySqlDAO.class.php');
	require_once('class/mysql/ext/KeratomeryMySqlExtDAO.class.php');
	require_once('class/Functions/KeratomeryEXT.class.php');
	require_once('class/dao/OcularMotilityDAO.class.php');
	require_once('class/dto/OcularMotility.class.php');
	require_once('class/mysql/OcularMotilityMySqlDAO.class.php');
	require_once('class/mysql/ext/OcularMotilityMySqlExtDAO.class.php');
	require_once('class/Functions/OcularMotilityEXT.class.php');
	require_once('class/dao/PreCoverTestDAO.class.php');
	require_once('class/dto/PreCoverTest.class.php');
	require_once('class/mysql/PreCoverTestMySqlDAO.class.php');
	require_once('class/mysql/ext/PreCoverTestMySqlExtDAO.class.php');
	require_once('class/Functions/PreCoverTestEXT.class.php');
	require_once('class/dao/PreOcularMotilityDAO.class.php');
	require_once('class/dto/PreOcularMotility.class.php');
	require_once('class/mysql/PreOcularMotilityMySqlDAO.class.php');
	require_once('class/mysql/ext/PreOcularMotilityMySqlExtDAO.class.php');
	require_once('class/Functions/PreOcularMotilityEXT.class.php');
	require_once('class/dao/PrePupillaryReflexsDAO.class.php');
	require_once('class/dto/PrePupillaryReflex.class.php');
	require_once('class/mysql/PrePupillaryReflexsMySqlDAO.class.php');
	require_once('class/mysql/ext/PrePupillaryReflexsMySqlExtDAO.class.php');
	require_once('class/Functions/PrePupillaryReflexsEXT.class.php');
	require_once('class/dao/PreliminaryExaminationDAO.class.php');
	require_once('class/dto/PreliminaryExamination.class.php');
	require_once('class/mysql/PreliminaryExaminationMySqlDAO.class.php');
	require_once('class/mysql/ext/PreliminaryExaminationMySqlExtDAO.class.php');
	require_once('class/Functions/PreliminaryExaminationEXT.class.php');
	require_once('class/dao/PupillaryReflexsDAO.class.php');
	require_once('class/dto/PupillaryReflex.class.php');
	require_once('class/mysql/PupillaryReflexsMySqlDAO.class.php');
	require_once('class/mysql/ext/PupillaryReflexsMySqlExtDAO.class.php');
	require_once('class/Functions/PupillaryReflexsEXT.class.php');
	require_once('class/dao/VaMeasurementDAO.class.php');
	require_once('class/dto/VaMeasurement.class.php');
	require_once('class/mysql/VaMeasurementMySqlDAO.class.php');
	require_once('class/mysql/ext/VaMeasurementMySqlExtDAO.class.php');
	require_once('class/Functions/VaMeasurementEXT.class.php');
	
?>