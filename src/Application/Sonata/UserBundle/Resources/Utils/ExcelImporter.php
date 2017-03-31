<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Sonata\UserBundle\Resources\Utils;

use PHPExcel;

/**
 * Description of ImportarMedicos
 *
 * @author leonardo
 */
class ExcelImporter
{
    protected $doctrine;
    protected $filePath;
    protected $mapData;
    protected $dataStructure;
    protected $objPHPExcel;
    protected $entity;
    protected $onObjInit;
    protected $persist;
    protected $prePersist;
    protected $postPersist;
    protected $procesados;
    protected $session;
    protected $numeroRows;
    protected $outputArray;
    protected $mapAsObject;
    protected $sender;

    public function __construct($doctrine, $filePath, $mapData, $mapAsObject = true, $entity, $persist = true, $onObjInit = null, $prePersist = null, $postPersist = null, $session = null, $sender = null)
    {
        $this->doctrine    = $doctrine;
        $this->filePath    = $filePath;
        $this->mapData     = $mapData;
        $this->entity      = $entity;
        $this->onObjInit   = $onObjInit;
        $this->persist     = $persist;
        $this->prePersist  = $prePersist;
        $this->postPersist = $postPersist;
        $this->procesados  = 0;
        $this->numeroRows  = 0;
        $this->session     = $session;
        $this->outputArray = array();
        $this->mapAsObject = $mapAsObject;
        $this->sender      = $sender;
    }
    
    public function loadExcelObject()
    {
        try {
            $inputFileType     = \PHPExcel_IOFactory::identify($this->filePath);
            $objReader         = \PHPExcel_IOFactory::createReader($inputFileType);
            $this->objPHPExcel = $objReader->load($this->filePath);
        } catch (Exception $exc) {
            return false;
        }
        return true;
    }
    
    /**
     * Inicia con el proceso para parsear el excel y mapearlo a la entidad 
     * referenciada en el constructor.
     * 
     * @return int|boolean True si el proceso finaliza exitosamente, o alguno de los 
     * siguientes codigos de error: ver metodo getHumanErrorMessage($code), para 
     * ver la definicion de los codigos de error.
     * 
     */
    public function procesarExcel()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        
        if(!$this->loadExcelObject())
            return '0001';

        $sheet            = $this->objPHPExcel->getSheet(0);
        $highestRow       = $sheet->getHighestRow();
        $highestColumn    = $sheet->getHighestColumn();
        $isHeader         = true;
        $structure        = array();
        $this->numeroRows = $highestRow;
        
        for ($row = 1; $row <= $highestRow; $row++)
        {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            
            if($this->checkIfRowIsNull($rowData[0]))
                continue;
            
            if($isHeader)
            {
                $structure = $rowData[0];
                $isHeader  = false;
                if(!$this->checkStructure($structure))
                    return '0002';
                continue;
            }
            
            $result = $this->mapAsObject ? $this->mapAsObject($rowData[0]) : $this->mapAsArray($rowData[0]);
            
            if($result !== true)
                return $result;
            
            $this->actualizarEstado();
        }
        
        return true;
    }
    
    private function mapAsArray($rowData)
    {
        $row = $this->mapRowData($rowData);
        
        if (!is_null($this->onObjInit))
        {
            $callback = $this->onObjInit;
            $callback($row, $this->sender);
        }
        
        $this->outputArray[] = $row;
        $this->procesados ++;
        
        return true;
    }
    
    private function mapAsObject($rowData)
    {
        if (!$object = $this->generateObject($this->mapRowData($rowData)))
            return '0003';

        if ($this->persistObject($object))
            $this->procesados ++;
        
        return true;
    }

    public function checkStructure($structure = array())
    {
        if(empty($structure) || !is_array($structure))
                return false;
            
        $this->dataStructure = $structure;
        
        foreach ($this->mapData as $key => $value)
        {
            if(!in_array($value, $this->dataStructure))
                return false;
        }
        
        return true;
    }
    
    public function checkIfRowIsNull($rowData)
    {
        if(!is_array($rowData))
            return true;
        foreach ($rowData as $key => $value)
        {
            if(!is_null($value))
                return false;
        }
        
        return true;
    }
    
    private function mapRowData($rowData)
    {
        $tmpRow = array();
        
        foreach ($this->dataStructure as $key => $value)
        {
            $tmpRow[$value] = $rowData[$key];
        }
        
        if (count($this->mapData) > 0)
        {
            $newRowData = array();
            foreach ($this->mapData as $key => $value)
            {
                $newRowData[$value] = $tmpRow[$value];
            }
            unset($tmpRow);
            
            return $newRowData;
        }

        return $tmpRow;
    }

    protected function generateObject($rowData)
    {
        if(empty($rowData) || !is_array($rowData))
            return false;
        
        $object = new $this->entity();
        
        foreach ($rowData as $key => $value)
        {
            $setMethod = $this->setMethod($key);
            
            if(!method_exists($object, $setMethod))
                return false;
            
            $object->$setMethod($value);
        }
        
        if (!is_null($this->onObjInit))
        {
            $callback = $this->onObjInit;
            $callback($object, $this->sender);
        }

        return $object;
    }
    
    public function setMethod($attr)
    {
        return 'set' . $this->to_camel_case($attr);
    }
    
    private function to_camel_case($str, $capitalise_first_char = true)
    {
        if ($capitalise_first_char)
        {
            $str[0] = strtoupper($str[0]);
        }
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-z])/', $func, $str);
    }
    
    private function persistObject($object)
    {
        if(!$this->persist)
            return true;
        
        if (!is_null($this->prePersist))
        {
            $prePersist = $this->prePersist;
            if (!$prePersist($object, $this->sender))
                return true;
        }

        $em = $this->doctrine->getManager();
        try {
            $em->persist($object);
            $em->flush();
        } catch (Exception $exc) {
            return false;
        }
        
        if (!is_null($this->postPersist))
        {
            $postPersist = $this->postPersist;
            $postPersist($object, $this->sender);
        }

        return true;
    }
    
    public function getOutputArray()
    {
        return $this->outputArray;
    }
    
    public function getNumeroRows()
    {
        return $this->numeroRows - 1;
    }
    
    public function getItemsProcesados()
    {
        return $this->procesados;
    }

    private function actualizarEstado()
    {
        if(is_null($this->session))
            return;
        
        $this->session->set('excel_items_procesados', $this->getItemsProcesados());
        $this->session->set('excel_numero_rows', $this->getNumeroRows());
    }

    public function getHumanErrorMessage($errorCode)
    {
        $errors = array('0001' => 'Ocurrio un error al cargar el archivo de excel. El archivo podria estar corrupto o no es un archivo xls o xlsx valido.',
                        '0002' => 'El archivo no cuenta con una estrutura correcta para realizar su mapeo. Por favor verifique la estrutura de filas y columnas del archivo. Esta es la estructura que se logro identificar: ' . implode('|', $this->dataStructure) ,
                        '0003' => 'Error al mapear el archivo. Es posible que no exista alguno de los atributos que se estan identificando en el excel. Esta es la estructura que se logro identificar: ' . implode(' | ', $this->dataStructure),
                       );
        
        return $errors[$errorCode];
    }
}
