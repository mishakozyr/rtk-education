-- 1. Найдите клиентов, которые не делали никаких заказов в 1997 году.

SELECT c.customer_id, c.company_name
FROM customers c
LEFT JOIN orders o ON c.customer_id = o.customer_id AND o.order_date BETWEEN '1997-01-01' AND '1997-12-31'
WHERE o.customer_id IS NULL

-- 2. Найдите продукты, которые никогда не были заказаны. Показать только названия продуктов.

SELECT product_name
FROM products
WHERE product_id NOT IN (
  SELECT product_id
  FROM order_details
)

-- 3. Найдите продукты, которые были заказаны более 50 раз. Показать только названия продуктов.

SELECT product_name
FROM products
JOIN order_details using(product_id)
GROUP BY product_name
HAVING COUNT(*) > 50;

-- 4. Вывести названия продуктов, которые были хоть раз заказаны в количестве ровно 65 единиц.

SELECT product_name
FROM products
JOIN order_details using(product_id)
WHERE quantity = 65;

-- 5. Вывести список сотрудников (id, фамилия, имя), которые не обработали ни одного заказа.

SELECT employee_id, last_name, first_name 
FROM employees 
WHERE NOT EXISTS (
  SELECT 1 
  FROM orders 
  WHERE employee_id = employees.employee_id
)

-- 6. Найти  все  продукты, цена которых больше, чем у любого продукта в категории «Beverages».

SELECT product_name
FROM products
WHERE unit_price > (
    SELECT MAX(unit_price)
    FROM products
    WHERE category_id = (
        SELECT category_id
        FROM categories
        WHERE category_name = 'Beverages'
    )
);

-- 7. Найдите сотрудника, который был нанят в компанию предпоследним. 
-- Используйте подзапрос для исключения последнего нанятого сотрудника. 
-- Выведите id, фамилию, имя, должность и дату найма.

SELECT employee_id, last_name, first_name, title, hire_date
FROM employees
WHERE hire_date < (
    SELECT MAX(hire_date)
    FROM employees
)
ORDER BY hire_date DESC
LIMIT 1;

-- 8. Найдите общие траты каждого клиента. Значение округлите и отсортируйте по убыванию.

SELECT c.customer_id, c.company_name, ROUND(SUM(od.quantity * od.unit_price)::numeric, 2) as total_spent
FROM customers c
LEFT JOIN orders o ON c.customer_id = o.customer_id
LEFT JOIN order_details od ON o.order_id = od.order_id
LEFT JOIN products p ON od.product_id = p.product_id
GROUP BY c.customer_id, c.company_name
ORDER BY total_spent DESC;


