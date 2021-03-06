<?php 
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
/*
$t = new Tag();
$t->getAndSetTagsByUsuario(6);
$t->addTag("Hola");
$t->addTag("Adios");
var_dump($t);
*/
class Tag {
	private $tagCol = array();
	private $maxTagId;
	private $toDelete = array();
	
	public function __construct() { 
		$this->tagCol = array();
		$this->maxTagId = null;
		$this->toDelete = array();
	}
	
	public function getAndSetTagsByUsuario($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT t.id as id, t.tag as tag FROM tag t 
						INNER JOIN usuarioTag ut on (t.id=ut.tag_id)
						WHERE ut.CodUsuario = ".$id." order by t.tag ASC;";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$this->maxTagId = 0;
			$this->clearTags();
			while ($result) {
				$index = $result['id'];
				if ($index > $this->maxTagId) {
					$this->maxTagId = $index; 
				}
				$this->addTagById($index,$result['tag']);
				$result = $conex->fetch_assoc();
			}
		}
		
	}
	public function getTagsByUsuario($id) {
		$temp = new Tag();
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT t.id as id, t.tag as tag FROM tag t
						INNER JOIN usuarioTag ut on (t.id=ut.tag_id)
						WHERE ut.CodUsuario = ".$id." order by t.tag ASC;";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$temp->maxTagId = 0;
			$temp->clearTags();
			while ($result) {
				
				$index = $result['id'];
				if ($index > $temp->getMaxId()) {
					$temp->setMaxId($index); 
				}
				$temp->addTagById($index,$result['tag']);
				$result = $conex->fetch_assoc();
			}
		}
	
	}
	public function tagColections() {
		$conex = new MySQL();
		//having (cant > 1)
		$consulta = "SELECT count(*) as cant, tag FROM Tag group by tag  order by tag asc LIMIT 100";
		$result1 = $conex->consulta($consulta);
		$result = $conex->fetch_assoc();
		$return = array();
		while ($result) {
			$return[] = $result['tag'];
			$result = $conex->fetch_assoc();
		}
		return $return;
	}
	public function saveTags($Pid) {

		//Elimino
		$f = 0;
		$idstoDelete = "";
		foreach ($this->toDelete as $key => $val) {
			if ($f > 0) { $idstoDelete .= ","; }
			$idstoDelete .= $key;
			$f++;
		} 
		$conex = new MySQL();
		if ($f >0) {
			$consulta = "DELETE FROM usuarioTag WHERE tag_id in (".$idstoDelete.") AND CodUsuario = ".$Pid.";";	
			$conex->consulta($consulta);
			$consulta = "DELETE FROM tag WHERE id in (".$idstoDelete.");";
			$conex->consulta($consulta);
			unset($this->toDelete);
			$this->toDelete = array();
		}
		//Agrego
		$values = "";
		$tempMaxId = "";
		foreach ($this->getTags() as $key => $val) {
			if ($key > $this->maxTagId || $key == '0') {
				$values = "(null,'".$conex->escape($val)."')";
				$consulta = "INSERT INTO tag (id,tag) values ".$values.";";
				$conex->consulta($consulta);
				$lastId = $conex->last_id();
				$consulta = "INSERT INTO usuarioTag (id,tag_id,CodUsuario) VALUES (null,".$lastId.",".$Pid.")";
				$conex->consulta($consulta);
			}
		}
		$this->getAndSetTagsByUsuario($Pid);
		
	}		
	public function getTags() {
		return $this->tagCol;
	}
	public function setTags($tags) {
		if ($tags) {
			$this->tagCol = $tags;
		}
		else {
			//LOGERROR
		}
	}
	public function clearTags() {
		unset($this->tagCol);
		$this->tagCol = array();
	}
	public function addTag($tag) {
		if ($tag != "" && $tag != null) {
			if (!array_search($tag,$this->tagCol)) {
				$this->tagCol[] = $tag;
			}
		}
		else {
			//LOGERROR
		}
	}
	public function addTagById($id,$tag) {
		if ($tag AND $id) {
			$this->tagCol[$id] = $tag;
		}
		else {
			//LOGERROR
		}
	}
	public function getIDByValue($tag) {
		if ($tag) {
			return array_search($tag, $this->tagCol);
		}
		else {
			//LOGERROR
		}
	}
	public function deleteTag($tag) {
		if ($tag) {
			$key = $this->getIDByValue($tag);
			if ($key <= $this->maxTagId) {
				$this->toDelete[$key] = $tag;
			}
			unset($this->tagCol[$key]);
			
		}
		else {
			//LOGERROR
		}
	}
	public function setMaxId($a) {
		$this->maxTagId = $a;
	}
	public function getMaxId($a) {
		return $this->maxTagId;
	}


}


?>