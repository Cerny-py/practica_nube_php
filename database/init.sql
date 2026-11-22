SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS veterinaria_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE veterinaria_db;

CREATE TABLE IF NOT EXISTS pacientes (
  id      INT AUTO_INCREMENT PRIMARY KEY,
  nombre  VARCHAR(80)  NOT NULL,
  especie VARCHAR(50)  NOT NULL,
  estado  VARCHAR(40)  NOT NULL
);

INSERT INTO pacientes (nombre, especie, estado) VALUES
  ('Firulais', 'Perro',  'Vacunado'),
  ('Michi',    'Gato',   'En tratamiento'),
  ('Coco',     'Loro',   'Alta médica'),
  ('Toby',     'Perro',  'En observación');
