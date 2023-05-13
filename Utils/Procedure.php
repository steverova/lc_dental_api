<?php
class Procedure
{
    public static $sp_user_list = "call sp_users_getAll()";

    //------------------------ PATIENT PROCEDURES -----------------------

    public static $sp_patients_create = "call sp_patients_create(?,?,?,?,?,?,?,?)";
    public static $sp_patients_getAll = "CALL sp_patients_getAll()";
    public static $sp_patients_getByLimit = "call sp_patients_getbylimit(?)";
    public static $sp_patients_update = "call sp_patients_update(?,?,?,?,?,?,?,?,?)";
    public static $sp_patients_search = "call sp_patients_search(?)";
    public static $sp_patients_status = "call sp_patients_status(?)";
    public static $sp_patient_findById = "call sp_patients_findbyid(?)";
    public static $sp_patients_exist = "call sp_patients_exist(?)";
    public static $sp_patients_getByOption = "call sp_patients_getByOption(?)";
    public static $sp_patient_validate_id_card = "call sp_patient_validate_id_card(?)";
    public static $sp_patient_validate_email = "call sp_patient_validate_email(?)";

    //------------------------ APPOINMENTS PROCEDURES -----------------------
    public static $sp_appointments_create = "call sp_appointments_create(?,?,?)";
    public static $sp_appointments_delete = "call sp_appointments_delete(?)";
    public static $sp_appointments_find_data = "call sp_appointments_find_data(?,?,?)";
    public static $sp_appointments_history = "call sp_appointments_history(?,?)";
    public static $sp_appointments_update = "call sp_appointments_update(?,?,?)";
    public static $sp_appointments_exist = "call sp_appointments_exist(?)";
    public static $sp_appointments_findbyid = "call sp_appointments_findbyid(?)";
    public static $sp_appointments_patient_lastAppointment_bymonth = "call sp_appointments_patient_lastAppointment_bymonth(?)";
    public static $sp_appointments_get_today = "call sp_appointments_get_today()";

    public static $sp_appointment_change_assistance = "call sp_appointment_change_assistance(?)";

    public static $sp_appointments_getNextDay = "call sp_appointments_getNextDay()";


    //------------------------ IMAGES PROCEDURES -----------------------

    public static $sp_images_create = "call sp_images_create(?,?)";
    public static $sp_images_getbyid = "call sp_images_getbyid(?)";
    public static $sp_images_delete = "call sp_images_delete(?)";
    public static $sp_images_exist = "call sp_images_exist(?)";

    //---------------------------- TREATMENTS PROCEDURE ---------------------- 

    public static $sp_treatments_insert = "call sp_treatments_insert(?,?,?)";
    public static $sp_treatments_delete = "call sp_treatments_delete(?)";
    public static $sp_treatments_update = "call sp_treatments_update(?,?,?,?)";
    public static $sp_treatments_select = "call sp_treatments_select()";
    public static $sp_treatments_getbyid = "call sp_treatments_getbyid(?)";
    public static $sp_treatments_exist = "call sp_treatments_exist(?)";


 //---------------------------- LOGIN PROCEDURE ---------------------- 

 public static $sp_users_login_create = "call sp_users_login_create(?,?,?,?,?,?,?)";
 public static $sp_account_confirm_create = "call sp_account_confirm_create(?,?)";
 public static $sp_generated_code = "call sp_generated_code(?,?)";
 public static $sp_confirm_code = "call sp_confirm_code(?,?)";
 public static $sp_active_user = "call sp_active_user(?)";
 public static $sp_login_user = "call sp_login_user(?,?)";
 public static $sp_get_user_by_username_or_email = "call sp_get_user_by_username_or_email (?)";
 public static $sp_users_login_update = "call sp_users_login_update(?,?,?,?,?,?,?)";
//============================Setting==================================//

public static $sp_settings_create = "call sp_settings_create(?,?)";
public static $sp_settings_getData = "call sp_settings_getData()";
public static $sp_settings_update = "call sp_settings_update(?,?,?)";
public static $sp_setting_delete = "call sp_setting_delete(?)";
public static $sp_settings_exist = "call sp_settings_exist(?)";
public static $sp_settings_findbyid = "call sp_settings_findbyid(?)";

//============================notes==================================//


public static $sp_note_create = "call sp_note_create(?)";
public static $sp_note_change_done = "call sp_note_change_done(?)";
public static $sp_note_delete = "call sp_note_delete(?)";
public static $sp_note_getAll = "call sp_note_getAll()";
public static $sp_note_exist = "call sp_note_exist(?)";

}
