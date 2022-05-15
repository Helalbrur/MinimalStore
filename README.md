System Overview:
Create a minimal store system.
Create three role:
1. Employee
2. Admin
3. Store Executive
The Employee can create requisition.
To summarize, the employee should have the following responsibilities:
 Create requisition.

a. Choose multiple item for requisition
b. Item wise qty
 See the created list of requisition .
 See the approved or rejected list of requisition.
The system has administrator who manages the system. The admin can approve or reject requisition.
To summarize, the admin should have the following responsibilities:
 Add/Remove/Update/ items.
 Add/Remove/Update/ Suppliers.
 See the list of stock.
 Approve or reject the requisition.
The Store Executive can receive this invoice items, Update stock and can issue items of approved
requisition.
To summarize, the Store Executive should have the following responsibilities:
 Receive Items though suppliers.
 See the list of Receive Items.
 See the list of Items Stock qty, price.
 Sort the items by lowest/highest price.
 Item issue price in FIFO method [like: first received item will be issued first]

The system should also fulfill the following requirements:
 Item should contain the following fields: Name, Description, status.
 Supplier should contain the following fields: Name, Phone, Email, Address, status.
 When an Requisition is create, the admin should be notified. This is up to you how you want to
handle the notification.
 When requisition approve then requisition can’t be update or delete.
 Stock should contain the following fields: item, price, qty.
 The quantity of stock items should be updated when a received / issued item.
 When items will be Issued, the price of the items should be fetched according to receive orders.

For example:
If an item is ‘X’ first receive qty 6 and price 100tk, second receive qty 3 and price
120tk then,
if two requisitions issued against the item ‘X’ of qty 5 and 4 then first issue will be 5
pcs and total price 500tk. Second issue will be 4 pcs and total price 460tk (100*1 =
100tk from the reaming qty 1 of 6 and 120*3 = 360tk from the second receive qty).


To test the project 

clone repository

run command : composer install

npm install

setup database and user in .env

run command : php artisan migrate --seed  // Create migration and also dummy data

For admin user: 
email : admin@gmail.com
pass: 123456

For employee user: 
email : employee@gmail.com
pass: 123456

For employee user: 
email : store.executive@gmail.com
pass: 123456
