# Vietnamese Administrative Units Dataset (Updated July 2025)

This repository provides a comprehensive dataset of Vietnamese administrative units, updated to reflect the administrative restructuring effective from July 1, 2025. The dataset includes:

- [x] **List of 34 provinces and centrally governed cities** with their official state-standard names and codes.
- [x] **List of 3,321 commune-level administrative units** (communes, wards, and special zones).
- [x] **Data formats**: SQL, CSV, and JSON.

The data is sourced from official announcements by the Vietnamese government, including Resolution No. 60-NQ/TW and Decision No. 759/QD-TTg, and is aligned with the two-tier local government model (provincial and commune levels) effective from July 1, 2025.

## Dataset Structure

### Provinces
- **Table Name**: `vn_locations`
- **Fields**:
  - `id`: Unique identifier (auto-increment).
  - `name`: Official name of the province/city (e.g., Hà Nội).
  - `full_name`: Full name with diacritics (e.g., Thành phố Hà Nội).
  - `code`: Official two-digit code (e.g., 01 for Hà Nội).
  - `type`: Type of administrative unit (e.g., province, city).
  - `parent_code`: Not applicable for provinces (set to NULL).

### Communes
- **Table Name**: `vn_locations` (same table, differentiated by `type` and `parent_code`)
- **Fields**:
  - `id`: Unique identifier (auto-increment).
  - `name`: Name of the commune/ward (e.g., Trung Yên).
  - `full_name`: Full name with diacritics (e.g., Xã Trung Yên).
  - `code`: Unique code for the commune/ward.
  - `type`: Type of unit (commune, ward, special_zone).
  - `parent_code`: Code of the parent province/city.

## Files Included
- `vn_locations.sql`: SQL script to create the `vn_locations` table and insert data.
- `vn_locations.csv`: CSV file containing the same data for easy import.
- `vn_locations.json`: JSON file with structured data for programmatic use.

## Usage
**COMPOSER**: 
     ```
     composer require ngankt2/vn-location
     ```

**SQL**:
   - Execute `vn_locations.sql` in your database (e.g., MySQL, PostgreSQL) to create the table and import data.
   - Example:
     ```bash
     mysql -u username -p database_name < vn_locations.sql
     ```
**CSV**:
   - Import `vn_locations.csv` into your database or spreadsheet software.
   - Ensure the database table structure matches the fields described above.
**JSON**:
   - Use `vn_locations.json` for applications requiring JSON data.

## License
This dataset is provided under the MIT License. Feel free to use, modify, and distribute it for non-commercial and commercial purposes, with attribution to this repository.

## Contributing
Contributions are welcome! Please submit a pull request with updates or corrections to the dataset.

## Contact
For questions or feedback, please open an issue on this repository.
