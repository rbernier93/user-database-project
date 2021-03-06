CREATE DATABASE test;
USE test;
create table EmployeeInformation
(EmployeeNumber int(10) NOT NULL auto_increment,
	EmployeeName char(50),
	DateJoined Date,
	Department varchar(50),
	AnnualSalary decimal (10,2),
	Project varchar(50),
	PRIMARY KEY(EmployeeNumber));

create table EmployeePhotos
(PhotoID int(10) NOT NULL auto_increment,
EmployeeNumber int(10) NOT NULL,
 image blob NOT NULL,
 PRIMARY KEY(PhotoID),
 CONSTRAINT EmployeeInformation_AS_pro FOREIGN KEY(EmployeeNumber) REFERENCES EmployeeInformation(EmployeeNumber));


insert into EmployeeInformation values('', 'Robert Bernier', '2001-03-01', 'Information Technology', '80000.00', 'Project 457181');
