<?php

class Helper
{
    public $errors = array();

    function validLogin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["email"])) {
                $this->errors["emailErr"] = "Required";
            }
            if (empty($_POST["password"])) {
                $this->errors["passwordErr"] = "Required";
            }
            return $this->errors;
        }
    }

    function isValidLogin()
    {
        $this->errors = $this->validLogin();
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    function validUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $this->errors["nameErr"] = "Required";
            }
            if (empty($_POST["email"])) {
                $this->errors["emailErr"] = "Required";
            }
            if (empty($_POST["password"])) {
                $this->errors["passwordErr"] = "Required";
            }
            if (empty($_POST["role"])) {
                $this->errors["roleErr"] = "Required";
            }
            if (empty($_POST["status"])) {
                $this->errors["statusErr"] = "Required";
            }
        }
        return $this->errors;
    }

    function isValidUser()
    {
        $this->errors = $this->validUser();
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    function validCategory()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["categoryName"])) {
                $this->errors["categoryNameErr"] = "Required";
            }
        }
        return $this->errors;
    }

    function isValidCategory()
    {
        $this->errors = $this->validCategory();
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    function validSubcategory()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["dropDownCategories"])) {
                $this->errors["dropDownMenuErr"] = "Required";
            }
            if (empty($_POST["subcategoryName"])) {
                $this->errors["subcategoryNameErr"] = "Required";
            }
        }
        return $this->errors;
    }

    function isValidSubcategory()
    {
        $this->errors = $this->validSubcategory();
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    function validSubject()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["dropDownCategories"])) {
                $errors["dropDownCategoriesErr"] = "Required";
            }
            if (empty($_POST["subjectName"])) {
                $errors["subjectNameErr"] = "Required";
            }
            if (empty($_POST["dropDownSubcategories"])) {
                $errors["dropDownSubcategoriesErr"] = "Required";
            }
        }
        return $this->errors;
    }

    function isValidSubject()
    {
        $this->errors = $this->validSubject();
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
    function validGender()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["genderName"])) {
                $this->errors["genderNameErr"] = "Required";
            }
        }
        return $this->errors;
    }

    function isValidGender()
    {
        $this->errors = $this->validGender();
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
}
?>