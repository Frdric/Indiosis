SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

USE `indiosis_main` ;

-- -----------------------------------------------------
-- Table `indiosis_main`.`Organization`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`Organization` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `acronym` VARCHAR(10) NULL ,
  `name` VARCHAR(250) NOT NULL ,
  `type` ENUM('association','company','ngo','consultant','recycler','clean-tech') NOT NULL DEFAULT 'company' ,
  `description` TEXT NULL ,
  `linkedin_id` INT NULL ,
  `verified` TINYINT(1) NOT NULL DEFAULT 0 ,
  `anonymous` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`User`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`User` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(45) NOT NULL ,
  `password` CHAR(32) NOT NULL ,
  `lastName` VARCHAR(45) NULL ,
  `firstName` VARCHAR(45) NULL ,
  `prefix` VARCHAR(20) NULL ,
  `title` VARCHAR(250) NULL ,
  `bio` TEXT NULL ,
  `linkedin_id` INT NULL ,
  `oauth_token` VARCHAR(100) NULL ,
  `oauth_secret` VARCHAR(100) NULL ,
  `last_connected` TIMESTAMP NULL ,
  `joined_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `verification_code` VARCHAR(100) NOT NULL DEFAULT 'verified' ,
  `Organization_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_User_Organization_idx` (`Organization_id` ASC) ,
  CONSTRAINT `fk_User_Organization`
    FOREIGN KEY (`Organization_id` )
    REFERENCES `indiosis_main`.`Organization` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`ClassificationSystem`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`ClassificationSystem` (
  `name` VARCHAR(20) NOT NULL ,
  `fullName` VARCHAR(250) NULL ,
  `revision` VARCHAR(50) NULL ,
  PRIMARY KEY (`name`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`ClassCode`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`ClassCode` (
  `number` VARCHAR(250) NOT NULL ,
  `description` TEXT NOT NULL ,
  `uom` VARCHAR(50) NULL ,
  `ChildOf_number` VARCHAR(250) NULL ,
  `ClassificationSystem_name` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`number`) ,
  INDEX `fk_ResourceCode_ClassificationSystem_idx` (`ClassificationSystem_name` ASC) ,
  INDEX `fk_ResourceCode_ChildOf_idx` (`ChildOf_number` ASC) ,
  CONSTRAINT `fk_ResourceCode_ClassificationSystem`
    FOREIGN KEY (`ClassificationSystem_name` )
    REFERENCES `indiosis_main`.`ClassificationSystem` (`name` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ResourceCode_ChildOf`
    FOREIGN KEY (`ChildOf_number` )
    REFERENCES `indiosis_main`.`ClassCode` (`number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`CustomClass`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`CustomClass` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` TEXT NOT NULL ,
  `description` TEXT NOT NULL ,
  `MatchingCode_number` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_CustomResource_ResourceCode1_idx` (`MatchingCode_number` ASC) ,
  CONSTRAINT `fk_CustomResource_ResourceCode1`
    FOREIGN KEY (`MatchingCode_number` )
    REFERENCES `indiosis_main`.`ClassCode` (`number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`ResourceFlow`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`ResourceFlow` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(255) NULL ,
  `qty` INT NULL ,
  `qtyUom` VARCHAR(20) NULL ,
  `frequency` VARCHAR(20) NULL ,
  `reach` VARCHAR(250) NULL ,
  `added_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `hideQty` TINYINT(1) NOT NULL DEFAULT 0 ,
  `hideQtyUom` TINYINT(1) NOT NULL DEFAULT 0 ,
  `hideLocation` TINYINT(1) NOT NULL DEFAULT 0 ,
  `ClassCode_number` VARCHAR(250) NULL ,
  `CustomClass_id` INT NULL ,
  `Provider_id` INT NULL ,
  `Receiver_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ResourceFlow_CustomClass_idx` (`CustomClass_id` ASC) ,
  INDEX `fk_ResourceFlow_ClassCode_idx` (`ClassCode_number` ASC) ,
  INDEX `fk_ResourceFlow_Provider_idx` (`Provider_id` ASC) ,
  INDEX `fk_ResourceFlow_Receiver_idx` (`Receiver_id` ASC) ,
  CONSTRAINT `fk_ResourceFlow_CustomClass`
    FOREIGN KEY (`CustomClass_id` )
    REFERENCES `indiosis_main`.`CustomClass` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ResourceFlow_ClassCode`
    FOREIGN KEY (`ClassCode_number` )
    REFERENCES `indiosis_main`.`ClassCode` (`number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ResourceFlow_Provider`
    FOREIGN KEY (`Provider_id` )
    REFERENCES `indiosis_main`.`Organization` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ResourceFlow_Receiver`
    FOREIGN KEY (`Receiver_id` )
    REFERENCES `indiosis_main`.`Organization` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`Message`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`Message` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(250) NULL ,
  `body` TEXT NULL ,
  `sent_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `Sender_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Message_Sender_idx` (`Sender_id` ASC) ,
  CONSTRAINT `fk_Message_Sender`
    FOREIGN KEY (`Sender_id` )
    REFERENCES `indiosis_main`.`User` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`Symbiosis`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`Symbiosis` (
  `id` INT NOT NULL ,
  `status` ENUM('REQ', 'ACPTED', 'REJ','ACTIVE','INACTIVE','FAILED') NOT NULL DEFAULT 'REQ' ,
  `descrition` TEXT NULL ,
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `expires_on` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`ISCase`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`ISCase` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` TEXT NOT NULL ,
  `type` ENUM('wastex','ecopark','intra','local','regional','mutual') NOT NULL ,
  `description` TEXT NULL ,
  `financial_impact` TEXT NULL ,
  `hr_impact` TEXT NULL ,
  `org_impact` TEXT NULL ,
  `envmnt_impact` TEXT NULL ,
  `contingencies` TEXT NULL ,
  `source` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`Location`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`Location` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(250) NOT NULL ,
  `addressLine1` TEXT NULL ,
  `addressLine2` TEXT NULL ,
  `city` VARCHAR(250) NULL ,
  `zip` VARCHAR(250) NULL ,
  `state` VARCHAR(250) NULL ,
  `country` VARCHAR(250) NOT NULL ,
  `lat` VARCHAR(250) NULL ,
  `lng` VARCHAR(250) NULL ,
  `Organization_id` INT NULL ,
  `ResourceFlow_id` INT NULL ,
  `ISCase_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Location_Organization_idx` (`Organization_id` ASC) ,
  INDEX `fk_Location_ResourceFlow_idx` (`ResourceFlow_id` ASC) ,
  INDEX `fk_Location_ISCase1_idx` (`ISCase_id` ASC) ,
  CONSTRAINT `fk_Location_Organization`
    FOREIGN KEY (`Organization_id` )
    REFERENCES `indiosis_main`.`Organization` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Location_ResourceFlow`
    FOREIGN KEY (`ResourceFlow_id` )
    REFERENCES `indiosis_main`.`ResourceFlow` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Location_ISCase1`
    FOREIGN KEY (`ISCase_id` )
    REFERENCES `indiosis_main`.`ISCase` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`CommunicationMean`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`CommunicationMean` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `type` ENUM('email','phone','fax','skype','gtalk','msn','yahoo','website','twitter') NOT NULL ,
  `value` VARCHAR(250) NOT NULL ,
  `label` VARCHAR(250) NULL ,
  `User_id` INT NULL ,
  `Organization_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_CommunicationMean_User_idx` (`User_id` ASC) ,
  INDEX `fk_CommunicationMean_Organization_idx` (`Organization_id` ASC) ,
  CONSTRAINT `fk_CommunicationMean_User`
    FOREIGN KEY (`User_id` )
    REFERENCES `indiosis_main`.`User` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CommunicationMean_Organization`
    FOREIGN KEY (`Organization_id` )
    REFERENCES `indiosis_main`.`Organization` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`Affiliation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`Affiliation` (
  `Parent_id` INT NOT NULL ,
  `Child_id` INT NOT NULL ,
  PRIMARY KEY (`Parent_id`, `Child_id`) ,
  INDEX `fk_Affiliation_Child_idx` (`Child_id` ASC) ,
  INDEX `fk_Affiliation_Parent_idx` (`Parent_id` ASC) ,
  CONSTRAINT `fk_Affiliation_Parent`
    FOREIGN KEY (`Parent_id` )
    REFERENCES `indiosis_main`.`Organization` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Affiliation_Child`
    FOREIGN KEY (`Child_id` )
    REFERENCES `indiosis_main`.`Organization` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`CodeCorrelation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`CodeCorrelation` (
  `ReferringCode_number` VARCHAR(250) NOT NULL ,
  `CorrelatingCode_number` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`ReferringCode_number`, `CorrelatingCode_number`) ,
  INDEX `fk_CodeCorrelation_CorrelatingCode_idx` (`CorrelatingCode_number` ASC) ,
  INDEX `fk_CodeCorrelation_ReferringCode_idx` (`ReferringCode_number` ASC) ,
  CONSTRAINT `fk_CodeCorrelation_ReferringCode`
    FOREIGN KEY (`ReferringCode_number` )
    REFERENCES `indiosis_main`.`ClassCode` (`number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CodeCorrelation_CorrelatingCode`
    FOREIGN KEY (`CorrelatingCode_number` )
    REFERENCES `indiosis_main`.`ClassCode` (`number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`Expertise`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`Expertise` (
  `ResourceCode_number` VARCHAR(250) NOT NULL ,
  `Organization_id` INT NOT NULL ,
  `User_id` INT NOT NULL ,
  PRIMARY KEY (`ResourceCode_number`, `Organization_id`, `User_id`) ,
  INDEX `fk_Expertise_ResourceCode_idx` (`ResourceCode_number` ASC) ,
  INDEX `fk_Expertise_User_idx` (`User_id` ASC) ,
  INDEX `fk_Expertise_Organization_idx` (`Organization_id` ASC) ,
  CONSTRAINT `fk_Expertise_User`
    FOREIGN KEY (`User_id` )
    REFERENCES `indiosis_main`.`User` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Expertise_ResourceCode`
    FOREIGN KEY (`ResourceCode_number` )
    REFERENCES `indiosis_main`.`ClassCode` (`number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Expertise_Organization`
    FOREIGN KEY (`Organization_id` )
    REFERENCES `indiosis_main`.`Organization` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`SymbioticFlow`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`SymbioticFlow` (
  `Symbiosis_id` INT NOT NULL ,
  `ResourceFlow_id` INT NOT NULL ,
  PRIMARY KEY (`Symbiosis_id`, `ResourceFlow_id`) ,
  INDEX `fk_SymbioticFlow_ResourceFlow_idx` (`ResourceFlow_id` ASC) ,
  INDEX `fk_SymbioticFlow_Symbiosis_idx` (`Symbiosis_id` ASC) ,
  CONSTRAINT `fk_SymbioticFlow_Symbiosis`
    FOREIGN KEY (`Symbiosis_id` )
    REFERENCES `indiosis_main`.`Symbiosis` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SymbioticFlow_ResourceFlow`
    FOREIGN KEY (`ResourceFlow_id` )
    REFERENCES `indiosis_main`.`ResourceFlow` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`SymbioticOrganization`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`SymbioticOrganization` (
  `Symbiosis_id` INT NOT NULL ,
  `Organization_id` INT NOT NULL ,
  PRIMARY KEY (`Symbiosis_id`, `Organization_id`) ,
  INDEX `fk_SymbioticOrganization_Organization_idx` (`Organization_id` ASC) ,
  INDEX `fk_SymbioticOrganization_Symbiosis_idx` (`Symbiosis_id` ASC) ,
  CONSTRAINT `fk_SymbioticOrganization_Symbiosis`
    FOREIGN KEY (`Symbiosis_id` )
    REFERENCES `indiosis_main`.`Symbiosis` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SymbioticOrganization_Organization`
    FOREIGN KEY (`Organization_id` )
    REFERENCES `indiosis_main`.`Organization` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`MessageRecipient`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`MessageRecipient` (
  `Message_id` INT NOT NULL ,
  `Recipient_id` INT NOT NULL ,
  `read` TINYINT(1) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`Message_id`, `Recipient_id`) ,
  INDEX `fk_MessageRecipient_Recipient_idx` (`Recipient_id` ASC) ,
  INDEX `fk_MessageRecipient_Message_idx` (`Message_id` ASC) ,
  CONSTRAINT `fk_MessageRecipient_Message`
    FOREIGN KEY (`Message_id` )
    REFERENCES `indiosis_main`.`Message` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MessageRecipient_Recipient`
    FOREIGN KEY (`Recipient_id` )
    REFERENCES `indiosis_main`.`User` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`Tag`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`Tag` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `label` ENUM('retain','expert','admin') NOT NULL ,
  `User_id` INT NULL ,
  `Organization_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Tag_User1_idx` (`User_id` ASC) ,
  INDEX `fk_Tag_Organization1_idx` (`Organization_id` ASC) ,
  CONSTRAINT `fk_Tag_User1`
    FOREIGN KEY (`User_id` )
    REFERENCES `indiosis_main`.`User` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tag_Organization1`
    FOREIGN KEY (`Organization_id` )
    REFERENCES `indiosis_main`.`Organization` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indiosis_main`.`ISCaseClass`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `indiosis_main`.`ISCaseClass` (
  `ISCase_id` INT NOT NULL ,
  `ClassCode_number` VARCHAR(250) NOT NULL ,
  `role` ENUM('producer','consumer','reprocessor') NOT NULL ,
  PRIMARY KEY (`ISCase_id`, `ClassCode_number`, `role`) ,
  INDEX `fk_ISCase_has_ClassCode_ClassCode1_idx` (`ClassCode_number` ASC) ,
  INDEX `fk_ISCase_has_ClassCode_ISCase1_idx` (`ISCase_id` ASC) ,
  CONSTRAINT `fk_ISCase_has_ClassCode_ISCase1`
    FOREIGN KEY (`ISCase_id` )
    REFERENCES `indiosis_main`.`ISCase` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ISCase_has_ClassCode_ClassCode1`
    FOREIGN KEY (`ClassCode_number` )
    REFERENCES `indiosis_main`.`ClassCode` (`number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `indiosis_main`.`Organization`
-- -----------------------------------------------------
START TRANSACTION;
USE `indiosis_main`;
INSERT INTO `indiosis_main`.`Organization` (`id`, `acronym`, `name`, `type`, `description`, `linkedin_id`, `verified`, `anonymous`, `created_on`) VALUES (NULL, 'UNIL', 'University of Lausanne', 'consultant', 'Founded in 1537, the University of Lausanne is composed of seven faculties where approximately 12,400 students and 2,300 researchers work and study. Emphasis is placed on an interdisciplinary approach, with close cooperation between students, professors and teaching staff.', NULL, 1, 0, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `indiosis_main`.`User`
-- -----------------------------------------------------
START TRANSACTION;
USE `indiosis_main`;
INSERT INTO `indiosis_main`.`User` (`id`, `email`, `password`, `lastName`, `firstName`, `prefix`, `title`, `bio`, `linkedin_id`, `oauth_token`, `oauth_secret`, `last_connected`, `joined_on`, `verification_code`, `Organization_id`) VALUES (NULL, 'fred@roi-online.org', '2ed91c548d1e8fecb55650ea0a15d8e6', 'Andreae', 'Frédéric', 'Mr', 'indiosis_main Administrator', 'Analyst at the UNIL.', NULL, NULL, NULL, NULL, NULL, 'verified', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `indiosis_main`.`ClassificationSystem`
-- -----------------------------------------------------
START TRANSACTION;
USE `indiosis_main`;
INSERT INTO `indiosis_main`.`ClassificationSystem` (`name`, `fullName`, `revision`) VALUES ('HS', 'Harmonized System', '2005');
INSERT INTO `indiosis_main`.`ClassificationSystem` (`name`, `fullName`, `revision`) VALUES ('ISIC', 'International Standard Industrial Classification of All Economic Activities', '4');

COMMIT;
