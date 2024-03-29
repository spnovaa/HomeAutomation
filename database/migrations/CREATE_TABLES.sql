BEGIN TRY
	USE SEFinal

	BEGIN TRAN T
	CREATE TABLE Users(
		U_Id			BIGINT				IDENTITY(1, 1)		NOT NULL,
		U_UsrName		NVARCHAR(128)		NOT NULL			UNIQUE,
		U_Password		NVARCHAR(256)		NOT NULL,
		U_Name			NVARCHAR(128)		NOT NULL,
		U_LName			NVARCHAR(128)		NOT NULL,

		U_CreatedAt		DATETIME2			NOT NULL,
		U_UpdatedAt		DATETIME2			NOT NULL,
		U_DeletedAt		DATETIME2			NULL

		CONSTRAINT PKUser PRIMARY KEY(U_Id)
	)


	CREATE TABLE Accounts(
		A_Id			BIGINT				IDENTITY(1, 1)		NOT NULL,
		A_UserId		BIGINT				NOT NULL			UNIQUE,
		A_Role			NVARCHAR(128)		NOT NULL,
		A_Tel			NVARCHAR(128)		NOT NULL,
		A_City			NVARCHAR(128)		NOT NULL,
		A_Address		NVARCHAR(128)		NOT NULL,

		A_CreatedAt		DATETIME2			NOT NULL,
		A_UpdatedAt		DATETIME2			NOT NULL,
		A_DeletedAt		DATETIME2			NULL

		CONSTRAINT PKAccount PRIMARY KEY(A_Id),
		CONSTRAINT FKAccountUser FOREIGN KEY(A_UserId) REFERENCES Users(U_Id)
	)


	CREATE TABLE Devices(
		D_Id			BIGINT				IDENTITY(1, 1)		NOT NULL,
		D_Name			NVARCHAR(128)		NOT NULL,
		D_Model			NVARCHAR(128)		NOT NULL,
		D_Type			TINYINT				NOT NULL,
		D_MinTemprature	INT					NULL,
		D_MaxTemprature	INT					NULL,
		D_MinBrightness	INT					NULL,
		D_MaxMinBrightness	INT				NULL,


		D_CreatedAt		DATETIME2			NOT NULL,
		D_UpdatedAt		DATETIME2			NOT NULL,
		D_DeletedAt		DATETIME2			NULL

		CONSTRAINT PKDevice PRIMARY KEY(D_Id)
	)


	CREATE TABLE UserDevices(
		UD_Id			BIGINT				IDENTITY(1, 1)		NOT NULL,
		UD_UserId		BIGINT				NOT NULL,
		UD_DeviceId		BIGINT				NOT NULL,
		UD_IsOn			TINYINT				NOT NULL,
		UD_Temprature	INT					NULL,
		UD_Brightness	INT					NULL,
		UD_CreatedAt	DATETIME2			NOT NULL,
		UD_UpdatedAt	DATETIME2			NOT NULL,
		UD_DeletedAt	DATETIME2			NULL
	
		CONSTRAINT PKUserDevice PRIMARY KEY(UD_Id),
		CONSTRAINT FKUser FOREIGN KEY(UD_UserId) REFERENCES Users(U_Id),
		CONSTRAINT FKDevice FOREIGN KEY(UD_DeviceId) REFERENCES Devices(D_Id),
		CONSTRAINT CHKOnIsBool CHECK(UD_IsOn = 0 OR UD_IsOn = 1)
	)


	CREATE TABLE Logs(
		L_Id			BIGINT				IDENTITY(1, 1)		NOT NULL,
		L_UserDeviceId	BIGINT				NULL,
		L_Action		INT					NOT NULL, -- CRUD, ...
		L_Section		INT					NOT NULL, -- MODELS
		L_Amount		DECIMAL(18, 3)		NULL,
		L_Ip			NVARCHAR(64)		NOT NULL,

		L_CreatedAt		DATETIME2			NOT NULL,
		L_UpdatedAt		DATETIME2			NOT NULL,
		L_DeletedAt		DATETIME2			NULL,

		CONSTRAINT PKLog PRIMARY KEY(L_Id),
		CONSTRAINT FKLogUserDevice FOREIGN KEY(L_UserDeviceId) REFERENCES UserDevices(UD_Id),
	)
	COMMIT TRAN T

END TRY

BEGIN CATCH

	DECLARE @ErrorMessage NVARCHAR(4000);
    DECLARE @ErrorSeverity INT;
    DECLARE @ErrorState INT;

    SELECT 
        @ErrorMessage = ERROR_MESSAGE(),
        @ErrorSeverity = ERROR_SEVERITY(),
        @ErrorState = ERROR_STATE();

	 SELECT 
        @ErrorMessage,
        @ErrorSeverity,
        @ErrorState;

	ROLLBACK TRAN T
END CATCH