CREATE TABLE client (
    client_id serial NOT NULL,
    client_name varchar(50) NOT NULL,
    client_surname varchar(50) NOT NULL,
    country_id integer NOT NULL,
    city_id integer NOT NULL,
    phone_number varchar(20) NOT NULL,
    constant varchar(20) NOT NULL,
    CONSTRAINT client_pk PRIMARY KEY (client_id)
);


CREATE TABLE countries (
    country_id serial NOT NULL,
    country_name varchar(30) NOT NULL,
    CONSTRAINT countries_pk PRIMARY KEY (country_id)
);


CREATE TABLE cities (
    city_id serial NOT NULL,
    city_name varchar(30) NOT NULL,
    country_id integer NOT NULL,
    CONSTRAINT cities_pk PRIMARY KEY (city_id)
);


CREATE TABLE hotel (
    hotel_id serial NOT NULL,
    hotel_name varchar(50) NOT NULL,
    county_id integer NOT NULL,
    city_id integer NOT NULL,
    hotel_description varchar NOT NULL,
    hotel_class integer NOT NULL,
    type_nutrition varchar(20) NOT NULL,
    CONSTRAINT hotel_pk PRIMARY KEY (hotel_id)
);


CREATE TABLE hotel_service (
    service_id serial NOT NULL,
    hotel_id integer NOT NULL,
    service_name varchar(30) NOT NULL,
    service_description varchar NOT NULL,
    service_cost numeric NOT NULL,
    CONSTRAINT hotel_service_pk PRIMARY KEY (service_id)
);


CREATE TABLE hotel_photos (
    photo_id serial NOT NULL,
    hotel_id integer NOT NULL,
    photo_url varchar NOT NULL,
    CONSTRAINT hotel_photos_pk PRIMARY KEY (photo_id)
);


CREATE TABLE hotel_room (
    room_id serial NOT NULL,
    hotel_id integer NOT NULL,
    room_number integer NOT NULL,
    room_class integer NOT NULL,
    room_price money NOT NULL,
    room_quality_seats integer NOT NULL,
    room_booking_information varchar NOT NULL,
    room_equipment integer NOT NULL,
    room_description varchar NOT NULL,
    room_square integer NOT NULL,
    quality_beds integer NOT NULL,
    CONSTRAINT hotel_room_pk PRIMARY KEY (room_id)
);


CREATE TABLE room_photos (
    photo_id serial NOT NULL,
    room_id integer NOT NULL,
    photo_url varchar NOT NULL UNIQUE,
    CONSTRAINT room_photos_pk PRIMARY KEY (photo_id)
);


CREATE TABLE equipment (
    equipment_id serial NOT NULL,
    equipment_name varchar(30) NOT NULL,
    equipment_description varchar NOT NULL,
    CONSTRAINT equipment_pk PRIMARY KEY (equipment_id)
);


CREATE TABLE hotel_room_equipment (
    id serial NOT NULL,
    room_id integer NOT NULL,
    equipment_id integer NOT NULL,
    CONSTRAINT hotel_room_equipment_pk PRIMARY KEY (id)
);


CREATE TABLE tour (
    tour_id serial NOT NULL,
    hotel_id integer NOT NULL,
    quality_nights integer NOT NULL,
    tour_description varchar NOT NULL,
    tour_picture varchar NOT NULL,
    CONSTRAINT tour_pk PRIMARY KEY (tour_id)
);


CREATE TABLE price_list (
    price_list_id serial NOT NULL,
    date timestamp NOT NULL,
    tour_id integer NOT NULL,
    cost_tour numeric NOT NULL,
    hotel_id integer NOT NULL,
    cost_hotel numeric NOT NULL,
    cost_service_hotel numeric NOT NULL,
    insurance_id integer NOT NULL,
    cost_insurance numeric NOT NULL,
    carries_id integer NOT NULL,
    cost_carries numeric NOT NULL,
    CONSTRAINT price_list_pk PRIMARY KEY (price_list_id)
);


CREATE TABLE "order" (
    order_id serial NOT NULL,
    client_id integer NOT NULL,
    tour_id integer NOT NULL,
    carriers_id integer NOT NULL,
    insurance_id integer NOT NULL,
    order_date timestamp NOT NULL,
    departure_date timestamp NOT NULL,
    quality_days integer NOT NULL,
    order_amount money NOT NULL,
    order_discount integer NOT NULL,
    CONSTRAINT order_pk PRIMARY KEY (order_id)
);


