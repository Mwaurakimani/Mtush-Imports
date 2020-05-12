<?php
// header('Content-Type: application/json');
include_once '../Php/modal.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

    if ($action == "add_product") {
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : "";

        $conn = $moderator->getConnection();

        $product = new product();


        if(!empty($data)){

            //decode
            $data = json_decode($data);

            //assign
            $name = $data->name;
            $short_description = $data->short_description;
            $product_type = $data->product_type;
            $Regular_price = $data->Details->general->Regular_price;
            $Sale_price = $data->Details->general->Sale_price;
            $start_data = $data->Details->general->start_data;
            $end_date = $data->Details->general->end_date;
            $SKU = $data->Details->inventory->SKU;
            $id = $data->Details->inventory->id;
            $vendor = $data->Details->inventory->vendor;
            $Stock_Quantity = $data->Details->inventory->Stock_Quantity;
            $Low_stock_threshhold = $data->Details->inventory->Low_stock_threshhold;
            $Sold_alone = $data->Details->inventory->Sold_alone;
            $long_description = $data->long_description;
            $status = $data->Settings->status;
            $Visibility = $data->Settings->Visibility;
            $Editable = $data->Settings->Editable;
            
            
            


            //validate for html
            $product_type = encodeToHTML($product_type);
            $name = encodeToHTML($name);
            $Regular_price = encodeToHTML($Regular_price);
            $Sale_price = encodeToHTML($Sale_price);
            $start_data = encodeToHTML($start_data);
            $end_date = encodeToHTML($end_date);
            $SKU = encodeToHTML($SKU);
            $Stock_Quantity = encodeToHTML($Stock_Quantity);
            $Low_stock_threshhold = encodeToHTML($Low_stock_threshhold);
            $Sold_alone = encodeToHTML($Sold_alone);
            $status = encodeToHTML($status);
            $Visibility = encodeToHTML($Visibility);
            $Editable = encodeToHTML($Editable);


            //bind data for transfer
            $product_data = array(
                'name' => $name,
                'short_description' => $short_description,
                'long_description' => $long_description,
                'product_type' => $product_type,
                'Regular_price' => $Regular_price,
                'Sale_price' => $Sale_price,
                'start_data' => $start_data,
                'end_date' => $end_date,
                'SKU' => $SKU,
                'Stock_Quantity' => $Stock_Quantity,
                'Low_stock_threshhold' => $Low_stock_threshhold,
                'Sold_alone' => $Sold_alone,
                'status' => $status,
                'Visibility' => $Visibility,
                'Editable' => $Editable,
                'vendor' => $vendor
            );


            //encode to json
            $product_data = json_encode($product_data);


            

            if(isset($_SESSION['CURRENT_PRODUCT'])){
                //if its not a new entry
                $reg = $product->update_add($product_data, $conn);

                if ($reg[0]) {
                    $_SESSION['CURRENT_PRODUCT'] = $reg[1][0]['UUID'];
                    $id = $moderator->getitemsbyref($_SESSION['CURRENT_PRODUCT'], "tbl_products", "UUID", $moderator->getConnection());

                    $myid = $id[1][0]['ListOrder'];
                    $cur_id = $myid;

                    //get simple product that relataes to this
                    $responce = $product->getitemsbyref($cur_id, 'tbl_simple_product', "pod_ref", $conn);

                    //test if product is available
                    if($responce[0] == false){
                        // if not available then create
                        //gather values

                        $Stock_Quantity;
                        $Low_stock_threshhold;
                        $Sold_alone;
                        $Regular_price;
                        $cardDescription = $data->Details->sub_details->cardDescription;

                        $simple_product_data = array(
                            'SKU' => $SKU,
                            'Stock_Quantity' => $Stock_Quantity,
                            'Low_stock_threshhold' => $Low_stock_threshhold,
                            'Sold_alone' => $Sold_alone,
                            'regular_price' => $Regular_price,
                            'condition' => $data->Details->sub_details->Condition,
                            'price_cat' => $data->Details->sub_details->pricecat,
                            'package' => $data->Details->sub_details->Packaging,
                            'estimated_count' => $data->Details->sub_details->estimated_count,
                            'cardDescription' => $cardDescription
                        );


                        $simple_product_data = json_encode($simple_product_data);
                        

                        $reg = $product->simple_p_add($simple_product_data, $cur_id, $conn);

                    }else{
                        //if available then update
                        $responce = $product->getitemsbyref($responce[1][0]['SKU'], 'tbl_simple_product', "SKU", $conn);

                        $cardDescription = $data->Details->sub_details->cardDescription;

                        $simple_product_data = array(
                            'SKU' => $SKU,
                            'Stock_Quantity' => $Stock_Quantity,
                            'Low_stock_threshhold' => $Low_stock_threshhold,
                            'Sold_alone' => $Sold_alone,
                            'regular_price' => $Regular_price,
                            'condition' => $data->Details->sub_details->Condition,
                            'price_cat' => $data->Details->sub_details->pricecat,
                            'package' => $data->Details->sub_details->Packaging,
                            'estimated_count' => $data->Details->sub_details->estimated_count,
                            'cardDescription' => $cardDescription
                        );

                        $simple_product_data = json_encode($simple_product_data);
                        
                        $reg = $product->simple_p_update($simple_product_data, $responce[1][0]['UUID'], $conn);
                    }

                    exit();
                } else {
                    
                    exit();
                }
                
            }else{
                // if its new entry
                $reg = $product->product_add($product_data, $conn);

                if ($reg[0]) {
                    $_SESSION['CURRENT_PRODUCT'] = $reg[1][0]['UUID'];

                    $id = $moderator->getitemsbyref($_SESSION['CURRENT_PRODUCT'], "tbl_products", "UUID", $moderator->getConnection());

                    $myid = $id[1][0]['ListOrder'];
                    $cur_id = $myid;

                    
                    //get simple product that relataes to this
                    $responce = $product->getitemsbyref($cur_id, 'tbl_simple_product', "pod_ref", $conn);

                    //test if product is available
                    if ($responce[0] == false) {
                        // if not available then create
                        //gather values

                        $Stock_Quantity;
                        $Low_stock_threshhold;
                        $Sold_alone;
                        $Regular_price;
                        $cardDescription = $data->Details->sub_details->cardDescription;

                        $simple_product_data = array(
                            'SKU' => $SKU,
                            'Stock_Quantity' => $Stock_Quantity,
                            'Low_stock_threshhold' => $Low_stock_threshhold,
                            'Sold_alone' => $Sold_alone,
                            'regular_price' => $Regular_price,
                            'condition' => $data->Details->sub_details->Condition,
                            'price_cat' => $data->Details->sub_details->pricecat,
                            'package' => $data->Details->sub_details->Packaging,
                            'estimated_count' => $data->Details->sub_details->estimated_count,
                            'cardDescription' => $cardDescription
                        );


                        $simple_product_data = json_encode($simple_product_data);
                        

                        $reg = $product->simple_p_add($simple_product_data, $cur_id, $conn);
                    } else {
                        //if available then update
                        $responce = $product->getitemsbyref($responce[1][0]['SKU'], 'tbl_simple_product', "SKU", $conn);

                        $cardDescription = $data->Details->sub_details->cardDescription;

                        $simple_product_data = array(
                            'SKU' => $SKU,
                            'Stock_Quantity' => $Stock_Quantity,
                            'Low_stock_threshhold' => $Low_stock_threshhold,
                            'Sold_alone' => $Sold_alone,
                            'regular_price' => $Regular_price,
                            'condition' => $data->Details->sub_details->Condition,
                            'price_cat' => $data->Details->sub_details->pricecat,
                            'package' => $data->Details->sub_details->Packaging,
                            'estimated_count' => $data->Details->sub_details->estimated_count,
                            'cardDescription' => $cardDescription
                        );

                        $simple_product_data = json_encode($simple_product_data);
                        


                        $reg = $product->simple_p_update($simple_product_data, $responce[1][0]['UUID'], $conn);
                    }

                    exit();
                } else {
                    exit();
                }

            }

            
        }else{
            
        }

    } elseif ($action == "get_product"){
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : "";

        if (!empty($data)) {
            $resp = $moderator->getitemsbyref($data, "tbl_products", "UUID", $moderator->getConnection());

            if($resp[0] == true){
                echo json_encode($resp);
            }else{
                $resp = array(
                    false
                );

                echo json_encode($resp);
            }
        }else{
            echo "not set";
        }

    } elseif ($action == "adding_product_category") {
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : "";

        $responce = array(
            false
        );

        if (!empty($data)) {
            
            $UUID = encodeToHTML($data);

            $fields = [
                'products_id',
                'category_id'
            ];

            $resp = $moderator->getitemsbyref($_SESSION['CURRENT_PRODUCT'], "tbl_products", "UUID", $moderator->getConnection());

            $id = $resp[1][0]['ListOrder'];

            $values = [
                $id,
                $UUID
            ];

            $dataset  = array_combine($fields, $values);

            $table = "products_category_domain";

            $type = "ss"; 

            $responce = $moderator->add_to_database($dataset,$table,$moderator->getConnection(),$type);

            var_dump($responce);
            exit();

            if ($responce == true) {
                $responce = array(
                    true
                );
            } else {
                $responce = array(
                    false
                );
            }
        }
        echo json_encode($responce);


    } elseif ($action == "removing_product_category") {
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : "";
        $responce = array(
            false
        );

        if (!empty($data)) {
            $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : "";

            if (!empty($data)) {

                $UUID = encodeToHTML($data);

                $fields = [
                    'products_id',
                    'category_id'
                ];

                $resp = $moderator->getitemsbyref($_SESSION['CURRENT_PRODUCT'], "tbl_products", "UUID", $moderator->getConnection());

                $id = $resp[1][0]['ListOrder'];

                $values = [
                    $id,
                    $UUID
                ];

                $dataset  = array_combine($fields, $values);

                $table = "products_category_domain";

                $type = "ss";

                $responce = $admin->delete_from_database($dataset, $table, $admin->getConnection(), $type);

                if($responce == true){
                    $responce = array(
                        true
                    );
                }else{
                    $responce = array(
                        false
                    );
                }
            }
        }

        echo json_encode($responce);
    }else{
        echo (json_encode("hi"));
    }
}elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $admin->deleteall("tbl_moderators",$conn = $admin->getConnection());
}else{
    echo "not POst";
}
