SELECT O.OrderNumber, CONVERT(date,O.OrderDate) AS Date,
P.ProductName, I.Quantity, I.UnitPrice
FROM [Order] O
JOIN OrderItem I ON O.Id = I.OrderId
JOIN Product P ON P.Id = I.ProductId
ORDER BY O.OrderNumber

SELECT p.ListOrder,p.productName,p.UUID,SP.UUID,SP.cardDescription,ID.image_id,IM.path_from_root
FROM tbl_products P
JOIN tbl_simple_product SP ON sp.pod_ref= p.ListOrder
JOIN image_prod_domain ID ON ID.product_id = p.ListOrder
JOIN tbl_image_db IM ON IM.UUID = ID.image_id
ORDER BY P.ListOrder

