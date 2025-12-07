# Factories and Seeders Walkthrough

## Overview
I have created factory and seeder classes for all application models to enable easy data generation for testing and development. I also verified the seeding process by running `php artisan migrate:fresh --seed`.

## Changes

### Factories Created
I created factories for all models, ensuring they match the database schema.
- **Masters:** `Province`, `Program`, `Address`, `Entity`, `DocumentType`, `EmailTemplate`, `SmsTemplate`, `Event`, `LineItem`, `MetadataField`, `Shop`, `OrgNode`, `Role`, `Country`.
- **Definitions:** `EntityRoleDefinition`, `EntityTransitionDefinition`, `EntityTransitionRoleDefinition`.
- **Common:** `Asset`, `Document`, `Email`, `Sms`, `EntityTransition`, `Messaging`, `MetadataValue`.
- **Users & Dispatch:** `User`, `Dispatch`, `Driver`.
- **Truck & Maintenance:** `Truck`, `MasterTruckMaintenance`, `TruckMaintenance`, `TruckMaintenanceItem`, `TruckTracking`.
- **Shop:** `ShopJob`, `ShopJobInspection`, `ShopJobItem`.
- **Shipper & Trans:** `CarrierDispatch`, `ShipAddress`, `Shipment`, `Cargo`, `ShipmentBid`, `Transaction`, `Order`, `OrderItem`, `Carrier`, `Shipper`.
- **Payroll:** `Payroll`, `PayrollItem`.
- **Trip & Expense:** `Trip`, `TripDamage`, `TripLogbook`, `TripPickupDrop`, `Expense`, `ExpenseItem`.

### Seeders Created
I created seeders to orchestrate the data generation.
- `MasterSeeder`
- `DefinitionSeeder`
- `CommonSeeder`
- `UserDispatchSeeder`
- `TruckMaintenanceSeeder`
- `ShopSeeder`
- `ShipperTransSeeder`
- `PayrollSeeder`
- `TripExpenseSeeder`
- Updated `DatabaseSeeder` to call all the above.

## Verification
I ran the following command to verify that the database can be seeded successfully:
```bash
php artisan migrate:fresh --seed
```
**Result:** Success (Exit Code 0)

## Notes
- I fixed several mismatches between the assumed model attributes and the actual database schema during the process (e.g., `mst_country` columns, `users` table name fields, `tbl_driver` license number field).
- I ensured unique constraints (like `mst_role.name`) are respected by the factories.
