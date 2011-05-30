<?php

App::Import('Core','File');
App::Import('Core','Zip');
App::Import('Core','Xml');
App::Import('Core','Inflector');

class ParseController extends AppController {

	var $name = 'Parse';
	
	var $uses = array('Channel');
	
	function index() {
		debug($this->params);
		echo "asdasdad";
		$mode = $this->params['named']['mode'];
		$url = base64_decode($this->params['named']['url']);
		switch ($mode) {
			case "xmltv" :
				echo "<h1>Modo XMLTV</h1>";
				//$this->data['Channel']['acronym'] = 'XXX';
				//$this->data['Channel']['name'] = 'XtestX';
				//$this->data['Channel']['locale'] = 'en';
				//$this->Channel->create();
				//$this->Channel->save($this->data);exit;
				//ini_set("memory_limit","512M");
				set_time_limit(0);
				//$xml = new Xml(WWW_ROOT . '/tmp/xmltv_rj.xml');
				$xmltv = new domDocument;
				@$xmltv->loadXML(file_get_contents(WWW_ROOT . '/tmp/xmltv_rj.xml'));
				$xmltv->preserveWhiteSpace = false;
				$channels = $xmltv->getElementsByTagName('channel');
				foreach ($channels as $channel) {
					$channelAcronym = strtoupper(mb_convert_encoding($channel->getAttribute('id'),'auto', 'UTF-8'));
					$channelCount = $this->Channel->find('count',array('conditions'=>array('Channel.acronym'=>$channelId)));
					if ($channelCount<=0) {
						//$this->data['Channel']['acronym'] = $channelId;
						$displayNames = $channel->getElementsByTagName("display-name");
						foreach ($displayNames as $displayName) {
							$channelName = Inflector::humanize(mb_convert_encoding($displayName->nodeValue, 'auto', 'UTF-8'));
							$channelLocale = strtolower(mb_convert_encoding($displayName->getAttribute('lang'),'auto', 'UTF-8'));
							//if (isset($this->data)) {
								$this->data['Channel']['acronym'] = $channelAcronym;
								$this->data['Channel']['name'] = $channelName;
								$this->data['Channel']['locale'] = $channelLocale;
								$this->Channel->locale = $channelLocale;
								$this->Channel->create($this->data);
								$this->Channel->save($this->data);
								//$channelId = $this->Channel->id;
							//} else {
							//	$this->Channel->locale = $channelLocale;
							//	$this->data['Channel']['acronym'] = $channelAcronym;
							//	$this->data['Channel']['name'] = $channelName;
							//	$this->data['Channel']['locale'] = $channelLocale;
							//	$this->Channel->create($this->data);
							//	$this->Channel->save($this->data);
							//}
							//$this->data = array();
							//$this->data['Channel']['name'] = Inflector::humanize(mb_convert_encoding($displayName->nodeValue, 'auto', 'UTF-8'));
							//$this->Channel->locale = strtolower(mb_convert_encoding($displayName->getAttribute('lang')));
						}	
					} else {
					}
					$displayNames = $channel->getElementsByTagName("display-name");
					foreach ($displayNames as $displayName) {
						echo $displayName->nodeValue.'&ndsp;';
						echo $displayName->getAttribute('lang').'<br />';
					}
				}
				exit;
				$programmes = $xmltv->getElementsByTagName('programme');
				foreach ($programmes as $programme) {
					$titles = $programme->getElementsByTagName('title');
					foreach ($titles as $title) {
						echo $title->nodeValue.'<br />';
					}
					echo $programme->getAttribute('channel').' ';
					echo $programme->getAttribute('start').' ';
					if (($timestamp = strtotime($programme->getAttribute('start'))) === false) {
						echo "The string ($programme->getAttribute('start')) is bogus";
					} else {
						echo " = " . date('l dS \o\f F Y h:i:s A', $timestamp);
					};
					echo "<br />";
					echo $programme->getAttribute('stop').' ';
				}
				//debug($xml->toArray());
				//echo base64_encode('http://www.revistaeletronica.com.br/xmltv/net/xmltv_rj.zip');
				//$content = file_get_contents($url);
				//$file = new File(WWW_ROOT . '/tmp/tmpxmltvfile.zip', true , 777);
				//$file->write($content);
				//$file->close();
				//$zipFile = new Zip();
				//debug($zipFile->hasErrors());
				//if(!$zipFile->hasErrors())
				//{
				//	$zipFile->extract(WWW_ROOT . '/tmp/tmpxmltvfile.zip'); // Se não passar parâmetro, extrai pro mesmo diretório
				//}
				
				break;
		}
		exit;
	}
	
}
?>