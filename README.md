# shop_test
1.進入config/dbconfig.php 修改資料庫 帳號,密碼
新增 資料庫db_shop
語法:

商品
CREATE TABLE `db_shop`.`commodity_item` ( `ciSno` BIGINT NOT NULL AUTO_INCREMENT COMMENT '商品主鍵' , `ciName` TEXT NULL DEFAULT NULL COMMENT '商品名稱' , `ciImg` TEXT NULL DEFAULT NULL COMMENT '商品圖片 ' , `ciDescription` TEXT NULL DEFAULT NULL COMMENT '商品描述 ' , `ciPrice` INT NULL DEFAULT '0' COMMENT '商品價格 ' , `ciShippingFee` INT NULL DEFAULT '0' COMMENT '商品運費 ' , `ciInput` INT NULL DEFAULT '0' COMMENT '進貨量 ' , `ciType` INT NULL DEFAULT '0' COMMENT '商品類型 ' , `ciStatus` TINYINT NULL DEFAULT '0' COMMENT '商品狀態 ' , PRIMARY KEY (`ciSno`)) ENGINE = InnoDB;

商品類型
CREATE TABLE `db_shop`.`commodity_type` ( `ptSno` BIGINT NOT NULL AUTO_INCREMENT COMMENT '商品類型主鍵' , `ptName` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT '商品類型名稱' , `ptStatus` TINYINT NULL COMMENT '商品類型狀態' , PRIMARY KEY (`ptSno`)) ENGINE = InnoDB;

折扣券
CREATE TABLE `db_shop`.`coupon_list` ( `clSno` BIGINT NOT NULL AUTO_INCREMENT COMMENT '折扣券主鍵' , `clCode` TEXT NULL DEFAULT NULL COMMENT '折扣碼' , `clDiscount` TEXT NULL DEFAULT NULL COMMENT '折扣數' , `clLimit` INT NULL DEFAULT '0' COMMENT '達標金額' , `clItem` TEXT NULL DEFAULT NULL COMMENT '折扣碼範圍(逗號隔開)' , `clStatus` TINYINT NULL DEFAULT '0' COMMENT '折扣券狀態' , PRIMARY KEY (`clSno`)) ENGINE = InnoDB;

訂單
CREATE TABLE `db_shop`.`order_list` ( `olSno` BIGINT NOT NULL AUTO_INCREMENT COMMENT '訂單主鍵' , `olAccount` TEXT NULL DEFAULT NULL COMMENT '訂購人' , `olCommodityList` TEXT NULL DEFAULT NULL COMMENT '訂購清單' , `olAmount` INT NOT NULL DEFAULT '0' COMMENT '訂購金額' , `olShippingFee` INT NOT NULL DEFAULT '0' COMMENT '訂單運費' , `olCoupon` TEXT NULL DEFAULT NULL COMMENT '折扣碼' , `olEstablishedTime` DATE NULL DEFAULT NULL COMMENT '訂單成立時間' , `olUpdateTime` DATE NULL DEFAULT NULL COMMENT '訂單更新時間' , `olStatus` TINYINT NOT NULL DEFAULT '0' COMMENT '訂單狀態' , PRIMARY KEY (`olSno`)) ENGINE = InnoDB;
*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*
新增資料
INSERT INTO `commodity_item` (`ciSno`, `ciName`, `ciImg`, `ciDescription`, `ciPrice`, `ciShippingFee`, `ciInput`, `ciType`, `ciStatus`) VALUES (NULL, '運動飲料', 'yourImg', '飲料', '20', '5', '100', '4', '1'), (NULL, '爆米花', 'yourImg', '好吃', '30', '10', '100', '3', '1'),(NULL, '鍋具', 'yourImg', '好用', '999', '10', '500', '1', '1'), (NULL, '魚', 'youImg', '好吃', '199', '50', '200', '5', '1')

INSERT INTO `commodity_type` (`ptSno`, `ptName`, `ptStatus`) VALUES (NULL, '生活雜務', '1'),(NULL, '3C', '1'),(NULL, '零食', '1'),(NULL, '飲料', '1'),(NULL, '生鮮', '1')

INSERT INTO `coupon_list` (`clSno`, `clCode`, `clDiscount`, `clLimit`, `clItem`, `clStatus`) VALUES (NULL, 'AA123', '100', '100', '2', '1');



