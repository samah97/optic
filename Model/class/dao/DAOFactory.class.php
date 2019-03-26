<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return AmbianceDAO
	 */
	public static function getAmbianceDAO(){
		return new AmbianceMySqlExtDAO();
	}

	/**
	 * @return AntecedentDiseaseDAO
	 */
	public static function getAntecedentDiseaseDAO(){
		return new AntecedentDiseaseMySqlExtDAO();
	}

	/**
	 * @return ConsulationFsDAO
	 */
	public static function getConsulationFsDAO(){
		return new ConsulationFsMySqlExtDAO();
	}

	/**
	 * @return ConsultationVpDAO
	 */
	public static function getConsultationVpDAO(){
		return new ConsultationVpMySqlExtDAO();
	}

	/**
	 * @return ControlDAO
	 */
	public static function getControlDAO(){
		return new ControlMySqlExtDAO();
	}

	/**
	 * @return DiseaseDAO
	 */
	public static function getDiseaseDAO(){
		return new DiseaseMySqlExtDAO();
	}

	/**
	 * @return FunctionalSignDAO
	 */
	public static function getFunctionalSignDAO(){
		return new FunctionalSignMySqlExtDAO();
	}

	/**
	 * @return PatientInfoDAO
	 */
	public static function getPatientInfoDAO(){
		return new PatientInfoMySqlExtDAO();
	}

	/**
	 * @return ReasonConsultationDAO
	 */
	public static function getReasonConsultationDAO(){
		return new ReasonConsultationMySqlExtDAO();
	}

	/**
	 * @return RefContactDAO
	 */
	public static function getRefContactDAO(){
		return new RefContactMySqlExtDAO();
	}

	/**
	 * @return RefEyeglassesDAO
	 */
	public static function getRefEyeglassesDAO(){
		return new RefEyeglassesMySqlExtDAO();
	}

	/**
	 * @return RefractionHistoryDAO
	 */
	public static function getRefractionHistoryDAO(){
		return new RefractionHistoryMySqlExtDAO();
	}

	/**
	 * @return TypeCorrectionDAO
	 */
	public static function getTypeCorrectionDAO(){
		return new TypeCorrectionMySqlExtDAO();
	}

	/**
	 * @return VisualAntecedentDAO
	 */
	public static function getVisualAntecedentDAO(){
		return new VisualAntecedentMySqlExtDAO();
	}

	/**
	 * @return VisualNeedDAO
	 */
	public static function getVisualNeedDAO(){
		return new VisualNeedMySqlExtDAO();
	}

	/**
	 * @return VisualProblemDAO
	 */
	public static function getVisualProblemDAO(){
		return new VisualProblemMySqlExtDAO();
	}

	/**
	 * @return WearTypeDAO
	 */
	public static function getWearTypeDAO(){
		return new WearTypeMySqlExtDAO();
	}

	/**
	 * @return WorkStationDAO
	 */
	public static function getWorkStationDAO(){
		return new WorkStationMySqlExtDAO();
	}


}
?>