CREATE TABLE insurance_company (
    company_id serial NOT NULL,
    company_name varchar(50) NOT NULL,
    company_description varchar NOT NULL,
    company_phone varchar(20) NOT NULL,
    company_url varchar NOT NULL,
    company_city integer NOT NULL,
    company_country integer NOT NULL,
    CONSTRAINT insurance_company_pk PRIMARY KEY (company_id)
);


CREATE TABLE insurance (
    insurance_id serial NOT NULL,
    company_id integer NOT NULL,
    insurance_type varchar NOT NULL,
    insurance_cost numeric NOT NULL,
    CONSTRAINT insurance_pk PRIMARY KEY (insurance_id)
);


CREATE TABLE basket (
    basket_id serial NOT NULL,
    client_id integer NOT NULL,
    tour_id integer NOT NULL,
    basket_comment varchar NOT NULL,
    CONSTRAINT basket_pk PRIMARY KEY (basket_id)
);


CREATE TABLE feedback (
    feedback_id serial NOT NULL,
    client_id integer NOT NULL,
    tour_id integer NOT NULL,
    feedback_text varchar(250) NOT NULL,
    feedback_date timestamp NOT NULL,
    feedback_status varchar NOT NULL,
    CONSTRAINT feedback_pk PRIMARY KEY (feedback_id)
);


CREATE TABLE carriers_company (
    company_id serial NOT NULL,
    company_name varchar(50) NOT NULL,
    company_description varchar NOT NULL,
    company_phone varchar(20) NOT NULL,
    company_url varchar NOT NULL,
    company_city integer NOT NULL,
    company_country integer NOT NULL,
    CONSTRAINT carriers_company_pk PRIMARY KEY (company_id)
);


CREATE TABLE carriers (
    carriers_id serial NOT NULL,
    company_id integer NOT NULL,
    carriers_type varchar NOT NULL,
    carriers_cost numeric NOT NULL,
    CONSTRAINT carriers_pk PRIMARY KEY (carriers_id)
);


ALTER TABLE client ADD CONSTRAINT client_fk0 FOREIGN KEY (country_id) REFERENCES countries(country_id);
ALTER TABLE client ADD CONSTRAINT client_fk1 FOREIGN KEY (city_id) REFERENCES cities(city_id);


ALTER TABLE cities ADD CONSTRAINT cities_fk0 FOREIGN KEY (country_id) REFERENCES countries(country_id);

ALTER TABLE hotel ADD CONSTRAINT hotel_fk0 FOREIGN KEY (county_id) REFERENCES countries(country_id);
ALTER TABLE hotel ADD CONSTRAINT hotel_fk1 FOREIGN KEY (city_id) REFERENCES cities(city_id);

ALTER TABLE hotel_service ADD CONSTRAINT hotel_service_fk0 FOREIGN KEY (hotel_id) REFERENCES hotel(hotel_id);

ALTER TABLE hotel_photos ADD CONSTRAINT hotel_photos_fk0 FOREIGN KEY (hotel_id) REFERENCES hotel(hotel_id);

ALTER TABLE hotel_room ADD CONSTRAINT hotel_room_fk0 FOREIGN KEY (hotel_id) REFERENCES hotel(hotel_id);

ALTER TABLE room_photos ADD CONSTRAINT room_photos_fk0 FOREIGN KEY (room_id) REFERENCES hotel_room(room_id);


ALTER TABLE hotel_room_equipment ADD CONSTRAINT hotel_room_equipment_fk0 FOREIGN KEY (room_id) REFERENCES hotel_room(room_id);
ALTER TABLE hotel_room_equipment ADD CONSTRAINT hotel_room_equipment_fk1 FOREIGN KEY (equipment_id) REFERENCES equipment(equipment_id);

ALTER TABLE tour ADD CONSTRAINT tour_fk0 FOREIGN KEY (hotel_id) REFERENCES hotel(hotel_id);

