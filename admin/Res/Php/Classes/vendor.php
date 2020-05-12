<?php
/*
 * Products parent class
 */

trait vendor
{
    public function update_vendor($UserData, $conn, $vendorname)
    {
        // decode json assign it to data
        $data = json_decode($UserData);

        if(!empty($vendorname)){

            foreach ($data as $k => $v) {
                if ($v) {
                    $stmt = $conn->prepare("UPDATE tbl_vendor SET $k=? WHERE UUID=?");
                    $stmt->bind_param('ss', $v, $vendorname);
                    $stmt->execute();
                    $stmt->close();
                }
            }


            return $this->getitemsbyref($vendorname, "tbl_vendor", "UUID", $conn);
        }else{
            $ID = $this->generateUUID();

            //pass the ID
            $stmt = $conn->prepare("INSERT INTO tbl_vendor (UUID) VALUES (?)");
            $bind = $stmt->bind_param("s", $ID);
            $stmt->execute();
            $stmt->close();

            foreach ($data as $k => $v) {
                if ($v) {
                    $stmt = $conn->prepare("UPDATE tbl_vendor SET $k=? WHERE UUID=?");
                    $stmt->bind_param('ss', $v, $ID);
                    $stmt->execute();
                    $stmt->close();
                }
            }


            return $this->getitemsbyref($ID, "tbl_vendor", "UUID", $conn);

        }


    }
}
