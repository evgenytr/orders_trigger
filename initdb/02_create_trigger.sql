CREATE FUNCTION update_statistics()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO statistics (category_id, total_products, day)
   	 	SELECT products.category_id, SUM(orders.quantity) AS total_products, date_trunc('day', NEW.created_at) AS day
   	 	FROM orders 
    	LEFT JOIN products ON products.id = orders.product_id 
    	WHERE date_trunc('day', NEW.created_at) = date_trunc('day', orders.created_at)
    	GROUP BY products.category_id
    ON CONFLICT (category_id, day) DO UPDATE 
    SET total_products = EXCLUDED.total_products;
    RETURN NULL;
END;
$$ LANGUAGE plpgsql;
                    
CREATE TRIGGER update_statistics_trigger 
AFTER INSERT ON orders 
FOR EACH ROW EXECUTE FUNCTION update_statistics();