ALTER TABLE price_list ADD CONSTRAINT price_list_fk0 FOREIGN KEY (tour_id) REFERENCES tour(tour_id);
ALTER TABLE price_list ADD CONSTRAINT price_list_fk1 FOREIGN KEY (hotel_id) REFERENCES hotel(hotel_id);
ALTER TABLE price_list ADD CONSTRAINT price_list_fk2 FOREIGN KEY (insurance_id) REFERENCES insurance(insurance_id);
ALTER TABLE price_list ADD CONSTRAINT price_list_fk3 FOREIGN KEY (carries_id) REFERENCES carriers(carriers_id);

ALTER TABLE "order" ADD CONSTRAINT order_fk0 FOREIGN KEY (client_id) REFERENCES client(client_id);
ALTER TABLE "order" ADD CONSTRAINT order_fk1 FOREIGN KEY (tour_id) REFERENCES tour(tour_id);
ALTER TABLE "order" ADD CONSTRAINT order_fk2 FOREIGN KEY (carriers_id) REFERENCES carriers(carriers_id);
ALTER TABLE "order" ADD CONSTRAINT order_fk3 FOREIGN KEY (insurance_id) REFERENCES insurance(insurance_id);

ALTER TABLE insurance_company ADD CONSTRAINT insurance_company_fk0 FOREIGN KEY (company_city) REFERENCES cities(city_id);
ALTER TABLE insurance_company ADD CONSTRAINT insurance_company_fk1 FOREIGN KEY (company_country) REFERENCES countries(country_id);

ALTER TABLE insurance ADD CONSTRAINT insurance_fk0 FOREIGN KEY (company_id) REFERENCES insurance_company(company_id);

ALTER TABLE basket ADD CONSTRAINT basket_fk0 FOREIGN KEY (client_id) REFERENCES client(client_id);
ALTER TABLE basket ADD CONSTRAINT basket_fk1 FOREIGN KEY (tour_id) REFERENCES tour(tour_id);

ALTER TABLE feedback ADD CONSTRAINT feedback_fk0 FOREIGN KEY (client_id) REFERENCES client(client_id);
ALTER TABLE feedback ADD CONSTRAINT feedback_fk1 FOREIGN KEY (tour_id) REFERENCES tour(tour_id);

ALTER TABLE carriers_company ADD CONSTRAINT carriers_company_fk0 FOREIGN KEY (company_city) REFERENCES cities(city_id);
ALTER TABLE carriers_company ADD CONSTRAINT carriers_company_fk1 FOREIGN KEY (company_country) REFERENCES countries(country_id);

ALTER TABLE carriers ADD CONSTRAINT carriers_fk0 FOREIGN KEY (company_id) REFERENCES carriers_company(company_id);



INSERT INTO countries (country_name)
VALUES
    ('United States'),
    ('United Kingdom'),
    ('France');

   
INSERT INTO cities (city_name, country_id)
VALUES
    ('New York', 1),
    ('London', 2),
    ('Paris', 3);

INSERT INTO client (client_name, client_surname, country_id, city_id, phone_number, constant)
VALUES
    ('John', 'Doe', 1, 1, '1234567890', 'Постоянный'),
    ('Jane', 'Smith', 2, 2, '0987654321', 'Постоянный'),
    ('Michael', 'Johnson', 3, 3, '9876543210', 'Непостоянный');
   

INSERT INTO hotel (hotel_name, county_id, city_id, hotel_description, hotel_class, type_nutrition)
VALUES
    ('Hotel A', 1, 1, 'Описание A', 3, 'Full Board'),
    ('Hotel B', 2, 2, 'Описание B', 4, 'All Inclusive'),
    ('Hotel C', 3, 3, 'Описание C', 2, 'Half Board');
   
   
INSERT INTO hotel_service (hotel_id, service_name, service_description, service_cost)
VALUES
    (1, 'Ресторан', 'Описание A', 1099),
    (2, 'Тренажерный зал', 'Описание B', 1500),
    (3, 'Бассейн', 'Описание C', 1200);
   
   
INSERT INTO hotel_photos (hotel_id, photo_url)
VALUES
    (1, 'https://example.com/photo1.jpg'),
    (2, 'https://example.com/photo2.jpg'),
    (3, 'https://example.com/photo3.jpg');
   
   
