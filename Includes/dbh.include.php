<?php
require_once 'Users.php';
require_once 'signup.include.php';
//? dbClass Is Containing All The Functions And The DATABASE Connection That We Need It For Use
class dbClass
{
    private static $host;
    private static $db;
    private static $charset;
    private static $user;
    private static $pass;
    private static $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    private static $connection;
    private static $obj;

    public function __construct(string $host = "localhost", string $db = "phpproject", string $charset = "utf8", string $user = "root", string $pass = "")
    {
        // Define The SQL DATA BASE INFORMATION
        self::$host = $host;
        self::$db = $db;
        self::$charset = $charset;
        self::$user = $user;
        self::$pass = $pass;
    }

    public function GetInstance():
        dbClass
        {
            if (self::$obj == null) self::$obj = new dbClass();
            return self::$obj;
        }
        // Connection Function .
        public static function connect()
        {
            $dns = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
            self::$connection = new PDO($dns, self::$user, self::$pass, self::$opt);
        }
        public static function disconnect()
        {
            self::$connection = null;
        }

        //? We Call This Function When We Want To Create A New User.
        public function CreateUser(User $user)
        {
            self::connect();
            $name = $user->getUserName();
            $message = "$name Would Like To Request An Account";
            // SQL Query That We Send To Our SQL DATABASE.
            $sql = "INSERT INTO requests(requests_Name,requests_Email,requests_Uid,requests_Pwd,requests_Message,requests_Date) 
             VALUES(:requests_Name, :requests_Email, :requests_Uid,:requests_Pwd,'$message',CURRENT_TIMESTAMP)";
            // Preparing The Query With A Connection To The Date.
            $statement = self::$connection->prepare($sql);
            // Executing The Query
            $results = $statement->execute([":requests_Name" => $user->getUserName() , ":requests_Email" => $user->getEmail() , ":requests_Uid" => $user->getUid() , ":requests_Pwd" => $user->getPwd() ]);
            self::disconnect();
            // If The Executed Query Return True We Return Success.
            if ($results)
            {
                return 'Success';
            }
            // If The Executed Query Return True We Return Failed.
            else
            {
                return 'Failed';
            }

        }

        //? We Call This Function When We Want To Create A New User.
        public function CreateAdmin(User $user)
        {
            self::connect();
            $name = $user->getUserName();
            // SQL Query That We Send To Our SQL DATABASE.
            $sql = "INSERT INTO admins(adminName,adminEmail,adminUid,adminPwd) 
              VALUES(:Admin_Name, :Admin_Email, :Admin_Uid,:Admin_Pwd)";
            // Preparing The Query With A Connection To The Date.
            $statement = self::$connection->prepare($sql);
            // Executing The Query
            $results = $statement->execute([":Admin_Name" => $user->getUserName() , ":Admin_Email" => $user->getEmail() , ":Admin_Uid" => $user->getUid() , ":Admin_Pwd" => $user->getPwd() ]);
            self::disconnect();
            // If The Executed Query Return True We Return Success.
            if ($results)
            {
                return 'Success';
            }
            // If The Executed Query Return True We Return Failed.
            else
            {
                return 'Failed';
            }

        }

        //? A Function That Check If UserName Is Already Exists In The DATABASE.
        public function UidExists(User $user)
        {

            self::connect();
            // SQL Query That We Send To Our SQL DATABASE.
            $sql = "SELECT * FROM users WHERE usersUid =:userUid";
            // Preparing The Query With A Connection To The Date.
            $statement = self::$connection->prepare($sql);
            // Executing The Query
            $statement->execute([":userUid" => $user->getUid() ]);
            // We Check With Build In Function That Check After Executing The Query If There Is Any Result.
            $rows = $statement->rowCount();
            self::disconnect();
            // We Check If There Any Result If Yes Return True.
            if ($rows > 0)
            {
                return true;
            }
            // We Check If There Any Result If NO Return False.
            else return false;

        }

        //? A Function That Check If UserName Is Already Exists In The DATABASE.
        public function UidExistsAdmin(User $user)
        {

            self::connect();
            // SQL Query That We Send To Our SQL DATABASE
            $sql = "SELECT * FROM admins WHERE adminUid =:adminUid";
            // Preparing The Query With A Connection To The Date
            $statement = self::$connection->prepare($sql);
            // Executing The Query
            $statement->execute([":adminUid" => $user->getUid() ]);
            // We Check With Build In Function That Check After Executing The Query If There Is Any Result.
            $rows = $statement->rowCount();
            self::disconnect();
            // We Check If There Any Result If Yes Return True.
            if ($rows > 0)
            {
                return true;
            }
            // We Check If There Any Result If NO Return False.
            else return false;

        }

