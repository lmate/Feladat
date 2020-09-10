<?php

class Admin extends Model
{
    function __construct()
    {
        $this->con = Database::GetCon();
    }

    public function GetUser($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $req = $this->con->prepare($sql);
        $req->execute([
            "username" => $username
        ]);
        return $req->fetch();
    }

    public function InsertOffice($name, $email, $address)
    {
        $sql = "INSERT INTO office (name, seat, email) VALUES (:name, :seat, :email)";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "name" => $name,
            "seat" => $address,
            "email" => $email
        ]);
    }

    public function InsertUser($username, $password, $office)
    {
        $sql = "INSERT INTO users (username, password, office) VALUES (:username, :password, :office)";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "username" => $username,
            "password" => $password,
            "office" => $office
        ]);
    }

    public function InsertInvite($email, $office, $invite_id)
    {
        $sql = "INSERT INTO invites (email, office, invite_id) VALUES (:email, :office, :invite_id)";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "email" => $email,
            "office" => $office,
            "invite_id" => $invite_id
        ]);
    }

    public function GetInvite($invite_id)
    {
        $sql = "SELECT * FROM invites WHERE invite_id = :invite_id";
        $req = $this->con->prepare($sql);
        $req->execute([
            "invite_id" => $invite_id
        ]);
        return $req->fetch();
    }

    public function UpdateOfficeMember($new_office, $username)
    {
        $sql = "UPDATE users SET office = :new_office WHERE username = :username";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "new_office" => $new_office,
            "username" => $username
        ]);
    }

    public function UpdateOfficeMemberPerm($username, $new_perm)
    {
        $sql = "UPDATE users SET permission = :new_perm WHERE username = :username";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "new_perm" => $new_perm,
            "username" => $username
        ]);
    }

    public function UpdateOfficePhone($office, $phone)
    {
        $sql = "UPDATE office SET phone = :phone WHERE name = :office";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "phone" => $phone,
            "office" => $office
        ]);
    }

    public function UpdateOfficePostAddress($office, $address)
    {
        $sql = "UPDATE office SET billing_address = :address WHERE name = :office";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "address" => $address,
            "office" => $office
        ]);
    }

    public function UpdateRequest($isRejected, $isAccepted, $under_review, $company_name)
    {
        $sql = "UPDATE main SET isRejected = :isRejected, isAccepted = :isAccepted, under_review = :under_review WHERE company_name = :company_name";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "isRejected" => $isRejected,
            "isAccepted" => $isAccepted,
            "under_review" => $under_review,
            "company_name" => $company_name
        ]);
    }

    public function GetMemberOffice($username, $office)
    {
        $sql = "SELECT * FROM users WHERE username = :username AND JSON_EXTRACT(office, '$.offices[0]') = :office";
        $req = $this->con->prepare($sql);
        $req->execute([
            "username" => $username,
            "office" => $office
        ]);
        return $req->fetch();
    }

    public function UpdateInvite($email)
    {
        $sql = "DELETE FROM invites WHERE email = :email";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "email" => $email
        ]);
    }

    public function GetOffice($office)
    {
        $sql = "SELECT * FROM office WHERE name = :office";
        $req = $this->con->prepare($sql);
        $req->execute([
            "office" => $office
        ]);
        return $req->fetchAll();
    }

    public function GetOfficeMembers($office)
    {
        $sql = "SELECT username, permission, created_at FROM users WHERE JSON_EXTRACT(office, '$.offices[0]') = :office";
        $req = $this->con->prepare($sql);
        $req->execute([
            "office" => $office
        ]);
        return $req->fetchAll();
    }

    public function UpdatePassword($username, $password)
    {
        $sql = "UPDATE users SET password = :password WHERE username = :username";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "username" => $username,
            "password" => $password
        ]);
    }

    public function GetMain()
    {
        $sql = "SELECT company_name FROM main WHERE under_review = :under_review AND isRejected = 0 AND isAccepted = 0 AND review_by = 'none'";
        $req = $this->con->prepare($sql);
        $req->execute([
            "under_review" => 0
        ]);
        return $req->fetchAll();
    }

    public function UnderReview($company_name, $review_by)
    {
        $sql = "UPDATE main SET under_review = :under_review, review_by = :review_by WHERE company_name = :company_name AND review_by = 'none'";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "under_review" => 1,
            "review_by" =>  $review_by,
            "company_name" => $company_name
        ]);
    }

    public function GetCompany($company_name)
    {
        $sql = "SELECT * FROM main WHERE company_name = :company_name";
        $req = $this->con->prepare($sql);
        $req->execute([
            "company_name" => $company_name
        ]);
        return $req->fetchAll();
    }

    public function NotUnderReview($company_name, $review_by)
    {
        $sql = "UPDATE main SET under_review = :under_review, review_by = :review_by_after WHERE company_name = :company_name AND review_by = :review_by";
        $req = $this->con->prepare($sql);
        return $req->execute([
            "under_review" => 0,
            "review_by" =>  $review_by,
            "review_by_after" =>  "none",
            "company_name" => $company_name
        ]);
    }

    public function GetReviewByProfile($review_by)
    {
        $sql = "SELECT company_name FROM main WHERE under_review = :under_review AND review_by = :review_by";
        $req = $this->con->prepare($sql);
        $req->execute([
            "under_review" => 1,
            "review_by" => $review_by
        ]);
        return $req->fetchAll();
    }

    public function GetAppointmentByReview($username)
    {
        $sql = "SELECT * FROM main WHERE under_review = :under_review AND review_by = :review_by";
        $req = $this->con->prepare($sql);
        $req->execute([
            "under_review" => 1,
            "review_by" => $username
        ]);
        return $req->fetchAll();
    }
}
?>