INSERT INTO hotel_room (hotel_id, room_number, room_class, room_price, room_quality_seats, room_booking_information, room_equipment, room_description, room_square, quality_beds)
VALUES
    (1, 101, 1, 100.00, 2, 'Недоступно', 1, 'Стандарт', 25, 1),
    (1, 102, 2, 150.00, 2, 'Доступно', 2, 'Президентский', 35, 2),
    (2, 201, 1, 120.00, 2, 'Доступно', 1, 'Стандарт', 30, 2);
   
   
INSERT INTO room_photos (room_id, photo_url)
VALUES
    (1, 'https://example.com/photo1.jpg'),
    (1, 'https://example.com/photo2.jpg'),
    (2, 'https://example.com/photo3.jpg');
   
   
INSERT INTO equipment (equipment_name, equipment_description)
VALUES
    ('Холодильник', 'Описание 1'),
    ('Фен', 'Описание 2'),
    ('Мини-бар', 'Описание 3');
   
   
INSERT INTO hotel_room_equipment (room_id, equipment_id)
VALUES
    (1, 1),
    (1, 2),
    (2, 3);
   
   
INSERT INTO tour (hotel_id, quality_nights, tour_description, tour_picture)
VALUES
    (1, 5, 'Описание тура  1', 'tour1.jpg'),
    (2, 7, 'Описание тура  2', 'tour2.jpg'),
    (3, 4, 'Описание тура  3', 'tour3.jpg');
   
   
INSERT INTO carriers_company (company_name, company_description, company_phone, company_url, company_city, company_country)
VALUES
    ('Компания 1', 'Описание 1', '1234567890', 'www.company1.com', 1, 1),
    ('Компания 2', 'Описание 2', '0987654321', 'www.company2.com', 2, 2),
    ('Компания 3', 'Описание 3', '9876543210', 'www.company3.com', 3, 3);
   
   
INSERT INTO carriers (company_id, carriers_type, carriers_cost)
VALUES
    (1, 'Самолет', 100),
    (2, 'Автобус', 200),
    (3, 'Пароход', 300);

   
INSERT INTO insurance_company (company_name, company_description, company_phone, company_url, company_city, company_country)
VALUES
    ('Компания A', 'Описание A', '1234567890', 'www.companya.com', 1, 1),
    ('Компания B', 'Описание B', '9876543210', 'www.companyb.com', 2, 2),
    ('Компания C', 'Описание C', '5555555555', 'www.companyc.com', 3, 3);
   
   
INSERT INTO insurance (company_id, insurance_type, insurance_cost)
VALUES
    (1, 'Медицинская', 100.00),
    (2, 'Медицинская', 150.00),
    (3, 'От несчастных случаев', 200.00);
   
   
INSERT INTO basket (client_id, tour_id, basket_comment)
VALUES
    (1, 1, 'Комментарий 1'),
    (2, 2, 'Комментарий 2'),
    (3, 3, 'Комментарий 3');
   
   
INSERT INTO feedback (client_id, tour_id, feedback_text, feedback_date, feedback_status)
VALUES
    (1, 1, 'Отзыв 1', current_timestamp, 'На модерации'),
    (2, 2, 'Отзыв 2', current_timestamp, 'Отклонен'),
    (3, 3, 'Отзыв 3', current_timestamp, 'Опубликован');
   
INSERT INTO price_list (date, tour_id, cost_tour, hotel_id, cost_hotel, cost_service_hotel, insurance_id, cost_insurance, carries_id, cost_carries)
VALUES
    ('2023-05-21', 1, 500.00, 1, 200.00, 50.00, 1, 100.00, 1, 50.00),
    ('2023-05-22', 2, 700.00, 2, 250.00, 60.00, 2, 120.00, 2, 70.00),
    ('2023-05-23', 3, 400.00, 3, 180.00, 40.00, 3, 90.00, 3, 40.00);
   
   
INSERT INTO "order" (client_id, tour_id, carriers_id, insurance_id, order_date, departure_date, quality_days, order_amount, order_discount)
VALUES
    (1, 1, 1, 1, '2023-05-21', '2023-05-28', 7, 1500.00, 10),
    (2, 2, 2, 2, '2023-05-22', '2023-05-29', 7, 2000.00, 10),
    (3, 3, 3, 3, '2023-05-23', '2023-05-30', 7, 1800.00, 0);
   
