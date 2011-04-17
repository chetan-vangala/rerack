<?php

class Model{
  
  private $table;
  
  private $fields = array();
  
  private $non_update_fields = array('id');
  
  public function __construct($details = false){
    $this->db = Database::get();
  	$this->activate = 1;
    $this->setup_properties();
    if($details){
      if(is_array($details)){
        $this->build($details);
      } elseif(is_int($details)) {
        $this->find($details, true);
      }
    }
  }

  
  /**
   * Sets up some defaults for the model such as the table name
   * and the available fields.
   * @access protected
   * @return null
   */
  protected function setup_properties(){
    //Set the table name to the class name if not manually defined
    if(!isset($this->table)){
      $this->table = strtolower(get_class($this) . 's');
    }
    
    $this->id = false; //By default, assume the class is empty
    
    //Figure out all the fields we should be using
    $sql = 'DESCRIBE ' . $this->table;
    $result = $this->db->query($sql);
    foreach($result as $field_info){
      $this->fields[$field_info['Field']] = array('default' => $field_info['Default'], 'type' => $field_info['Type']);
    }
    return true;
  }
  
  /**
   * Build the object based on an array of key-value pairs
   * @param array $properties Array of key-value pairs
   * @access protected
   * @return null
   */
  protected function build($properties){
    foreach($properties as $property => $value){
      $fn = $property.'_decode';
      if(method_exists($this, $fn)){
        $this->$property = $this->$fn($value);
      } else {
        $this->$property = $value;
      }
    }
  }
  
  /**
   * Saves an object.  Dispatches to update or create as needed.
   * before_save is called prior to the create or update call.
   * @access public
   * @return bool
   */
  public function save(){
    //Looks for a before_save show stopper callback
    $fn = 'before_save';
    if(method_exists($this,$fn)){
      if(!$this->$fn()){
        return false;
      }
    }
    if(!isset($this->id) || !$this->id){
      return $this->create();
    } else {
      return $this->update();
    }
  }
  
  /**
   * Creates a new object.  After the object is created,
   * non-set properties for this model are set to the db defaults.
   * before_create and after_create are called if they exist.
   * @access public
   * @return bool
   */
  public function create(){
    //Looks for a before_create show stopper callback
    $fn = 'before_create';
    if(method_exists($this,$fn)){
      if(!$this->$fn()){
        return false;
      }
    }
    $keys = array();
    $values = array();
    $fields = array_diff(array_keys($this->fields), $this->non_update_fields);
    foreach($fields as $field){
      if(isset($this->$field)){
        $keys[] = '`' . $field . '`';
        $fn = $field.'_encode';
        if(method_exists($this, $fn)){
          $value = $this->$fn($this->$field);
        } else {
          $value = $this->$field;
        }
        $values[] = $this->db->quote($value);
      }
    }
    $sql = 'INSERT INTO ' . $this->table . '(' . implode(', ', $keys) . ') VALUES (' . implode(', ', $values) . ')';
    $effected = $this->db->exec($sql);
    //Test if the insert went OK
    if($effected != 1){
	   return false;
    }
    $this->id = $this->db->lastInsertId();
    //Populate fields with defaults
    $fields = array_keys($this->fields);
    foreach($fields as $field){
      if(!isset($this->$field)){
        $fn = $field.'_decode';
        if(method_exists($this, $fn)){
          $this->$field = $this->$fn($this->fields[$field]['default']);
        } else {
          $this->$field = $this->fields[$field]['default'];
        }
      }
    }
    //Looks for an after_create callback.
    $fn = 'after_create';
    if(method_exists($this,$fn)){
      $this->$fn();
    }
    return true;
  }
  
  /**
   * Updates an existing object.
   * before_update and after_update are called if them exist.
   * @access public
   * @return bool
   */
  public function update(){
    //Looks for a before_update show stopper callback
    $fn = 'before_update';
    if(method_exists($this,$fn)){
      if(!$this->$fn()){
        //return false;
      }
    }
    $properties = array();
    $fields = array_diff(array_keys($this->fields), $this->non_update_fields);
    foreach($fields as $field){
      $fn = $field.'_encode';
      if(method_exists($this, $fn)){
        $value = $this->$fn($this->$field);
      } else {
        $value = $this->$field;
      }
      $properties[] = '`' . $field . '` = ' . $this->db->quote($value);
    }
    $sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ',$properties) . ' WHERE id = ' . $this->id;
    $effected = $this->db->exec($sql);
    if($effected === false){
      return false;
    } else {
      //Looks for an after_update callback
      $fn = 'after_update';
      if(method_exists($this,$fn)){
        $this->$fn();
      }
      return true;
    }
  } 
  
