<?php
class query
{
    private $pg_con;

    function __construct($pg_con)
    {
        $this->pg_con = $pg_con;
    }

    function add_user ($social_id, $first_name, $last_name, $user_json, $email = NULL, $social_type, $telefon = NULL, $id_place = NULL) {
        pg_prepare($this->pg_con, "new_user", 'INSERT INTO myschema.users(social_id, firstname, surname, email, telefon, social, social_type, id_place) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)');
        pg_execute($this->pg_con, "new_user", array($social_id, $first_name, $last_name, $email, $telefon, $user_json, $social_type, $id_place));
    }

    function add_record ($id_user, $result = NULL) {
        pg_prepare($this->pg_con, "new_activity", 'INSERT INTO myschema.user_activity(id_user, start_activity, result) VALUES ($1, now(), $2)');
        pg_execute($this->pg_con, "new_activity", array($id_user, $result));
    }


}