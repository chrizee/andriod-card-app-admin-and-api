<?php
	class Action {

		//method to get data from non static classes like drivers etc
		public function get($where =  array('1', '=', '1'), $fields = '*') {
			if(!$data = DB::getInstance()->get($this->_table, $where, $fields)) {
				throw new Exception("There was a problem getting data");
			}
			return $data->results();
		}

		//method to create record in non static classes like drivers etc
		public function create($fields = array()) {
			if(!DB::getInstance()->insert($this->_table, $fields)) {
				throw new Exception("There was a problem creating an account");
			}
		}

		public function update($id, $fields = array()) {
			if(!DB::getInstance()->update($this->_table, $id, $fields)) {
				throw new Exception("Error updating data");
			}
		}

		public function delete($where = array()) {
			if(!DB::getInstance()->delete($this->_table, $where)) {
				throw new Exception("Error deleting data");
			}
		}

		public function lastId() {
			if(!$lastId = DB::getInstance()->lastInsertId($this->_table)) {
				throw new Exception("Error getting last Id");
			}
			return $lastId;
		}

        public function save($pic, $table) {
            if($table) {
                $name = uniqid(). ".jpg";
                $path = "img/".$table."/";
                if($dir = opendir($path)) {			//checks if the dir exist by opening it
                    closedir($dir);			//if the dir exist ie opens successfully,close it
                } else {
                    $dir = "img/".$table;
                    mkdir($dir);				//if the dir doesn't exist create it inside the pic folder
                }
                $filename = $path.$name;
                if(move_uploaded_file($_FILES[$pic]['tmp_name'], $filename)){
                    return $filename;
                }
            }
            return false;
        }

		//returns the time part of the date in a precise format
		public function date($date) {
			$init = new dateTime($date);
			$now = new dateTime();
			$diff = $now->diff($init);
			if($diff->y != 0 ) {
				return $diff->format("%y Year(s) %m month(s) %d day(s)");
			} elseif($diff->m != 0) {
				return $diff->format("%m month(s) %d day(s)");
			} elseif($diff->d != 0) {
				return $diff->format("%d day(s)");
			} elseif($diff->h != 0) {
				return $diff->format("%h hour(s)");
			} elseif($diff->i != 0) {
				return $diff->format("%i min(s)");
			} elseif($diff->s != 0) {
				return $diff->format("%s sec(s)");
			} elseif($diff->s == 0) {
				return "now";
			}
		}
	}
