<?php
session_start();

class Users
{
    private $id;
    private $name;
    private $email;
    private $role;
    private $status;
    private $password;

    function __construct($dbconnect)
    {
        $this->dbconnect = $dbconnect;
    }

    function executeQuery($sql)
    {
        return mysqli_query($this->dbconnect, $sql);
    }

    function getUser($email, $password)
    {
        $loggedUser = [];
        $sql        = "SELECT * FROM school.users WHERE email='$email' AND password='$password'";
        $result     = $this->executeQuery($sql);
        if (mysqli_num_rows($result) > 0) {
            While ($row = $result->fetch_assoc()) {
                $loggedUser = $row;
            }
        } else {
            $loggedUser = "null";
        }

        return $loggedUser;
    }

    function getAllCategories()
    {
        $categories = [];
        $sql        = "SELECT * FROM school.categories";
        $result     = $this->executeQuery($sql);
        if (mysqli_num_rows($result) > 0) {
            While ($row = $result->fetch_assoc()) {

                $categories[$row['idCategory']] = $row;
            }
        }

        return $categories;
    }

    function showAllCategories($categories)
    {
        $text = "<table>";
        foreach ($categories as $key => $info) {
            $text = $text . " " . "<tr>\n";
            $text = $text . " " . "<td>" . $info['idCategory'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['categoryName'] . "</td>\n";
            $text = $text . " " . "<td><a href='deleteCategory.php?comanda=delete&idCategory=" . $info['idCategory'] . "'>Delete</a></td>\n";
            $text = $text . " " . "<td><a href='editCategory.php?comanda=edit&idCategory=" . $info['idCategory'] . "'>Edit</a></td>\n";
            $text = $text . " " . "</tr>\n";
        }
        $text = $text . " " . "</table>";

        return $text;
    }

    function getInfoCategory($idCategory)
    {
        $sql    = "SELECT * FROM school.categories WHERE idCategory='$idCategory'";
        $result = $this->executeQuery($sql);
        While ($row = $result->fetch_assoc()) {
            $categoryInformations["idCategory"]   = $row['idCategory'];
            $categoryInformations["categoryName"] = $row['categoryName'];
        }

        return $categoryInformations;
    }

    function updateCategory($requestData, $idCategory)
    {
        $categoryInformations["categoryName"] = $requestData["categoryName"];
        if (isset($requestData['edit'])) {
            $sql = "UPDATE school.categories
                        SET  categoryName='" . $categoryInformations["categoryName"] . "'
                        WHERE idCategory= '$idCategory'";
            if ($this->executeQuery($sql)) {
                echo "Updated";
            } else {
                echo "Not updated";
            }
        }
    }

    function getAllSubcategories()
    {
        $subcategories = [];
        $sql           = "SELECT categories.idCategory, categories.categoryName,subcategories.subcategoryName,
                                  subcategories.idSubcategory, subcategories.idCategory 
                            FROM  school.subcategories
                             INNER  JOIN school.categories ON categories.idCategory=subcategories.idCategory";
        $result        = $this->executeQuery($sql);
        While ($row = $result->fetch_assoc()) {
            $subcategories[$row['idSubcategory']] = $row;
        }

        return $subcategories;
    }

    function showAllSubcategories($subcategories)
    {
        $text = "<table>";
        foreach ($subcategories as $key => $info) {
            $text = $text . " " . "<tr>\n";
            $text = $text . " " . "<td>" . $info['idSubcategory'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['categoryName'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['subcategoryName'] . "</td>\n";
            $text = $text . " " . "<td><a href='deleteSubcategory.php?comanda=delete&idSubcategory=" . $info['idSubcategory']
                . "'>Delete</a></td>\n";
            $text = $text . " " . "</tr>\n";
        }
        $text = $text . " " . "</table>";

        return $text;
    }

    function addNewCategory($requestData)
    {
        $categoryName = $requestData["categoryName"];
        $check        = "SELECT * FROM school.categories WHERE categoryName='$categoryName'";
        if (mysqli_num_rows($this->executeQuery($check)) >= 1) {
            echo "Category Already  Exists<br/>";
        } else {
            $sql = "INSERT INTO `school`.`categories` (`categoryName`) 
                       VALUES ('$categoryName')";
            if ($this->executeQuery($sql)) {
                echo "Category added";
            } else {
                echo "Category not added";
            }
        }
    }

    function dropDownCategories()
    {
        $sql    = "SELECT * FROM school.categories";
        $result = $this->executeQuery($sql);
        if (mysqli_num_rows($result) > 0) {
            While ($row = $result->fetch_assoc()) {
                $idCategory   = $row['idCategory'];
                $categoryName = $row['categoryName'];
                echo '<option value="' . $idCategory . '">' . $categoryName . '</option>';
            }
        }
    }

    function dropDownSubcategories()
    {
        $sql    = "SELECT categories.idCategory, categories.categoryName,subcategories.subcategoryName 
                            FROM  school.categories
                             INNER  JOIN school.subcategories ON categories.idCategory=subcategories.idCategory";
        $result = $this->executeQuery($sql);
        if ($result) {
            While ($row = $result->fetch_assoc()) {
                $idSubcategory   = $row['idSubcategory'];
                $subcategoryName = $row['subcategoryName'];
                echo '<option value="' . $idSubcategory . '">' . $subcategoryName . '</option>';
            }
        }
    }

    function addNewSubcategory($requestData)
    {
        $subcategoryName = $requestData["subcategoryName"];
        $idCategory      = $requestData['dropDownCategories'];
        $sql             = "INSERT INTO school.subcategories (idCategory,subcategoryName) 
                       VALUES ('$idCategory','$subcategoryName')";
        if ($this->executeQuery($sql)) {
            echo "Subcategory added";
        } else {
            echo "Subcategory not added";
        }
    }

    function getAllUsers()
    {
        $allUsers = [];
        $sql      = "SELECT * FROM school.users";
        $result   = $this->executeQuery($sql);
        if (mysqli_num_rows($result) > 0) {
            While ($row = $result->fetch_assoc()) {
                $allUsers[$row['userId']] = $row;
            }
        }

        return $allUsers;
    }

    function viewAllUsers($allUsers)
    {
        $text = "<table>";
        foreach ($allUsers as $key => $info) {
            $text = $text . " " . "<tr>\n";
            $text = $text . " " . "<td>" . $info['userId'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['name'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['email'] . "</td>\n";
            if ($info['role'] == 1) {
                $text = $text . " " . "<td>" . "admin" . "</td>\n";
            }
            if ($info['role'] == 2) {
                $text = $text . " " . "<td>" . "professor" . "</td>\n";
            }
            if ($info['role'] == 3) {
                $text = $text . " " . "<td>" . "pupil" . "</td>\n";
            }
            if ($info['status'] == 2) {
                $text = $text . " " . "<td>" . "inactive" . "</td>\n";
            }
            if ($info['status'] == 1) {
                $text = $text . " " . "<td>" . "active" . "</td>\n";
            }
            $text = $text . " " . "<td><a href='deleteUser.php?comanda=delete&userId=" . $info['userId'] . "'>Delete</a></td>\n";
            $text = $text . " " . "<td><a href='editUser.php?comanda=edit&userId=" . $info['userId'] . "'>Edit</a></td>\n";
            $text = $text . " " . "</tr>\n";
        }
        $text = $text . " " . "</table>";

        return $text;
    }

    function delete($userId)
    {
        $sql = "DELETE FROM school.users WHERE userId='$userId'";
        if (!$this->executeQuery($sql)) {
            die('Error: ' . mysqli_error($this->dbconnect));
        } else {
            echo "User deleted";
        }
    }

    function deleteCategory($idCategory)
    {
        $sql = "DELETE FROM school.categories WHERE idCategory='$idCategory'";
        if (!$this->executeQuery($sql)) {
            die('Error: ' . mysqli_error($this->dbconnect));
        } else {
            echo "Category deleted";
        }
    }

    function deleteSubcategory($idSubcategory)
    {
        $sql = "DELETE FROM school.subcategories WHERE idSubcategory='$idSubcategory'";
        if (!$this->executeQuery($sql)) {
            die('Error: ' . mysqli_error($this->dbconnect));
        } else {
            echo "Subcategory deleted";
        }
    }

    function getInfo($userId)
    {
        $sql    = "SELECT * FROM school.users WHERE userId='$userId'";
        $result = $this->executeQuery($sql);
        if ($result) {
            While ($row = $result->fetch_assoc()) {
                $userInformations["userId"]   = $row['userId'];
                $userInformations["name"]     = $row['name'];
                $userInformations["email"]    = $row['email'];
                $userInformations["password"] = $row['password'];
                $userInformations["role"]     = $row['role'];
                $userInformations["status"]   = $row['status'];
            }
        }

        return $userInformations;
    }

    function update($userId, $requestData)
    {
        $userInformations["name"]     = $requestData["name"];
        $userInformations["email"]    = $requestData["email"];
        $userInformations["password"] = $requestData["password"];
        $userInformations["role"]     = $requestData["role"];
        $userInformations["status"]   = $requestData["status"];

        if (isset($requestData['edit'])) {
            $sql = "UPDATE school.users
                        SET  name='" . $userInformations["name"] . "',email='" . $userInformations["email"] . "',
                                     password='" . $userInformations["password"] . "',
                                     role='" . $userInformations["role"] . "', status='" . $userInformations["status"] . "'
                        WHERE userId= '$userId'";

            if ($this->executeQuery($sql)) {
                echo "Updated";
            } else {
                echo "Not updated";
            }
        }

    }

    function addNewUser($requestData)
    {
        $name     = $requestData["name"];
        $email    = $requestData["email"];
        $password = $requestData["password"];
        $role     = $requestData["role"];
        $status   = $requestData["status"];

        $check = "SELECT * FROM school.users WHERE email='$email'";
        if (mysqli_num_rows($this->executeQuery($check)) >= 1) {
            echo "User Already  Exists<br/>";
        } else {
            $sql = "INSERT INTO school.users(name, email, password, role, status) 
                       VALUES ('$name','$email', '$password', '$role','$status')";
            if ($this->executeQuery($sql)) {
                echo "User added";
            } else {
                echo "User not added";
            }
        }
    }

    function getAllSubjects()
    {
        $subjects = [];
        $sql      = "SELECT categories.idCategory,categories.categoryName,subjects.idCategory,subjects.idSubcategory,
                              subcategories.idSubcategory,
                            subcategories.subcategoryName, subjects.subjectName,subjects.fileName,subjects.id                            
                  FROM school.subjects 
                      INNER JOIN  school.categories ON categories.idCategory=subjects.idCategory
                        INNER JOIN school.subcategories ON subcategories.idSubcategory=subjects.idSubcategory";
        $result   = $this->executeQuery($sql);
        While ($row = $result->fetch_assoc()) {
            $subjects[$row['id']] = $row;
        }

        return $subjects;
    }

    function showAllSubjects($subjects, $sessionData)
    {
        $text = "<table>";
        foreach ($subjects as $key => $info) {
            $text = $text . " " . "<tr>\n";
            $text = $text . " " . "<td>" . $info['id'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['categoryName'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['subcategoryName'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['subjectName'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['fileName'] . "</td>\n";
            $text = $text . " " . "<td><a href='downloadSubject.php?comanda=download&id=" . $info['id'] . "'>Download</a></td>\n";
            if ($sessionData['role'] == 2 || $sessionData['role'] == 1) {
                $text = $text . " " . "<td><a href='deleteSubject.php?comanda=delete&id=" . $info['id'] . "'>Delete</a></td>\n";
            }
            $text = $text . " " . "</tr>\n";
        }
        $text = $text . " " . "</table>";

        return $text;
    }

    function deleteSubject($id)
    {
        $sql = "DELETE FROM school.subjects WHERE id='$id'";
        if (!$this->executeQuery($sql)) {
            die('Error: ' . mysqli_error($this->dbconnect));
        } else {
            echo "Subject deleted";
        }
    }

    function uploadFile($idCategory, $requestData, $requestFile, $sessionData)
    {
        $targetDir      = "uploads/";
        $fileName       = basename($requestFile['file']['name']);
        $targetFilePath = $targetDir . $fileName;
        $subjectName    = $requestData['subjectName'];
        $userId         = $sessionData['id'];
        $idSubcategory  = $requestData['dropDownSubcategories'];

        if (move_uploaded_file($requestFile['file']['tmp_name'], $targetFilePath)) {

            $sql = "INSERT INTO school.subjects (idCategory,idSubcategory,subjectName,fileName,userId) 
                      VALUES ('$idCategory','$idSubcategory','$subjectName','$fileName','$userId')";
            if ($this->executeQuery($sql)) {
                $statusMsg = "The file  has been uploaded successfully.";
            } else {
                $statusMsg = "File upload failed, please try again.";
            }
        } else {
            $statusMsg = "Sorry, there was an error uploading your file.";
        }

        return $statusMsg;
    }

    function downloadSubject($id)
    {
        $sql    = "SELECT * FROM school.subjects WHERE id='$id'";
        $result = $this->executeQuery($sql);
        While ($row = $result->fetch_assoc()) {
            $fileName = $row['fileName'];
            $path     = 'downloads/' . $fileName;
            $size     = filesize($path);
            header('Content-Type: application/octet-stream');
            header('Content-Length: ' . $size);
            header('Content-Disposition: attachment; filename=' . $fileName);
            header('Content-Transfer-Encoding: binary');
        }
    }

    static function getAllRoles()
    {
        $roles = "";
        $roles = $roles . "<option value='1'>Admin</option>";
        $roles = $roles . "<option value='2'>Professor</option>";
        $roles = $roles . "<option value='3'>Pupil</option>";

        return $roles;
    }

    static function getAllStatus()
    {
        $status = "";
        $status = $status . "<option value='2'>Inactive</option>";
        $status = $status . "<option value='1'>Active</option>";

        return $status;
    }

    function getAuthors()
    {
        $sql    = "SELECT authors.authorName,group_concat(genders.genderName)
                    FROM school.authors 
                    JOIN school.author_gender ON authors.idAuthor=author_gender.idAuthor
                    JOIN school.genders ON genders.idGender=author_gender.idGender
                    GROUP BY authors.idAuthor";
        $result = $this->executeQuery($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $authors[$row['idAuthor']] = $row;
            }
        }
        return $authors;
    }

    function showAllAuthors($authors)
    {
        $text = "<table>";
        foreach ($authors as $key => $info) {
            $text = $text . " " . "<tr>\n";
            $text = $text . " " . "<td>" . $info['idAuthor'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['authorName'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['genderName'] . "</td>\n";
            $text = $text . " " . "<td><a href='deleteAuthor.php?comanda=delete&idAuthor=" . $info['idAuthor'] . "'>Delete</a></td>\n";
            $text = $text . " " . "<td><a href='editAuthor.php?comanda=edit&idAuthor=" . $info['idAuthor'] . "'>Edit</a></td>\n";
            $text = $text . " " . "</tr>\n";
        }
        $text = $text . " " . "</table>";

        return $text;
    }

    function getBooks()
    {
        $books  = [];
        $sql    = "SELECT books.title,authors.authorName,genders.genderName
                FROM school.books 
                JOIN school.authors ON authors.idAuthor=books.idAuthor
                JOIN school.genders ON genders.idGender=books.idGender";
        $result = $this->executeQuery($sql);
        if (mysqli_num_rows($result) > 0) {
            While ($row = $result->fetch_assoc())  {
                $books[$row['idBook']] = $row;
            }
        }
        return $books;
    }

    function viewAllBooks($books)
    {
        $text = "<table>";
        foreach ($books as $key => $info) {
            $text = $text . " " . "<tr>\n";
            $text = $text . " " . "<td>" . $info['title'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['authorName'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['genderName'] . "</td>\n";
        }
        $text = $text . " " . "</table>";

        return $text;
    }

    function getGenders()
    {
        $genders = [];
        $sql        = "SELECT * FROM school.genders";
        $result     = $this->executeQuery($sql);
        if (mysqli_num_rows($result) > 0) {
            While ($row = $result->fetch_assoc()) {

                $genders[$row['idGender']] = $row;
            }
        }

        return $genders;
    }
    function showAllGenders($genders)
    {
        $text = "<table>";
        foreach ($genders as $key => $info) {
            $text = $text . " " . "<tr>\n";
            $text = $text . " " . "<td>" . $info['idGender'] . "</td>\n";
            $text = $text . " " . "<td>" . $info['genderName'] . "</td>\n";
            $text = $text . " " . "<td><a href='deleteGender.php?comanda=delete&idGender=" . $info['idGender'] . "'>Delete</a></td>\n";
            $text = $text . " " . "<td><a href='editGender.php?comanda=edit&idGender=" . $info['idGender'] . "'>Edit</a></td>\n";
            $text = $text . " " . "</tr>\n";
        }
        $text = $text . " " . "</table>";

        return $text;
    }

    function getInfoGender($idGender)
    {
        $sql    = "SELECT * FROM school.genders WHERE idGender='$idGender'";
        $result = $this->executeQuery($sql);
        While ($row = $result->fetch_assoc()) {
            $genderInfo["idGender"]   = $row['idGender'];
            $genderInfo["genderName"] = $row['genderName'];
        }

        return $genderInfo;
    }

    function updateGender($requestData, $idGender)
    {
        $genderInfo["genderName"] = $requestData["genderName"];
        if (isset($requestData['edit'])) {
            $sql = "UPDATE school.genders
                        SET  genderName='" . $genderInfo["genderName"] . "'
                        WHERE idGender= '$idGender'";
            if ($this->executeQuery($sql)) {
                echo "Updated";
            } else {
                echo "Not updated";
            }
        }
    }
    function deleteGender($idGender)
    {
        $sql = "DELETE FROM school.genders WHERE idGender='$idGender'";
        if (!$this->executeQuery($sql)) {
            die('Error: ' . mysqli_error($this->dbconnect));
        } else {
            echo "Gender deleted";
        }
    }
    function addNewGender($requestData)
    {
        $genderName = $requestData["genderName"];
        $check        = "SELECT * FROM school.genders WHERE genderName='$genderName'";
        if (mysqli_num_rows($this->executeQuery($check)) >= 1) {
            echo "Gender Already  Exists<br/>";
        } else {
            $sql = "INSERT INTO `school`.`genders` (`genderName`) 
                       VALUES ('$genderName')";
            if ($this->executeQuery($sql)) {
                echo "Gender added";
            } else {
                echo "Gender not added";
            }
        }
    }

}

?>