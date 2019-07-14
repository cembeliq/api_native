CREATE TABLE disbursement (
	id int primary key auto_increment,
	amount int not null,
	status datetime,
	bank_code varchar(10) not null,
	account_number varchar(25) not null,
	beneficiary_name varchar(50),
	remark varchar(50) not null,
	receipt varchar(255),
	time_served datetime,
	fee int
)
