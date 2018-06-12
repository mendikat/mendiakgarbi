<?php

namespace AmfFam\MendiakGarbi\DAO;

/** Required Models */
use AmfFam\MendiakGarbi\Model\Hist      as Hist;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\AbstractDAO as AbstractDAO;

/**
 *  The class HistDAO
 * 
 *  @author Javier Urrutia
 */
class HistDAO extends AbstractDAO {

    /** 
     *  The table constant
     */
    const TABLE  = 'mg_hist';
    
    /** 
     *  The entity class constant 
     */
    const ENTITY = 'AmfFam\MendiakGarbi\Model\Hist';

    /**
     * The Constructor
     */
    public function __construct() {
        
        parent::__construct( self::TABLE, self::ENTITY);
  
    }

   /**
     * Get a SQL result object and get an event
     * 
     * @param  object $result                           A SQL result object
     * 
     * @return \AmfFma\MendiakGarbi\Model\Hist         An historial entry        
     */
    private static function asHist( $result) {

        $hist = new Hist( [
            'id'             => $result->id,
            'event'          => $result->event,
            'status'         => $result->status,
            'date'           => new \DateTime( $result->date),
            'text'           => $result->text
        ]);

        return $hist;

    }

    /**
     * Find historial by id
     * 
     * @param int      $id                          The id
     * 
     * @return \AmfFma\MendiakGarbi\Model\Hist      The hsitory entry          
     */
    public function findById( int $id) {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.$this->get_table().' where id= :id';

        $results= $pdo->fetch( $sql, [ ':id' => $id]);
    
        $hist= [];

        foreach( $results as $result)
            $hist[]= self::asHist( $result);

        return $hist;
    }
   
    /**
     * Find historial by event
     * 
     * @param   int    $id                            The event id
     * @param   bool   $array_format                  true if returns an array
     * @return  array                                 An array with event historial
     */
    public function findByEvent( int $id, bool $array_format = false ) {

        $pdo= $this->get_pdo();

        if ( !$array_format)
            $sql= 'select * from '.$this->get_table().' where event= :id';      
        else
            $sql= 'select mg_hist.date, mg_status.progress, concat( mg_status.nameES, " ", mg_status.progress, "%" ) as status, mg_hist.text from mg_hist inner join mg_status on mg_hist.status = mg_status.id where event= :id order by mg_hist.id desc';

        $results= $pdo->fetch( $sql, [ ':id' => $id]);
    
        $hist= [];

        if ( !$array_format) {
            foreach( $results as $result)
                $hist[]= self::asHist( $result);        
        } else {
            foreach( $results as $result) {
                $hist[] = [
                    'date'     => (new \DateTime( $result->date))->format( DATE_FORMAT),
                    'progress' => $result->progress,
                    'status'   => $result->status,
                    'text'     => $result->text
                ];
            }
        }

        return $hist;
    
    }

    /**
     * Change the text
     * in the last entry of historial
     * 
     * @param string    $text                       The text
     * 
     * @return void
     */
    public function update_text( string $text) {

        $pdo= $this->get_pdo();

        $sql= 'update '.$this->get_table(). ' set text=:text order by id desc limit 1'; 
        
        $pdo->execute( $sql, [ 
            ':text'   => $text
        ]);

    }

    /**
     * Save an historial entry for the event
     * 
     * @param  AmfFam\MendiakGarbi\Model\Hist         An historial entry
     * 
     * @return int                                    The id
     */
    public function save( Hist $hist) {

        $pdo= $this->get_pdo();

        $sql = 'insert into '. $this->get_table() . '(event,status,date,text) values(:event,:status,now(),:text)';
    
        return $pdo->execute( $sql, [ 
            ':event'  => $hist->get_event(), 
            ':status' => $hist->get_status(), 
            ':text'   => $hist->get_text()
        ]);

    }

}

?>