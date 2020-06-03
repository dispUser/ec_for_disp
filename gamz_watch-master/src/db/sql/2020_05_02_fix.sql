-- make email necessary
ALTER TABLE `dat_member` CHANGE `email` `email` VARCHAR
(50) CHARACTER
SET utf8
COLLATE utf8_unicode_ci NULL;

-- make email uniueq
ALTER TABLE `dat_member`
ADD UNIQUE
( `email`);