class db {
    
    protected static $connect = null;

    static function getConnect(){
        if(self::connect == null){
            require($_SERVER['DOCUMENT_ROOT'] . '/libs/DbSimple/Generic.php');
            self::$connect = DbSimple_Generic::connect("mysql://" . sql_user . ":" . sql_pass . "@" . sql_host . "/" . sql_table);
            if(!self::$connect){
                die("��� ����������� � ��");
            }
            self::$connect->query("SET NAMES UTF8");
        }
        return self::$connect;
    }
    
    //������ ������� query
    static function query() {
        $res = call_user_func_array(array(self::getConnect(), 'query'), func_get_args());
        return $res;
    }
    //������ ������� select 
    static function select() {
        $res = call_user_func_array(array(self::getConnect(), 'select'), func_get_args());
        return $res;
    }
    //�� ��������� ������ ������ � ����������
    static function __callStatic($name, $arguments) {
        if(method_exists(self, $name)){
            return call_user_func_array(array(self, $name), $arguments);
        }else{
            return call_user_func_array(array(self::getConnect(), $name), func_get_args());
        }
    }
    
}