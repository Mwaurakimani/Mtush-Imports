<?php
/**
 * Administartor
 */
trait fileCrud
{
    public function Create_file($data,$table)
    {
        $data = json_decode($data);
        $conn = $this->getConnection();


        $stmt = $conn->prepare("INSERT INTO $table (UUID) VALUES (?)");
        $bind = $stmt->bind_param("s", $data->UUID);
        $stmt->execute();
        $stmt->close();

        foreach ($data as $k => $v) {
            if ($v) {
                $stmt = $conn->prepare("UPDATE $table SET $k=? WHERE UUID=?");
                $stmt->bind_param('ss', $v, $data->UUID);
                $stmt->execute();
                $stmt->close();
            }
        }

        return $data->path_from_root;
    }

    public function Read_file()
    {
        echo "File Handler initiated";
    }

    public function Update_file()
    {
        echo "File Handler initiated";
    }

    public function Delete_file()
    {
        echo "File Handler initiated";
    }
    
    public function Create_ref($data,$table)
    {
        $data = json_decode($data);
        $conn = $this->getConnection();


        $stmt = $conn->prepare("INSERT INTO $table (UUID) VALUES (?)");
        $bind = $stmt->bind_param("s", $data->UUID);
        $stmt->execute();
        $stmt->close();

        foreach ($data as $k => $v) {
            if ($v) {
                $stmt = $conn->prepare("UPDATE $table SET $k=? WHERE UUID=?");
                $stmt->bind_param('ss', $v, $data->UUID);
                $stmt->execute();
                $stmt->close();
            }
        }

        return $data->path_from_root;
    }

}
