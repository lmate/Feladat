<?php

class Form
{
    function __construct()
    {
        $this->con = Database::GetCon();
    }

    public function Insert($company_name, $directory_name, $email, $value)
    {
        $sql = "INSERT INTO main (company_name, directory_name, email, value) VALUES (:company_name, :directory_name, :email, :value)";

        $request = $this->con->prepare($sql);
        return $request->execute([
            "company_name" => $company_name,
            "directory_name" => $directory_name,
            "email" => $email,
            "value" => $value
        ]);
    }

    public function GetMain($company_name)
    {
        $sql = "SELECT * FROM main WHERE company_name = :company_name";

        $request = $this->con->prepare($sql);
        $request->execute([
            "company_name" => $company_name
        ]);
        return $request->fetch();
    }

    public function Save($uuid)
    {
        $sql = "INSERT INTO save (save_id) VALUES (:save_id)";

        $request = $this->con->prepare($sql);
        return $request->execute([
            "save_id" => $uuid
        ]);
    }

    public function GetSave($uuid)
    {
        $sql = "SELECT * FROM save WHERE save_id = :save_id";
        $sql2 = "UPDATE save SET accessed_at = :accessed_at WHERE save_id = :save_id";

        $request2 = $this->con->prepare($sql2);
        $request2->execute([
            "accessed_at" => time(),
            "save_id" => $uuid
        ]);

        $request = $this->con->prepare($sql);
        $request->execute([
            "save_id" => $uuid
        ]);
        return $request->fetch();
    }
}
?>