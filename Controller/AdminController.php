<?php 

require_once '../Models/category.php';
require_once 'DBController.php';
class AdminController
{
    protected $db;

    //1. Open connection.
    //2. Run query & logic.
    //3. Close connection
   
    public function addCategory(Category $cat)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="insert into category values ('','".$cat->getName()."')";
            $result=$this->db->insert($query);
            if($result!=false)
            {
                $this->db->closeConnection();
                return true;
            }
            else
            {
                $_SESSION["errMsg"]="Somthing went wrong... try again later";
                $this->db->closeConnection();
                return false;
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function blockUser($email)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="update user set `blocked` = '1' WHERE user.email = \"".$email."\"";
            $result=$this->db->update($query);
            if($result!=false)
            {
                
                $this->db->closeConnection();
                echo $result;
                return true;
            }
            else
            {
                $_SESSION["errMsg"]="Email is wrong or User already blocked";
                $this->db->closeConnection();
                return false;
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

}

?>