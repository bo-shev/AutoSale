    <?
    
include_once 'siteParts/siteHeader.php';
    echo '<div class="contentSearchPage " style=" height:120vh"> ';

    // echo' <div style="display: block;
    // text-align: center;">';
    include_once 'auctionSearch.php';


    
    //echo $_POST['auctiontype'];
        $date = new DateTime();
        switch ($_POST['auctiontype'])
        {
            case 'all':
                $sql = "SELECT * FROM `auction_lot`";
                break;
            
            case 'current':
                $sql = "SELECT * FROM `auction_lot` WHERE auction_lot.time_end > ".strtotime( $date->format('F j, Y, H:i:s'))."";
                   
                break;
            case 'gone':
                $sql = "SELECT * FROM `auction_lot` WHERE auction_lot.time_end < ".strtotime( $date->format('F j, Y, H:i:s'))."";
                break;
                   
        }
        //echo '<br>'.$sql;
        include_once 'conect.php';
        $dbh = conectDb('car');

        include_once 'auctionCarPreview.php';
        //echo '<table>';
        foreach($dbh->query($sql) as $row)
        {
            
            previewAuctionCar($row['fid_car']);
           //echo ' <tr><td>'.previewAuctionCar($row['fid_car']).'</td></tr>';
         
             
           
            
        }
       // echo '</table>' ;



    
    ?></div>
   