  /**
   * Deletes an object.  After the object is deleted,
   * all the properties remain except for the id.
   * before_delete and after_delete are called if them exist.
   * @access public
   * @return bool
   */
  public function delete(){
    if(!isset($this->id) || !$this->id){
      return false;
    }
    //Looks for a before_delete show stopper callback
    $fn = 'before_delete';
    if(method_exists($this,$fn)){
      if(!$this->$fn()){
        return false;
      }
    }
    $sql = 'DELETE FROM ' . $this->table . ' WHERE id = ' . $this->id;
    //echo $sql;
    $effected = $this->db->exec($sql);
    //Test if the insert went OK
    if($effected != 1){
      return false;
    }
    $this->id = false; //So it cannot be updated again, only created.
    //Looks for an after_delete callback
    $fn = 'after_delete';
    if(method_exists($this,$fn)){
      if(!$fn()){
        return false;
      }
    }
    return true;
  }
  
  /**
   * Find an object based on some conditions which can be:
   * an integer [id = #], an array of integers [id IN (...)],
   * an array of key-value pairs or, an array of strings
   * @param mixed $conditions The SQL conditions
   * @param boolean $allow_self If true and 1 result is
   * returned that result will overwrite the current object.
   * @access public
   * @return mixed
   */
  public function find($conditions = array(), $allow_self = false){
    $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->process_conditions($conditions) . ' ORDER BY id';
    //echo $sql;
    $result = $this->db->query($sql);
    $count = count($result);
    if($count==1 && $allow_self){
      $this->build($result[0]);
      return true;
    } elseif($count >= 1 ) {
      $items = array();
      $c = get_class($this);
      foreach($result as $details){
        $items[] = new $c($details);
      }
      return $items;
    }else{
      return false;
    }
  }
  
  public function update_attributes($attributes = array()){
    foreach($attributes as $key => $value){
      if(property_exists($this, $key) || array_key_exists($key, $this->fields)){
        $this->$key = $value;
      }
    }
  }
  
  /**
   * Process an array of query conditions into a SQL string joined by AND.
   * @param mixed $conditions Conditions to be formatted
   * @access private
   * @return string
   */
  private function process_conditions($conditions = array()){
    $prepared = array();
    //The condition is just one thing
    if(is_int($conditions) || is_string($conditions)){
      $prepared[] = $this->process_condition(false, $conditions);
    }elseif(is_array($conditions)){
      $id_array = array();
      foreach($conditions as $key => $value){
        //A lone integer with no value is pulled aside, to be joined with other ID's
        if(is_int($key) && is_int($value)){
          $id_array[] = $value;
        } else {
          $prepared[] = $this->process_condition($key, $value);
        }
      }
      if(count($id_array) >= 1){
        $prepared[] = $this->process_condition('id', $id_array);
      }
    }
    //The empty WHERE syntax is just a 1
    if(count($prepared)<1){
      $prepared[] = 1;
    }
    return implode(' AND ', $prepared);
  }
  
  /**
   * Convert an individual condition into the appropriate SQL string.
   * @param mixed $key Column name, if applicable
   * @param mixed $value Value for the column should have
   * @access private
   * @return string
   */
  private function process_condition($key = false, $value = false){
    //Handle straight up sql [key]
    if(is_int($key) || !$key){
      if(is_int($value)){
        $prepared = 'id = ' . $value;
      }else{
        $prepared = $value;
      }
    //Handle an array of acceptable value [key IN (values)]
    } elseif(is_array($value)){
      $values = array();
      foreach($value as $val){
        //$values[] = $this->db->quote($val);
      }
      $prepared = $key . ' IN (' . implode(',', $values) . ')';
    //Handle an integer value [key = value]
    }elseif(is_int($value) || is_string($value) || is_null($value)){
      $prepared = $key . ' = ' . $this->db->quote($value);
    }
    return $prepared;
  }
}

?>
