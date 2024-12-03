<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'table';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'field';

    /**
     * Retrieves record(s) from the database
     *
     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
     *                      If associative array is given, it should fit field_name=>value pattern.
     *                      If string, value will be used to match against PRI_INDEX
     * @return mixed Single record if ID is given, or array of results
     */
    public function get($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::TABLE_NAME);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where(self::PRI_INDEX, $where);
            }
        }
        $result = $this->db->get()->result();
        if ($result) {
            if ($where !== NULL) {
                return array_shift($result);
            } else {
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * Inserts new data into database
     *
     * @param Array $data Associative array with field_name=>value pattern to be inserted into database
     * @return mixed Inserted row ID, or false if error occured
     */
    public function insert(Array $data) {
        if ($this->db->insert(self::TABLE_NAME, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * Updates selected record in the database
     *
     * @param Array $data Associative array field_name=>value to be updated
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of affected rows by the update query
     */
    public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);
            }
        $this->db->update(self::TABLE_NAME, $data, $where);
        return $this->db->affected_rows();
    }

    /**
     * Deletes specified record from the database
     *
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of rows affected by the delete query
     */
    public function delete($where = array()) {
        if (!is_array()) {
            $where = array(self::PRI_INDEX => $where);
        }
        $this->db->delete(self::TABLE_NAME, $where);
        return $this->db->affected_rows();
    }

    public function getAllReports($pdata, $getcount=NULL,$cols = "*") {
        $tabelcolumns = array(
            0 => 'p.id',
            1=> 'p.profile_code',
        );

       $search_1 = array(
            1 => 'p.profile_code',
	    2 => 'p.fname',
	    3=>  'p.lname',
	    4=> 'p.sname'
        );

       if(isset($pdata['country_wise']) && $pdata['country_wise']!=""){
            $this->db->where('f.country',$pdata['country_wise']);
        }
        if(isset($pdata['state_wise']) && $pdata['state_wise']!=""){
            $this->db->where('f.state',$pdata['state_wise']);
        }
        if(isset($pdata['city_wise']) && $pdata['city_wise']!=""){
            $this->db->where('f.city',$pdata['city_wise']);
        }
        if(isset($pdata['package_type']) && $pdata['package_type']!=""){
            $this->db->where('m.package',$pdata['package_type']);
        }
        if(isset($pdata['marital_status']) && $pdata['marital_status']!=""){
            $this->db->where('p.marital_status',$pdata['marital_status']);
        }
        if(isset($pdata['status_search']) && $pdata['status_search']!=""){
            $this->db->where('p.profile_status',$pdata['status_search']);
        }
        if(isset($pdata['reference_by']) && $pdata['reference_by']!=""){
            $this->db->where('p.ref_by',$pdata['reference_by']);
        }
        if(isset($pdata['payment_type']) && $pdata['payment_type']!=""){
            $this->db->where('m.payment_status',$pdata['payment_type']);
        }
        if(isset($pdata['bride_type']) && $pdata['bride_type']!=""){
            $this->db->where('p.gender',$pdata['bride_type']);
        }
        if(isset($pdata['from_date']) && $pdata['from_date']!="" && isset($pdata['to_date']) && $pdata['to_date']!="" )
		{
			$created_from = date('Y-m-d',strtotime($pdata['from_date']));
            $created_to = date('Y-m-d',strtotime($pdata['to_date']));
			$this->db->where('p.addedon BETWEEN '."'".$created_from."'".' AND '."'".$created_to."'");
		}
        //count of records
        if($getcount){ 
            $this->db->select('p.profile_code as ProfileCode,p.id as id')->from('tbl_personel as p');
			
			$this->db->join('tbl_family as f','f.profile_code=p.profile_code','left');
			$this->db->join('countries as cou','cou.id=f.country AND cou.id=p.living_in','left');
			$this->db->join('tbl_money as m','m.profile_code=p.profile_code','left');
			$this->db->join('admin_packages as ap','m.package=ap.id OR m.package="-"','left');
			$this->db->join('states as st','st.id=f.state','left');
			$this->db->join('cities as ct','ct.id=f.city','left');
			$this->db->join('tbl_education as ed','ed.edu_id=f.edu','left');
			$this->db->join('tbl_occupation as occ','f.occu=occ.Occ_Id','left');
			$this->db->join('tbl_emplin as emp','f.empin=emp.emp_id','left');
			$this->db->join('tbl_rasi as ra','f.rasi=ra.rasi_id','left');
			$this->db->join('tbl_star as sta','f.star=sta.star_id','left');
                        $this->db->order_by('p.id','desc');
           }
	else{
            $this->db->select('p.profile_code as ProfileCode,p.sname as SurName,p.fname as FirstName,p.lname as LastName,p.gender as Gender,p.dob as DateOfBirth,p.age as Age,p.email as EmailId,p.mobile as MobileNumber,p.marital_status as MartialStatus,p.nochild as NoOfChildrens,cou.name as CountryName,f.phone as PhoneNumber,f.fmobile as AlternateMobileNumber,f.address as PresentAddress,f.perminantaddress as PerminantAddress,cou.name as Country,st.name as State,ct.name as City,ed.education as Education,f.edu_details as EducationDetails,occ.occupation as Occupation,f.occ_details as OccupationDetails,emp.employee as EmployeeIn,f.employmentdetails as EmployemtDetails,f.income as Income,f.feet as Height,f.weight as Weight,f.cmplxion as Complexion,f.body_type as BodyType,f.bldgrp as Bloodgroup,f.splcases as SpecialCases,f.dite as Dite,f.smoke as Smoke,f.drink as Drink,f.aboutme as AbouUs,f.res_status as ResidantType,f.birth_place as BirthPlace,f.hrs as BirthTimeInHours,f.mins as BirthTimeInMin,f.period as BirthTimeperiod,f.birth_name as BirthName,ra.rasi as Rasi,sta.star as StarORNakashtram,f.gowthram as Gowthram,f.paadam as Paadam,f.horoscope as HoroscopeStatus,f.manglik as  ManglinkStatus,f.family_origin as FamilyOrigin,f.father_name as FatherName,f.fa_alive as FatherLiveStatus,f.father_occupation as FatherOccupation,f.mother_name as MotherName,f.ma_alive as MotherAliveStatus,f.mother_occupation as MotherIOccupation,f.elder_bro as NoOfElderNBrothers,f.elder_bro1 as NoOfElderNBrothersMarried,f.young_bro as NoOfYoungerBrothers,f.young_bro1 as NoOfYoungerBrothersMarried,f.elder_sis as NoOfElderSisters,f.elder_sis1 as NoOfElderSistersMarried,f.young_sis as NoOfYoungerSisters,f.young_sis1 as NoOfYoungerSistersMarried,f.age_from as PartnerAgeFrom,f.age_to as partnerAgeTo,f.Complexion_from as PartnerComplexion,f.Education_fromType as partnerEducation,f.EducationDetails_from as PartnerEducationalDetails,f.AnnualIncome_from as PartnerIncome,f.Occuaption_FromType as PartnerEducationFrom,ap.name as Package,m.noofviews as NoOfViews,m.subscribe_validity as SubscriptionValidUpto,m.suscribed_on as AddedOn')->from('tbl_personel as p');
			
			$this->db->join('tbl_family as f','f.profile_code=p.profile_code','left');
			$this->db->join('countries as cou','cou.id=f.country AND cou.id=p.living_in','left');
			$this->db->join('tbl_money as m','m.profile_code=p.profile_code','left');
			$this->db->join('admin_packages as ap','m.package=ap.id OR m.package="-"','left');
			$this->db->join('states as st','st.id=f.state','left');
			$this->db->join('cities as ct','ct.id=f.city','left');
			$this->db->join('tbl_education as ed','ed.edu_id=f.edu','left');
			$this->db->join('tbl_occupation as occ','f.occu=occ.Occ_Id','left');
			$this->db->join('tbl_emplin as emp','f.empin=emp.emp_id','left');
			$this->db->join('tbl_rasi as ra','f.rasi=ra.rasi_id','left');
			$this->db->join('tbl_star as sta','f.star=sta.star_id','left');
                        $this->db->order_by('p.id','desc');
        }
        if(isset($pdata['search_text1'])&& $pdata['search_text1']!=""){
           $this->db->like($search_1[$pdata['search_on1']], $pdata['search_text1'] );
        }
	
        if($getcount){
            return $this->db->get()->num_rows();
        }
        //for records
        if(isset($pdata['length'])){
        $perpage = $pdata['length'];
        $limit = $pdata['start'];

        $orderby_field = $tabelcolumns[$pdata['order'][0]['column']]; 
        $orderby = $pdata['order']['0']['dir'];

        $generatesno = $limit+1;
        $this->db->order_by($orderby_field,$orderby);
        $this->db->limit($perpage,$limit);
        }else{
            $generatesno = 0;
        }
        $allstaff = $this->db->get()->result_array();
        //echo $this->db->last_query();exit();
        foreach($allstaff as $key=>$values){
        	if($cols == "*"){
        		$allstaff[$key]['sno'] = $generatesno++;
            	$allstaff[$key]['FullName'] = $allstaff[$key]['FirstName']." ".$allstaff[$key]['LastName']." ".$allstaff[$key]['SurName'];
        	}
        }
        return $allstaff;
    }

    public function getAllUserContactReports($pdata, $getcount=NULL) {
        $tabelcolumns = array(
            0 => 'profile_code',
        );
        //count of records
        if($getcount){ 
            return $this->db->select('profile_code')->from('tbl_personel');
        } else {
            $this->db->select('profile_code,CONCAT(fname," ",lname," ",sname),email,mobile,gender')->from('tbl_personel');
    	}
        if($getcount){
            return $this->db->get()->num_rows();
        }
        //for records
        if(isset($pdata['length'])){
        $perpage = $pdata['length'];
        $limit = $pdata['start'];

        $orderby_field = $tabelcolumns[$pdata['order'][0]['column']]; 
        $orderby = $pdata['order']['0']['dir'];

        $generatesno = $limit+1;
        $this->db->order_by($orderby_field,$orderby);
        $this->db->limit($perpage,$limit);
        }else{
            $generatesno = 0;
        }
        $result = $this->db->get()->result_array();
        
        foreach($result as $key=>$values){
        }
        return $result;
    }

    public function getcountries(){
    	$q = $this->db->select('id as country_id,name as country')->from('countries')->get();
    	if($q->num_rows () >0){
    		$r = $q->result_array();
    		return $r;
    	} 
    }

    public function getstates(){
    	$q = $this->db->select('id as StateID,name as StateName')->from('states')->get();
    	if($q->num_rows () >0){
    		$r = $q->result_array();
    		return $r;
    	} 
    }

    public function getcities(){
    	$q = $this->db->select('id,name')->from('cities')->get();
    	if($q->num_rows () >0){
    		$r = $q->result_array();
    		return $r;
    	} 
    }
}
        