-- 1. Выведите информацию о клиенте -название компании, имя контакта и номер факса. 
-- Если у клиента нет номера факса, используйте вместо него номер телефона.

select company_name, contact_name, coalesce(fax, phone) as contact_number
from customers;

-- 2. Предоставьте  информацию  о  компании  клиента,  стране,  
-- в  которой  он  находится  с  указанием региона. Если у клиента не указан регион, используйте "Not specified".

select company_name, country, coalesce(region, 'Not specified') as region 
from customers;

-- 3. Используйте CASE для категоризации каждого продукта по цене за единицу на основе следующих критериев:

-- Если цена единицы товара меньше 10, отнесите его к категории "Дешевые".
-- Если цена единицы товара составляет от 10 до 50, классифицируйте его как "Разумный".
-- Если цена единицы товара больше 50, отнесите его к категории "Дорогой".

select product_name, unit_price,
	case 
        when unit_price < 10 then 'Дешевые'
        when unit_price between 10 and 50 then 'Разумный'
        when unit_price > 50 then'Дорогой'
    end as price_category
from products;

-- 4. Получите названия и цены каждого товара, а также указания на то, 
-- есть ли товар в данный момент на складе (выведите "Да" или "Нет").

select product_name, unit_price, 
	case 
		when units_in_stock > 0 then 'Да' 
		else 'Нет' 
	end as in_stock
from products;

-- 5. Выведите  ФИО  сотрудников  и  их  должности.  В  случае  если  
-- должность  =  Sales  Representative вывести вместо неё Sales Stuff.

select concat(first_name, ' ', last_name) as full_name,
    case 
        when title = 'Sales Representative' then 'Sales Stuff'
        else title
    end as job_title
from employees;

-- 6. Выведите  общую  стоимость  каждого  заказа.  Примените  скидку  10%  к  товарной позиции,  
-- если количество товаров больше 50. 

select orders.order_id, SUM(
	case
		when order_details.quantity > 50 then order_details.unit_price * order_details.quantity * 0.9 
		else order_details.unit_price * order_details.quantity 
	end) 
	as total_cost
from orders
join order_details using(order_id)
join products using(product_id)
group by orders.order_id

-- 7. Получите имя и фамилию сотрудников, с указанием их домашнего телефона. 
-- Если у сотрудника не указан  телефон,  используйте  телефон  его  руководителя.  
-- Если  у  руководителя  не  указан  телефон, используйте вместо него "Unknown".

-- Перед  выполнением  задания,  выполните  следующий  код  
-- (записи  необходимы  для  тестирования корректности выполнения задания):

INSERT INTO Employees(employee_id, last_name, first_name, title, reports_to)
VALUES 
(10, 'Vitaly', 'Kondratev', 'Vice President, Sales', 1),
(11, 'Gabriela', 'Silva', 'Sales Manager', 10);

select concat(e.first_name, ' ', e.last_name) as employee_name,
coalesce(e.home_phone, r.home_phone, 'Unknown') AS phone
from employees e
left join employees r on e.reports_to = r.employee_id

-- 8. Найти заказчиков, не сделавших ни одного заказа. Вывести имя заказчика и значение 'no orders' если order_id = NULL.

select c.company_name as customer_name, 
	case 
		when o.order_id is null then 'no orders' 
		else '' 
	end as order_status
from customers c
left join orders o using(customer_id)
where o.order_id is null;

-- 9. Получите  имена  сотрудников  и  грузоотправителя  (shippers)  для  каждого  заказа.  
-- Если грузоотправитель неизвестен, используйте "Unknown" в качестве имени грузоотправителя.

-- Перед  выполнением  задания,  выполните  следующий  код  
-- (записи  необходимы  для  тестирования корректности выполнения задания): 

INSERT INTO Orders(order_id, customer_id, employee_id)
VALUES 
(850, 'RATTC', 5);

select concat(e.first_name, ' ', e.last_name) as employee_name,
coalesce(s.company_name, 'Unknown') as shipper_name, o.order_id
from orders o
join employees e on o.employee_id = e.employee_id
left join shippers s on o.ship_via = s.shipper_id;

