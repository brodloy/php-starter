-- ============================================================================
-- SEED — demo data. Run after migrations (php console db:install).
--   demo@example.com  / password   (regular user, email verified)
--   admin@example.com / password   (admin)
-- The hash below is a real argon2id hash of the word "password".
--
-- Safe to run more than once: INSERT IGNORE skips rows whose unique email
-- already exists, so a repeated db:install won't error or duplicate data.
-- ============================================================================

INSERT IGNORE INTO `User` (`Name`, `Email`, `PasswordHash`, `Role`, `Active`, `VerifiedAt`, `CreatedAt`, `UpdatedAt`) VALUES
('Demo User',  'demo@example.com',  '$argon2id$v=19$m=65536,t=4,p=1$SC5SZzlSTjFDSWw4WENmOQ$xMDiV+wt4UsPvSFC5Y+EHjfK+zVQvaitpH4+xFPEDNg', 'user',  1, UTC_TIMESTAMP(), UTC_TIMESTAMP(), UTC_TIMESTAMP()),
('Admin User', 'admin@example.com', '$argon2id$v=19$m=65536,t=4,p=1$SC5SZzlSTjFDSWw4WENmOQ$xMDiV+wt4UsPvSFC5Y+EHjfK+zVQvaitpH4+xFPEDNg', 'admin', 1, UTC_TIMESTAMP(), UTC_TIMESTAMP(), UTC_TIMESTAMP());

SET @uid = (SELECT `PK_UserID` FROM `User` WHERE `Email` = 'demo@example.com');

INSERT IGNORE INTO `Example` (`PK_ExampleID`, `FK_UserID`, `Title`, `Body`, `Status`, `CreatedAt`, `UpdatedAt`) VALUES
(1, @uid, 'Quarterly report',     'Revenue is up 12% quarter over quarter.', 'active', UTC_TIMESTAMP(), UTC_TIMESTAMP()),
(2, @uid, 'Onboarding checklist', 'Steps for getting new teammates set up.', 'active', UTC_TIMESTAMP(), UTC_TIMESTAMP());