        //? A Function That Allow Us To LogIn If The Information That We Send In Are TRUE*.
        public function login(User $user)
        {
            // connect.
            self::connect();
            $username = $user->getUid();
            // SQL Query That We Send To Our SQL DATABASE That Select The User Name That We Write In The Input.
            $sql = "SELECT * FROM users
             WHERE  usersUid='$username' LIMIT 1";
            // We Make A Connection To THE SQL DATABASE AND Executing The Query With A Buildin Function Called (" Query ").
            $statement = self::$connection->query($sql);
            // We Check If The User Is Found And If Found We Check The PASSWORD Below.
            if ($count = $statement->rowCount() > 0)
            {
                self::connect();
                // SQL Query That We Send To Our SQL DATABASE That Select The PASSWORD To That UserName  We Write In The Input.
                $sql_2 = "SELECT usersPwd FROM users WHERE  usersUid='$username' LIMIT 1";
                $statement_2 = self::$connection->query($sql_2);
                $result = $statement_2->fetch($count);
                // After Fetching The Sql DATABASE For The PASSWORD We Identify At As A New Variable(" $_password ").
                $_password = $result['usersPwd'];
                //getPwd We Get The PASSWORD That We Write In The Input With The ( User Class ).
                $pwd = $user->getPwd();
                // We Check The 2 PASSWORD The Password That We Writed it And The Password In The DataBase If They Are Equal.
                if ($pwd == $_password)
                {
                    //! If Yes He Will Succes To Login And Starting A SESSION So We Can Use It To Change The Website Stucter If He Logged In.
                    session_start();
                    $_SESSION['RegularUser'] = $username;
                    return 'User Success';

                }
                else
                {
                    //! If The Password Are Not Equal Then He Cant Log In And He Will Failed!!!.
                    return 'User invalid password';

                }
            }
            //? If NONE Of Those Returned Something Then We Check In The ADMIN Table If This User Who Want To Sign In Is An Admin.
            else
            {
                // connect.
                self::connect();
                $username = $user->getUid();
                // SQL Query That We Send To Our SQL DATABASE That Select The INFORMATION Where The UserUId That We Write In The Input.
                $sql = "SELECT * FROM admins WHERE  adminUid=:adminName LIMIT 1";
                // Preparing The Query With A Connection To The Date
                $statement = self::$connection->prepare($sql);
                // Executing The Query
                $statement->execute(array(
                    ':adminName' => $username
                ));
                // We Check If The User Is Found And If Found We Check The PASSWORD Below.
                $count = $statement->rowCount();
                self::disconnect();
                if ($count > 0)
                {
                    self::connect();
                    $pwd = $user->getPwd();
                    // SQL Query That We Send To Our SQL DATABASE That Select The INFORMATION Where The AdminUId That We Write In The Input.
                    $sql_2 = "SELECT adminPwd FROM admins WHERE  adminUid=:adminName LIMIT 1";
                    // Preparing The Query With A Connection To The Date
                    $statement_2 = self::$connection->prepare($sql_2);
                    $statement_2->execute([':adminName' => $username]);
                    $result = $statement_2->fetchColumn();
                    //$result = substr(0, 60, $result);
                    if ($pwd == $result)
                    {
                        // If The User Is Admin Then we start The Session
                        if ($username == 'Admin' || $username = 'Admin2')
                        {
                            session_start();
                            $_SESSION["UserAdmin"] = $username;

                        }
                        // If The Password Is True We Return Admin Success
                        return 'Admin Success';

                    }
                    else
                    {
                        // If The Password Is FALSE We Return Admin invalid password
                        return 'Admin invalid password';

                    }
                }
                else
                // If The Admin User Was Not Found In The SQL DATABASE We Return invalid email
                return 'invalid email';

            }
        }

        public function UpdteUser(User $user)
        {
            self::connect();
            session_start();
            $pwd = $user->getPwd();
            $hash = password_hash($pwd, PASSWORD_DEFAULT);
            $user->setPwd($hash);
            $sql = "UPDATE `users` SET
                usersName = ':userName',
                usersEmail = ':userEmail',
                usersUid = ':userUid',
                usersPwd = ':userPwd'
                WHERE  `users`.`usersUid` = $_SESSION[userid]";
            $statement = self::$connection->prepare($sql);
            $result = $statement->execute([":userName" => $user->getUserName() , ":userEmail" => $user->getEmail() , ":userUid" => $user->getUid() , ":userPwd" => $user->getPwd() ]);
            self::disconnect();
            if ($result)
            {
                return '';
            }
            else
            {
                return 'Update Failed';
            }
        }
        //? This Function WILL Put All The Rows Selected From The Requst Table In Array!.
        public function showAllUsers()
        {
            self::connect();
            //Sql Query Will Select Everthing From Requset table
            $sql = "SELECT * FROM requests";
            // Execute The query
            $result = self::$connection->query($sql);
            while ($row = $result->fetchAll())
            {
                $data[] = $row;
                return $data[0];

            }
            self::disconnect();
        }
        //? This Function Will Accept The Acount Requst
        public function AcceptRequest(User $user)
        {
            self::connect();
            $db = new dbClass();
            $uid = $user->getUid();
            //Sql Query Will Select Everthing From Requset table Where USERNAME = Our USERNAME
            $sql = "SELECT * FROM requests WHERE requests_Uid = '$uid';";
            // Execute The query
            $result = self::$connection->query($sql);
            self::disconnect();
            if (count($result->fetchAll()) > 0)
            {
                self::connect();
                //Define The New Variables With Our Request DATA
                $RequestName = $user->getUserName();
                $RequestEmail = $user->getEmail();
                $RequestUid = $user->getUid();
                $RequestPwd = $user->getPwd();
                $sql = "INSERT INTO `users` (`usersName`, `usersEmail`, `usersUid`, `usersPwd`)
                     VALUES ('$RequestName', ' $RequestEmail', '$RequestUid', ' $RequestPwd')";
                $result = self::$connection->query($sql);
                self::disconnect();

                if ($result)
                {
                    self::connect();
                    $sql2 = "DELETE FROM `requests` WHERE `requests`.`requests_Uid` = '$uid'";
                    $result = self::$connection->query($sql2);
                    return $result;
                    self::disconnect();
                }

            }

        }
        //? This Function Will Reject The Requst
        public function RejectRequest(User $user)
        {
            self::connect();
            $username = $user->getUid();
            //SQL Query
            $sql = "DELETE FROM `requests` WHERE `requests`.`requests_Uid` = '$username'";
            $result = self::$connection->query($sql);
            //Retrun Result
            return $result;
        }



    }

?>
