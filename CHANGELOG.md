# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Fixed
- Fixed the OAuth scopes of Deal to Lead conversion and Lead to Deal conversion endpoints
## [28.1.0] - 2025-05-21
## [28.0.1] - 2025-05-21
### Added
- Added `is_archived` to request bodies of POST `deals` endpoints and PUT/PATCH `/deals/:id` endpoints
- Added `archive_time` to request bodies of POST `deals` endpoints
## [28.0.0] - 2025-05-06
## [27.3.0] - 2025-05-05
### Added
- Added `creator_user_id` to responses of Activities v2 endpoints
- Added `marketing_status` documentation to Persons v2 endpoints
## [27.2.0] - 2025-04-23
## [27.1.0] - 2025-04-22
### Added
- Added option to use `sort_by=due_date` sorting for `GET /api/v2/activities`
- Added option to use `done=true/false` quick filter for `GET /api/v2/activities`
## [27.0.0] - 2025-04-15
## [26.3.0] - 2025-04-07
### Changed
- Deprecated `GET /v1/activities` in favor of `GET /api/v2/activities`
- Deprecated `GET /v1/activities/collection` in favor of `GET /api/v2/activities`
- Deprecated `GET /v1/activities/{id}` in favor of `GET /api/v2/activities/{id}`
- Deprecated `POST /v1/activities` in favor of `POST /api/v2/activities`
- Deprecated `PUT /v1/activities/{id}` in favor of `PATCH /api/v2/activities/{id}`
- Deprecated `DELETE /v1/activities/{id}` in favor of `DELETE /api/v2/activities/{id}`
- Deprecated `DELETE /v1/activities` in favor of `DELETE /api/v2/activities/{id}`
- Deprecated `GET /v1/deals` in favor of `GET /api/v2/deals`
- Deprecated `GET /v1/deals/collection` in favor of `GET /api/v2/deals`
- Deprecated `GET /v1/deals/{id}` in favor of `GET /api/v2/deals/{id}`
- Deprecated `GET /v1/deals/search` in favor of `GET /api/v2/deals/search`
- Deprecated `POST /v1/deals` in favor of `POST /api/v2/deals`
- Deprecated `PUT /v1/deals/{id}` in favor of `PATCH /api/v2/deals`
- Deprecated `DELETE /v1/deals/{id}` in favor of `DELETE /api/v2/deals/{id}`
- Deprecated `DELETE /v1/deals` in favor of `DELETE /api/v2/deals/{id}`
- Deprecated `GET /v1/deals/{id}/activities` in favor of `GET /api/v2/activities?deal_id={id}`
- Deprecated `GET /v1/deals/{id}/persons` in favor of `GET /api/v2/persons?deal_id={id}`
- Deprecated `GET /v1/persons` in favor of `GET /api/v2/persons`
- Deprecated `GET /v1/persons/collection` in favor of `GET /api/v2/persons`
- Deprecated `GET /v1/persons/{id}` in favor of `GET /api/v2/persons/{id}`
- Deprecated `GET /v1/persons/search` in favor of `GET /api/v2/persons/search`
- Deprecated `POST /v1/persons` in favor of `POST /api/v2/persons`
- Deprecated `PUT /v1/persons/{id}` in favor of `PATCH /api/v2/persons/{id}`
- Deprecated `DELETE /v1/persons/{id}` in favor of `DELETE /api/v2/persons/{id}`
- Deprecated `DELETE /v1/persons` in favor of `DELETE /api/v2/persons/{id}`
- Deprecated `GET /v1/persons/{id}/deals` in favor of `GET /api/v2/deals?person_id={id}`
- Deprecated `GET /v1/persons/{id}/activities` in favor of `GET /api/v2/activities?person_id={id}`
- Deprecated `GET /v1/organizations` in favor of `GET /api/v2/organizations`
- Deprecated `GET /v1/organizations/collection` in favor of `GET /api/v2/organizations`
- Deprecated `GET /v1/organizations/{id}` in favor of `GET /api/v2/organizations/{id}`
- Deprecated `GET /v1/organizations/search` in favor of `GET /api/v2/organizations/search`
- Deprecated `POST /v1/organizations` in favor of `POST /api/v2/organizations`
- Deprecated `PUT /v1/organizations/{id}` in favor of `PATCH /api/v2/organizations/{id}`
- Deprecated `DELETE /v1/organizations/{id}` in favor of `DELETE /api/v2/organizations/{id}`
- Deprecated `DELETE /v1/organizations` in favor of `DELETE /api/v2/organizations/{id}`
- Deprecated `GET /v1/organizations/{id}/deals` in favor of `GET /api/v2/deals?org_id={id}`
- Deprecated `GET /v1/organizations/{id}/activities` in favor of `GET /api/v2/activities?org_id={id}`
- Deprecated `GET /v1/organizations/{id}/persons` in favor of `GET /api/v2/persons?org_id={id}`
- Deprecated `GET /v1/products` in favor of `GET /api/v2/products`
- Deprecated `GET /v1/products/{id}` in favor of `GET /api/v2/products/{id}`
- Deprecated `GET /v1/products/search` in favor of `GET /api/v2/products/search`
- Deprecated `POST /v1/products` in favor of `POST /api/v2/products`
- Deprecated `PUT /v1/products/{id}` in favor of `PATCH /api/v2/products/{id}`
- Deprecated `DELETE /v1/products/{id}` in favor of `DELETE /api/v2/products/{id}`
- Deprecated `GET /v1/pipelines` in favor of `GET /api/v2/pipelines`
- Deprecated `GET /v1/pipelines/{id}` in favor of `GET /api/v2/pipelines/{id}`
- Deprecated `POST /v1/pipelines` in favor of `POST /api/v2/pipelines`
- Deprecated `PUT /v1/pipelines/{id}` in favor of `PATCH /api/v2/pipelines/{id}`
- Deprecated `DELETE /v1/pipelines/{id}` in favor of `DELETE /api/v2/pipelines/{id}`
- Deprecated `GET /v1/stages` in favor of `GET /api/v2/stages`
- Deprecated `GET /v1/stages/{id}` in favor of `GET /api/v2/stages/{id}`
- Deprecated `POST /v1/stages` in favor of `POST /api/v2/stages`
- Deprecated `PUT /v1/stages/{id}` in favor of `PATCH /api/v2/stages/{id}`
- Deprecated `DELETE /v1/stages/{id}` in favor of `DELETE /api/v2/stages/{id}`
- Deprecated `DELETE /v1/stages` in favor of `DELETE /api/v2/stages/{id}`
- Deprecated `GET /v1/itemSearch` in favor of `GET /api/v2/itemSearch`
- Deprecated `GET /v1/itemSearch/field` in favor of `GET /api/v2/itemSearch/field`
## [26.2.2] - 2025-04-07
## [26.2.1] - 2025-03-28
### Changed
- Updated `item_price` field data type in products from integer -> number for products and deal products
### Fixed
- Added missing `partnership` value for user access apps list
## [26.2.0] - 2025-03-18
## [26.1.0] - 2025-03-18
### Added
- Notice informing the users of the upcoming Subscriptions API deprecation:
  - `GET /v1/subscriptions/{id}`
  - `GET /v1/subscriptions/find/{dealId}`
  - `GET /v1/subscriptions/{id}/payments`
  - `POST /v1/subscriptions/recurring`
  - `POST /v1/subscriptions/installment`
  - `PUT /v1/subscriptions/recurring/{id}`
  - `PUT /v1/subscriptions/installment/{id}`
  - `PUT /v1/subscriptions/recurring/{id}/cancel`
  - `DELETE /v1/subscriptions/{id}`
## [26.0.0] - 2025-03-17
## [25.2.0] - 2025-03-12
### Added
- Added `GET /v2/deals/installments` endpoint to fetch all installments added to a list of deals with cursor pagination
- Added `POST /v2/deals/{id}/installments` endpoint to add an installment to a deal
- Added `PATCH /v2/deals/{id}/installments/{installment_id}` endpoint to edit an installment
- Added `DELETE /v2/deals/{id}/installments/{installment_id}` endpoint to delete an installment
## [25.1.5] - 2025-03-11
## [25.1.4] - 2025-03-05
### Added
- Added AdditionalData object schema to GetOrganizations and GetPersons data
## [25.1.3] - 2025-02-19
## [25.1.2] - 2025-02-07
### Fixed
- Updated supported enum values for webhook types in the `GET /webhooks` endpoint
## [25.1.1] - 2025-02-04
## [25.1.0] - 2025-01-31
### Added
- Added "pipeline_id" query parameter to GET /api/v1/deals/summary endpoint
## [25.0.0] - 2025-01-27
## [24.0.0] - 2025-01-15
### Changed
- Reduce maximum `limit` query param to 100 for the following endpoints
  - GET v1/files
  - GET v1/deals/{id}/files
  - GET v1/organizations/{id}/files
  - GET v1/persons/{id}/files
  - GET /v1/products/{id}/files
## [23.6.0] - 2024-09-27
## [23.5.0] - 2024-09-24
### Changed
- Added the field "notes" to product prices in the body and response for v1 and v2
- Added the field "overhead_cost" to the product variation prices in the response for v1
- Added the field "direct_cost" to the product variation prices in the response and body for v2
## [23.4.0] - 2024-09-23
## [23.3.8] - 2024-09-10
### Fixed
- Fixed response schemas for GET `/v1/<entity>Fields` requests
## [23.3.7] - 2024-08-27
## [23.3.6] - 2024-08-21
### Fixed
- Added other missing fields to GET /api/v2/deals documentation
## [23.3.5] - 2024-08-05
## [23.3.4] - 2024-08-13
### Fixed
- Added "filter_id" to GET /api/v2/deals documentation
## [23.3.3] - 2024-08-08
## [23.3.1] - 2024-08-01
### Fixed
- Added missing "description" parameter to "Add a product" and "Update a product" endpoints
## [23.3.0] - 2024-07-22
## [23.2.0] - 2024-07-04
### Added
- Deals API v2 documentation
## [23.1.0] - 2024-07-03
## [23.0.0] - 2024-06-11
### Removed
- Removed request and response fields `duration` and `duration_unit` for all endpoints of deals and products using them
## [22.10.1] - 2024-06-07
## [22.10.0] - 2024-06-06
### Added
Added `acv`, `mrr`, `arr`, `acv_currency`, `mrr_currency`, and `arr_currency` to the BaseDeal entity and the following endpoints' response:
- `GET`, `POST` `/v1/deals`
- `GET`, `PUT` `/v1/deals/{id}`
- `GET` `/v1/deals/timeline`
- `PUT` `/v1/deals/{id}/merge`
- `POST` `/v1/deals/{id}/duplicate`
## [22.9.1] - 2024-06-05
## [22.9.0] - 2024-05-29
### Fixed
- Documentation for response models: changed property names to snake_case instead of camelCase
## [22.8.1] - 2024-05-29
## [22.8.0] - 2024-05-28
### Removed
- Removed mention of address autocompletion by Google in Add Activites endpoint and other entities(organization, person, deal) fields.
## [22.7.0] - 2024-05-20
## [22.6.0] - 2024-05-13
### Added
- Added `billing_frequency`, `billing_frequency_cycles` and `billing_start_date` fields to
  - `GET`, `POST` and `PUT` `/v1/deals/{id}/products` endpoints
  - `GET`, `POST` and `PATCH` `/v2/deals/{id}/products` endpoints
  - `GET` `/v2/deals/products` endpoint
- Added `billing_frequency`, `billing_frequency_cycles` fields to
  - `GET`, `POST` and `PUT` `/v1/products` endpoints
  - `GET` `/v1/products/{id}` endpoint
  - `GET`, `POST` and `PATCH` `/v2/products` endpoints
  - `GET` `/v2/products/{id}` endpoints
## [22.5.0] - 2024-04-17
## [22.4.0] - 2024-04-09
### Fixed
- Improved documentation for `/deals/{id}/permittedUsers` endpoint.
## [22.3.0] - 2024-02-14
## [22.2.0] - 2024-01-31
### Added
- Added documentation for new endpoint `/deals/{id}/participantsChangelog`.
## [22.1.4] - 2024-01-05
## [22.1.3] - 2024-01-04
### Added
- Added documentation for `/meetings/userProviderLinks` endpoints
## [22.1.2] - 2023-12-11
## [22.1.1] - 2023-11-14
- Fixed some mismatches of YAML responses in related_objects of some deal endpoints
## [22.1.0] - 2023-10-16
## [22.0.5] - 2023-10-10
- Document `label` parameter for the deal, person, org entities.
## [22.0.4] - 2023-10-05
## [22.0.3] - 2023-09-13
- Fixed incorrect response example for the `GET /deals/search` endpoint
## [22.0.2] - 2023-09-12
## [22.0.1] - 2023-09-12
### Changed
- Added further details on behavior of `end_date` for `PUT /v1/subscriptions/recurring/{id}/cancel`
## [22.0.0] - 2023-08-23
## [21.2.0] - 2023-08-22
### Fixed
- Fixed incorrect parameter descriptions for the `PUT /deals/{id}` endpoint
## [21.1.0] - 2023-06-28
## [21.0.0] - 2023-06-27
### Changed
- Added request and response fields `discount`, `discount_type` and `tax_method` for `GET /deals/{id}/products`, `POST /deals/{id}/products` and `PUT /deals/{id}/products/{product_attachment_id}`
- Deprecated request and response field `discount_percentage` for `GET /deals/{id}/products`, `POST /deals/{id}/products` and `PUT /deals/{id}/products/{product_attachment_id}`
## [20.5.2] - 2023-06-18
## [20.5.1] - 2023-06-12
### Changed
- Added list of searchable custom field types to persons, organizations, products and deals search endpoints descriptions.
## [20.5.0] - 2023-06-17
## [20.4.0] - 2023-06-12
### Changed
Changed `product_id` body parameter to be optional for Update Deal Product endpoint
## [20.3.0] - 2023-06-12
## [20.2.1] - 2023-05-31
### Removed
- `enum` keyword from boolean schema attributes as its possible values are not the string type
## [20.2.0] - 2023-05-31
## [20.1.0] - 2023-05-24
### Added
- Configuration for client-dummy SDK
## [20.0.2] - 2023-05-22
## [20.0.0] - 2023-05-22
### Removed
Based on this [Changelog post](https://developers.pipedrive.com/changelog/post/removal-of-codevariations_enabledcode-response-field-from-codeget-dealsidproductscode):
- Removed `variations_enabled` response field from `GET /deals/{id}/products`
### Added
- Added `revokeToken` function to the sdk. With this function you can revoke an access token or refresh token (mark an app as uninstalled).
## [5.2.1] - 2023-04-12
## [5.2.0] - 2023-03-20
### Added
- Added `GET /activities/collection` endpoint to fetch all activities with cursor pagination
- Added `GET /deals/collection` endpoint to fetch all deals with cursor pagination
## [5.1.0] - 2023-03-16
## [5.0.2] - 2023-03-15
### Added
- Adding pagination parameters documentation for `GET /stages` endpoint.
## [5.0.1] - 2023-02-15
## [5.0.0] - 2023-02-13
### Removed
Based on this [Changelog post](https://developers.pipedrive.com/changelog/post/breaking-changes-in-4-products-related-endpoints):
- Removed non product-related fields from the response of `GET /products/{id}/files`
- Removed `product_attachment_id` response field from `POST /deals/{id}/products` and `DELETE /deals/{id}/products/{product_attachment_id}`
- Removed mistakenly documented pagination fields from `GET /products/{id}/permittedUsers`
- Removed `item_price` and `quantity` as required request fields from `PUT /deals/{id}/products/{product_attachment_id}`
### Changed
Based on this [Changelog post](https://developers.pipedrive.com/changelog/post/breaking-changes-in-4-products-related-endpoints):
- Updated the `sort` query parameter for `GET /products/{id}/files` to only support `id` and `update_time` field keys
- For `PUT /deals/{id}/products/{product_attachment_id}`: parameters `item_price` and `quantity` are not required
### Added
- Added an optional `duration_unit` body parameter for `PUT /deals/{id}/products/{product_attachment_id}` and `POST /deals/{id}/products`
## [4.0.11] - 2023-02-09
## [4.0.10] - 2023-01-31
### Fixed
- Updated `limit` description for `GET /v1/callLogs`
- Updated `activity_id` description for `POST /v1/callLogs`
- Added `next_start` field in the `GET /v1/callLogs` response example
## [4.0.9] - 2023-01-31
## [4.0.8] - 2023-01-24
### Fixed
- Updated `user_id` description for `POST /webhooks/`
### Fixed
- Adds support for snake_case query params reported in pipedrive/client-nodejs#410
## [4.0.7] - 2023-01-12
## [4.0.6] - 2023-01-10
### Changed
- Removed `location_lat` and `location_long` fields from the following endpoints activity details response:
  - GET /v1/activities
  - GET /v1/activities/{id}
  - POST /v1/activities
  - PUT /v1/activities/{id}
## [4.0.5] - 2023-01-04
## [4.0.3] - 2022-12-22
### Fixed
- Fixed a typo in `GET /itemSearch/field`
## [4.0.2] - 2022-12-08
## [4.0.1] - 2022-12-06
### Added
- Optional `lead_id` parameter to `POST /v1/files`
- `lead_id` and `lead_name` to the `/v1/files` endpoints
## [4.0.0] - 2022-11-23
## [3.0.33] - 2022-11-18
### Fixed
- Fixed the documentation of `label` field in the response examples
## [3.0.32] - 2022-11-18
## [3.0.31] - 2022-11-16
### Changed
- Removed mistakenly documented `primary_email` body parameter from `POST /persons` and `PUT /persons/{id}` endpoints.
## [3.0.30] - 2022-11-16
## [3.0.29] - 2022-11-09
### Changed
- Updated names and descriptions:
  - `POST /v1/deals/{id}/products`
  - `PUT /v1/deals/{id}/products/{product_attachment_id}`
### Fixed
- Added missing `product_id` required parameter for `POST /v1/deals/{id}/products`
## [3.0.28] - 2022-11-09
## [3.0.27] - 2022-11-08
### Changed
- Added project support to `GET v1/itemSearch` and `GET v1/itemSearch/field` endpoints
## [3.0.26] - 2022-11-08
## [3.0.25] - 2022-11-07
### Changed
- Updated `conditions` parameter description to explain that date values need to now adhere to YYYY-MM-DD format in `POST /filters` and `PUT /filters/{id}`
- Updated `term` parameter description in all search endpoints to explain that term needs to be URL encoded
## [3.0.24] - 2022-10-25
## [3.0.23] - 2022-10-24
### Changed
- Fixed custom field value (it should return null if the value is null)
## [3.0.22] - 2022-10-17
## [3.0.21] - 2022-10-14
### Changed
- Added `pipeline` and `stage` objects to the `related_objects` section in the following endpoints:
  - `GET /v1/deals`
  - `GET /v1/deals/{id}`
  - `GET /v1/organizations/{id}/deals`
  - `GET /v1/persons/{id}/deals`
  - `GET /v1/products/{id}/deals`
  - `POST /v1/deals`
  - `PUT /v1/deals/{id}`
## [3.0.20] - 2022-10-12
## [3.0.19] - 2022-10-11
### Changed
- Removed query `include_deleted_files` parameter for these endpoints based on this [post](https://developers.pipedrive.com/changelog/post/permanent-deletion-logic-for-6-core-entities)
  - `GET /files`
  - `GET /deals/{id}/files`
  - `GET /organizations/{id}/files`
  - `GET /persons/{id}/files`
  - `GET /products/{id}/files`
## [3.0.18] - 2022-10-05
## [3.0.17] - 2022-09-30
### Removed
- Removed deprecated endpoints that will be deleted:
  - `POST /users/{id}/roleAssignments`
  - `DELETE /users/{id}/roleAssignments`
## [3.0.16] - 2022-09-29
## [3.0.15] - 2022-09-27
### Changed
- Changed the content type to `application/json` in the following endpoints:
  - `DELETE /roles/{id}/assignments`
  - `POST /roles/{id}/settings`
  - `PUT /roles/{id}`
  - `POST /roles`
  - `POST /roles/{id}/assignments`
  - `PUT /users/{id}`
## [3.0.14] - 2022-09-23
## [3.0.13] - 2022-09-12
### Changed
- Changed `PUT /goals/{id}` content type to `application/json`
## [3.0.12] - 2022-09-09
## [3.0.11] - 2022-09-02
### Removed
- Removed deprecated endpoints that were deleted:
  - `GET /globalMessages`
  - `DELETE /globalMessages/{id}`
## [3.0.10] - 2022-08-30
## [3.0.9] - 2022-08-26
### Changed
- Changed `POST /v1/users` request body type from `application/x-www-form-urlencoded` to `application/json`
- Extracted `UserAccess` schema for defining the `access` property in `BaseUser` schema and in `POST /v1/users` endpoint
## [3.0.8] - 2022-08-15
## [3.0.7] - 2022-08-09
### Changed
- Description for `GET/v1/filters/helpers` endpoint
## [3.0.6] - 2022-08-08
## [3.0.5] - 2022-08-03
### Changed
- Added deprecated flags to `POST /users/{id}/roleAssignments` and `DELETE /users/{id}/roleAssignments`
## [3.0.4] - 2022-07-27
## [3.0.3] - 2022-07-18
### Changed
- Description for api/v1/channels endpoints
## [3.0.2] - 2022-07-22
## [3.0.1] - 2022-06-28
### Added
- Added restriction of maximum 16 conditions per filter.
### Changed
- Removed support for `NOT LIKE '%$%': does not contain, LIKE '%$': ends with, NOT LIKE '%$': does not end with` varchar and title filter conditions.
## [3.0.0] - 2022-06-22
## [2.0.4] - 2022-06-21
### Changed
- Added deprecated flags to `GET /globalMessages` and `DELETE /globalMessages/{id}`
## [2.0.3] - 2022-06-20
## [2.0.2] - 2022-06-07
### Added
- Added `primary_email` field to response of `GET /v1/persons`, `GET /v1/persons/{id}` endpoints
## [2.0.1] - 2022-05-31
## [2.0.0] - 2022-05-23
### Fixed
- Renamed file with long name and it's class.
Old name:
AnyOfRecentsActivityRecentsActivityTypeRecentsDealRecentsFileRecentsFilterRecentsNoteRecentsPersonRecentsOrganizationRecentsPipelineRecentsProductRecentsStageRecentsUser
New name:
AnyOfRecents
## [1.0.1] - 2022-05-10
## [1.0.0] - 2022-05-09
### Changed
- Moved `v1/teams*` endpoints to `v1/legacyTeams*` as they're being deprecated because we are preparing for an upgraded version of the Teams API, which requires migrating the current functionality to a new path URL `v1/legacyTeams*`.
  The functionality and [OAuth scopes](https://pipedrive.readme.io/docs/marketplace-scopes-and-permissions-explanations) of all the Teams API endpoints will remain the same.
## [0.2.75] - 2022-05-04
## [0.2.74] - 2022-05-03
### Changed
- Updated `PUT /productFields/{id}`: parameter `name` is not
## [0.2.73] - 2022-05-04
## [0.2.72] - 2022-04-26
### Changed
- Moved some dependencies to devDependencies
## [0.2.71] - 2022-04-25
## [0.2.70] - 2022-04-25
### Changed
- Changed `visible_to` parameter data type to `string` for POST `/deals`, PUT `/deals/{id}`, POST `/persons`, PUT `/persons/{id}`, POST `/organizations` and PUT `/organizations/{id}` endpoints
## [0.2.69] - 2022-04-20
## [0.2.68] - 2022-04-14
### Changed
- Added Tutorials submenu item
## [0.2.67] - 2022-04-08
## [0.2.66] - 2022-03-21
## Added
- Added `GET /billing/subscriptions/addons` endpoint
## [0.2.65] - 2022-03-16
## [0.2.64] - 2022-03-15
### Fixed
- Changed rotten_flag type to boolean in `StagesApi`
## [0.2.63] - 2022-03-14
## [0.2.62] - 2022-03-03
## Changed
- Added `everyone` parameter to `GET /v1/stages/{id}` endpoint
- Updated `/v1/deals` endpoint `stage_id` and added `pipeline_id` descriptions
## [0.2.61] - 2022-02-28
## [0.2.60] - 2022-02-25
## Changed
- Remove temporary `GET /leads/search` endpoint
## [0.2.59] - 2022-02-25
## [0.2.58] - 2022-02-22
### Added
- Add `GET /leads/search` endpoint
- Add `sort` to `GET /leads` query parameters
- Add `owner_id` to `GET /leads` query parameters
- Add `filter_id` to `GET /leads` query parameters
- Add `lead_id` to `POST/PUT /activity` query parameters
- Add `leads` as a new type in `/filters` query parameters
## Changed
- Updated `visible_to` parameter for `PATCH /deals/{id}` to include type `number`
## [0.2.57] - 2022-02-18
## [0.2.56] - 2022-02-07
## Fixed
- Added quotation marks to fix formatting for Organizations endpoint `visible_to` parameter
- Updated `prices` parameter description in Products endpoint
## [0.2.55] - 2022-02-07
## [0.2.54] - 2022-02-03
### Changed
- Update `visible_to` parameter for `POST /deals` and `PUT /deals/{id}`. Differentiate options by plans
- Update `visible_to` parameter for `POST /persons` and `PUT /persons/{id}`. Differentiate options by plans
- Update `visible_to` parameter for `POST /organizations` and `PUT /organizations/{id}`. Differentiate options by plans
## [0.2.54] - 2022-02-03
## [0.2.53] - 2022-02-03
## Added
- Added new pill type for format. Removed capitalization from pill and add it to property and required types.
## [0.2.52] - 2022-02-01
## [0.2.51] - 2022-01-28
### Changed
- Deprecate /v1/mailbox/mailMessages/{id} & /v1/mailbox/mailThreads/{id} response data property write_flag
### Fixed
- Fix replaceCamelCaseObj is not defined reference issue in ApiClient
## [0.2.50] - 2022-01-25
## [0.2.49] - 2022-01-24
### Changed
- Changed person-related endpoints to include `marketing_status` body parameter: `POST /v1/persons`, `PUT /v1/persons/{id}`
## [0.2.48] - 2022-01-20
## [0.2.47] - 2022-01-20
### Fixed
- Fixed capitalization, punctuation, grammar, articles in all endpoint descriptions
## [0.2.46] - 2022-01-20
## [0.2.45] - 2022-01-07
### Added
- Added leadField to field_type options for `GET /v1/itemSearch/field`
## [0.2.44] - 2022-01-05
## [0.2.43] - 2022-01-03
### Fixed
- Fix incorrect HTTP response codes in API Reference for `POST /organizations`, `POST /persons` and `POST /deals`
## [0.2.42] - 2021-12-30
## [0.2.41] - 2021-12-20
### Added
- Added `tax` parameter on add product to the deal.
- POST /v1/deals/{id}/products
- PUT /v1/deals/{id}/products/{product_attachment_id}
- Improved `follower_id` description
- DELETE /v1/products/{id}/followers/{follower_id}
## [0.2.40] - 2021-12-20
## [0.2.39] - 2021-12-15
### Added
- Added that leads can be searched by `custom_fields` and `notes`
## [0.2.38] - 2021-12-13
## [0.2.37] - 2021-12-13
### Changed
- Changed `addActivity` POST endpoint response example code from `200` to `201`.
## [0.2.36] - 2021-01-07
## [0.2.36] - 2021-01-02
### Changed
- Changed/improve Products `visible_to` type, and differentiate options by plans
- POST /products
- PUT /products/{id}
## [0.2.35] - 2021-12-01
## [0.2.34] - 2021-11-30
### Changed
- Changed Organization `custom_fields` type to a string array
## [0.2.33] - 2021-11-26
## [0.1.34] - 2021-11-24
### Changed
- changed model fields to snake_case in SDK markdown files
## [0.1.34] - 2021-11-22
## [0.1.33] - 2021-11-24
### Fixed
- Fixed typo in `ids` query parameter description in GET /products
## [0.1.32] - 2021-11-22
## [0.1.31] - 2021-11-22
### Fixed
- Fixed the response examples for webhooks examples
## [0.1.30] - 2021-11-19
## [0.1.29] - 2021-11-17
### Added
- Added `filter_id` to `GET /products` query parameters that was wrongfully removed in 0.1.18
## [0.1.28] - 2021-11-12
## [0.1.27] - 2021-10-21
### Changed
- Changed notes and comments endpoints additional_data to match the correct pagination response
  structure
- GET /notes
- GET /notes/:id/comments
## [0.1.26] - 2021-10-18
## [0.1.25] - 2021-10-07
### Changed
- Changed addDeal POST endpoint to include required person_id or org_id
## [0.1.24] - 2021-10-06
## [0.1.23] - 2021-10-04
### Changed
- Changed POST/PUT for endpoints to accept `application/json` instead of `application/x-www-form-urlencoded`
- Added required fields to the OrganizationRelationship and Notes POST endpoints
# [0.1.22] - 2021-10-05
### Fixed
- Fixed GET /goals/:id/results `period.start` parameter description with specified possible dates
- Fixed GET /goals/:id/results `period.end` parameter description with specified possible dates
- Fixed `GET /goal/:id/results` error handling in cases when period.start or period.end dates are out of possible range
- Fixed `GET /goal/:id/results` error handling in case when there are no existing stages connected to specified goal
## [0.1.21] - 2021-10-04
## [0.1.20] - 2021-09-29
### Changed
- Changed POST /v1/webhooks to accept `application/json` instead of `application/x-www-form-urlencoded` to reflect the reality
## [0.1.19] - 2021-08-30
## [0.1.18] - 2021-08-03
### Added
- Changed `GET /products/{id}/followers` response schema so that `data` property is a ProductFollower object instead of an array of User IDs
- Remove duplicate `name` parameter from `POST /productFields` body parameters
- Remove duplicate `options` parameter from `POST /productFields` body parameters and corrected the related example
- Changed `POST /productFields` response status code from 200 (OK) to 201 (Created)
- Changed `POST /products/{id}/followers` response status code from 200 (OK) to 201 (Created)
- Changed `POST /products` response status code from 200 (OK) to 201 (Created)
- Removed `filter_id` from `GET /products` query parameters since it's not used
- Added `ids` to `GET /products` query parameters
## [0.1.17] - 2021-07-28
## [0.1.16] - 2021-07-28
### Added
- added required flag for name in `POST /dealFields, /personFields and /organizationFields` endpoints documentation
## [0.1.15] - 2021-07-26
## [0.1.14] - 2021-07-23
### Fixed
- changed `user_id` parameter from query parameter to body parameter in the request that deletes an assignment from a role
## [0.1.13] - 2021-07-26
## [0.1.12] - 2021-07-26
### Changed
- Fixed POST /v1/goals `interval` field description
- Changed POST /v1/goals to accept `application/json` instead of `application/x-www-form-urlencoded` to reflect the reality
## [0.1.11] - 2021-06-25
## [0.1.10] - 2021-07-14
### Fixed
- changed `role_id` parameter from query parameter to body parameter in the request that deletes a role assignment for a user
## [0.1.9] - 2021-07-14
## [0.1.8] - 2021-07-09
### Added
- added required flag for pipeline name in `POST /pipelines` endpoint documentation
## [0.1.7] - 2021-05-03
## [0.1.6] - 2021-06-27
### Changed
- Updated `MailThreadPut` schema to represent `object` in response instead of an `array`
- Updated description for `MailThreadOne`
## [0.1.5] - 2021-06-27
## [0.1.4] - 2021-06-09
### Added
- `UpdateProductResponse` for `PUT /products/{id}`
### Changed
- Split `Product` schema into `BaseProduct` and `ProductWithArrayPrices` or `ProductWithObjectPrices` to represent `prices` property with `array` type and `object` type respectively
- Use the new `ProductWithObjectPrices` in `UpdateProductResponse`
## [0.1.3] - 2021-06-09
## [0.1.2] - 2021-06-09
### Changed
- Extended `DELETE /calllogs/{id}` security with `api_key` property.
- Extended `POST /callLogs/{id}/recordings` security with `api_key` property.
##  [0.1.1] - 2021-06-02
### Changed
- Extended `GET /v1/roles/{id}/settings` response with `lead_default_visibility` property.
- Extended `POST /v1/roles/{id}/settings` request payload with `lead_default_visibility` property.
## [0.1.0] - 2021-04-22
## [0.0.4] - 2021-02-16
### Added
- Add note field to call logs.
## [0.0.3] - 2021-01-11
## [0.0.2] - 2021-01-11
### Changed
- Changed the changelog file to test the SDK generation automation

## [11.0.0](https://github.com/pipedrive/client-php/compare/10.0.0...11.0.0) (2025-05-09)

### Changed
- **BREAKING CHANGE.** The API token is sent in the `x-api-token` header instead of `api_token` query parameter.
The API key configuration must be updated as follows:
```php
// previous versions
$config = (new Pipedrive\versions\v1\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// starting from this version
$config = (new Pipedrive\versions\v1\Configuration())->setApiKey('x-api-token', 'YOUR_API_KEY');
```

## [10.0.0](https://github.com/pipedrive/client-php/compare/9.0.0...10.0.0) (2025-05-06)

### Fixed
- Fixed the OAuth scope of "Add a follower to a product" endpoint in API v2
### Added
- Added `creator_user_id` to responses of Activities v2 endpoints
- Added `marketing_status` documentation to Persons v2 endpoints
- Added archived deals/leads endpoints:
  - `GET /v1/deals/archived`
  - `GET /v2/deals/archived`
  - `GET /v1/deals/timeline/archived`
  - `GET /v1/deals/summary/archived`
  - `GET /v1/leads/archived`
- Added `is_archived` and `archive_time` properties to deals endpoints response
- Added option to use `sort_by=due_date` sorting for `GET /api/v2/activities`
- Added option to use `done=true/false` quick filter for `GET /api/v2/activities`
- Added `project_id` and `pinned_to_project_flag` query parameter to the GET `/notes` endpoint
- Added `project_id` and `pinned_to_project_flag` request bodies to the POST/PUT `/notes` endpoint
- Added `project_id` and `pinned_to_project_flag` to success responses of GET/POST/PUT
### Changed
- Deprecated `GET /v1/activities` in favor of `GET /api/v2/activities`
- Deprecated `GET /v1/activities/collection` in favor of `GET /api/v2/activities`
- Deprecated `GET /v1/activities/{id}` in favor of `GET /api/v2/activities/{id}`
- Deprecated `POST /v1/activities` in favor of `POST /api/v2/activities`
- Deprecated `PUT /v1/activities/{id}` in favor of `PATCH /api/v2/activities/{id}`
- Deprecated `DELETE /v1/activities/{id}` in favor of `DELETE /api/v2/activities/{id}`
- Deprecated `DELETE /v1/activities` in favor of `DELETE /api/v2/activities/{id}`
- Deprecated `GET /v1/deals` in favor of `GET /api/v2/deals`
- Deprecated `GET /v1/deals/collection` in favor of `GET /api/v2/deals`
- Deprecated `GET /v1/deals/{id}` in favor of `GET /api/v2/deals/{id}`
- Deprecated `GET /v1/deals/search` in favor of `GET /api/v2/deals/search`
- Deprecated `POST /v1/deals` in favor of `POST /api/v2/deals`
- Deprecated `PUT /v1/deals/{id}` in favor of `PATCH /api/v2/deals`
- Deprecated `DELETE /v1/deals/{id}` in favor of `DELETE /api/v2/deals/{id}`
- Deprecated `DELETE /v1/deals` in favor of `DELETE /api/v2/deals/{id}`
- Deprecated `GET /v1/deals/{id}/activities` in favor of `GET /api/v2/activities?deal_id={id}`
- Deprecated `GET /v1/deals/{id}/persons` in favor of `GET /api/v2/persons?deal_id={id}`
- Deprecated `GET /v1/persons` in favor of `GET /api/v2/persons`
- Deprecated `GET /v1/persons/collection` in favor of `GET /api/v2/persons`
- Deprecated `GET /v1/persons/{id}` in favor of `GET /api/v2/persons/{id}`
- Deprecated `GET /v1/persons/search` in favor of `GET /api/v2/persons/search`
- Deprecated `POST /v1/persons` in favor of `POST /api/v2/persons`
- Deprecated `PUT /v1/persons/{id}` in favor of `PATCH /api/v2/persons/{id}`
- Deprecated `DELETE /v1/persons/{id}` in favor of `DELETE /api/v2/persons/{id}`
- Deprecated `DELETE /v1/persons` in favor of `DELETE /api/v2/persons/{id}`
- Deprecated `GET /v1/persons/{id}/deals` in favor of `GET /api/v2/deals?person_id={id}`
- Deprecated `GET /v1/persons/{id}/activities` in favor of `GET /api/v2/activities?person_id={id}`
- Deprecated `GET /v1/organizations` in favor of `GET /api/v2/organizations`
- Deprecated `GET /v1/organizations/collection` in favor of `GET /api/v2/organizations`
- Deprecated `GET /v1/organizations/{id}` in favor of `GET /api/v2/organizations/{id}`
- Deprecated `GET /v1/organizations/search` in favor of `GET /api/v2/organizations/search`
- Deprecated `POST /v1/organizations` in favor of `POST /api/v2/organizations`
- Deprecated `PUT /v1/organizations/{id}` in favor of `PATCH /api/v2/organizations/{id}`
- Deprecated `DELETE /v1/organizations/{id}` in favor of `DELETE /api/v2/organizations/{id}`
- Deprecated `DELETE /v1/organizations` in favor of `DELETE /api/v2/organizations/{id}`
- Deprecated `GET /v1/organizations/{id}/deals` in favor of `GET /api/v2/deals?org_id={id}`
- Deprecated `GET /v1/organizations/{id}/activities` in favor of `GET /api/v2/activities?org_id={id}`
- Deprecated `GET /v1/organizations/{id}/persons` in favor of `GET /api/v2/persons?org_id={id}`
- Deprecated `GET /v1/products` in favor of `GET /api/v2/products`
- Deprecated `GET /v1/products/{id}` in favor of `GET /api/v2/products/{id}`
- Deprecated `GET /v1/products/search` in favor of `GET /api/v2/products/search`
- Deprecated `POST /v1/products` in favor of `POST /api/v2/products`
- Deprecated `PUT /v1/products/{id}` in favor of `PATCH /api/v2/products/{id}`
- Deprecated `DELETE /v1/products/{id}` in favor of `DELETE /api/v2/products/{id}`
- Deprecated `GET /v1/pipelines` in favor of `GET /api/v2/pipelines`
- Deprecated `GET /v1/pipelines/{id}` in favor of `GET /api/v2/pipelines/{id}`
- Deprecated `POST /v1/pipelines` in favor of `POST /api/v2/pipelines`
- Deprecated `PUT /v1/pipelines/{id}` in favor of `PATCH /api/v2/pipelines/{id}`
- Deprecated `DELETE /v1/pipelines/{id}` in favor of `DELETE /api/v2/pipelines/{id}`
- Deprecated `GET /v1/stages` in favor of `GET /api/v2/stages`
- Deprecated `GET /v1/stages/{id}` in favor of `GET /api/v2/stages/{id}`
- Deprecated `POST /v1/stages` in favor of `POST /api/v2/stages`
- Deprecated `PUT /v1/stages/{id}` in favor of `PATCH /api/v2/stages/{id}`
- Deprecated `DELETE /v1/stages/{id}` in favor of `DELETE /api/v2/stages/{id}`
- Deprecated `DELETE /v1/stages` in favor of `DELETE /api/v2/stages/{id}`
- Deprecated `GET /v1/itemSearch` in favor of `GET /api/v2/itemSearch`
- Deprecated `GET /v1/itemSearch/field` in favor of `GET /api/v2/itemSearch/field`
- Updated non archived deals/leads endpoint description to specify that following endpoints do not return archived items:
  - `GET /v1/deals`
  - `GET /v2/deals`
  - `GET /v1/deals/timeline`
  - `GET /v1/deals/summary`
  - `GET /v1/leads`
- Removed deprecated `archived_status` query parameter from leads endpoints

[9.0.0](https://github.com/pipedrive/client-php/compare/8.1.5...9.0.0) (2025-03-31)

### Changed
- Updated `item_price` field data type in products from integer -> number for products and deal products

### Fixed
- Added missing `partnership` value for user access apps list

### Added
- Notice informing the users of the upcoming Subscriptions API deprecation:
  - `GET /v1/subscriptions/{id}`
  - `GET /v1/subscriptions/find/{dealId}`
  - `GET /v1/subscriptions/{id}/payments`
  - `POST /v1/subscriptions/recurring`
  - `POST /v1/subscriptions/installment`
  - `PUT /v1/subscriptions/recurring/{id}`
  - `PUT /v1/subscriptions/installment/{id}`
  - `PUT /v1/subscriptions/recurring/{id}/cancel`
  - `DELETE /v1/subscriptions/{id}`

### Changed
- Updated Webhooks endpoints to v2, including available event_action and event_object properties

### Added
- Added `GET /v2/deals/installments` endpoint to fetch all installments added to a list of deals with cursor pagination
- Added `POST /v2/deals/{id}/installments` endpoint to add an installment to a deal
- Added `PATCH /v2/deals/{id}/installments/{installment_id}` endpoint to edit an installment
- Added `DELETE /v2/deals/{id}/installments/{installment_id}` endpoint to delete an installment

[8.1.5](https://github.com/pipedrive/client-php/compare/8.1.4...8.1.5) (2025-03-17)

### Added
- Added deal_id, person_id, org_id and lead_id quick filters for GET /api/v2/activities endpoint.
- Added AdditionalData to the v2 schemas:
  - deal
  - stage
  - pipeline
  - activity

## [8.1.4](https://github.com/pipedrive/client-php/compare/8.1.3...8.1.4) (2025-03-11)

### Added
-  Added AdditionalData object schema to GetOrganizations and GetPersons data

## [8.1.3](https://github.com/pipedrive/client-php/compare/8.1.2...8.1.3) (2025-03-05)

### Fixed
-  Fixed AdditionalData object schema

## [8.1.2](https://github.com/pipedrive/client-php/compare/8.0.1...8.1.2) (2025-02-10)

### Fixed
- Updated supported enum values for webhook types in the `GET /webhooks` endpoint

## [8.1.0](https://github.com/pipedrive/client-php/compare/8.0.0...8.1.0) (2025-02-06)

### Added

- Added “pipeline_id” query parameter to GET /api/v1/deals/summary endpoint

### Changed

- Updated list of lead label colors to include 'brown', 'dark-gray', 'orange', 'pink'

## [8.0.0](https://github.com/pipedrive/client-php/compare/7.1.0...8.0.0) (2025-01-30)

### Added

- Added compatibility for both API v1 and v2 endpoints. See migration guide for more details
- Add documentation for installments functionality:
  - `POST` `/v1/deals/{id}/products` endpoint
  - `PUT` `/v1/deals/{id}/products/{product_attachment_id}` endpoint
  - `DELETE` `/v1/deals/{id}/products/{product_attachment_id}` endpoint
  - `POST` `/v2/deals/{id}/products` endpoint
  - `PATCH` `/v2/deals/{id}/products/{product_attachment_id}` endpoint
  - `DELETE` `/v2/deals/{id}/products/{product_attachment_id}` endpoint
- Added the field “notes” to product prices in the body and response for v1 and v2
- Added the field “overhead_cost” to the product variation prices in the response for v1
- Added the field “direct_cost” to the product variation prices in the response and body for v2
- Add "custom_fields" query paremeter to GET /api/v2/products

### Changed

- Reduce maximum `limit` query param to 100 for the following endpoints
  - GET v1/files
  - GET v1/deals/{id}/files
  - GET v1/organizations/{id}/files
  - GET v1/persons/{id}/files
  - GET /v1/products/{id}/files

## [7.1.0](https://github.com/pipedrive/client-php/compare/7.0.0...7.1.0) (2024-09-12)

### Added
- Added `notes` field to Prices in:
  - `GET` and `POST` `/v2/products/{productId}/variations` endpoints
  - `PATCH` `/api/v2/products/{productId}/variations/{productVariationId}` endpoint
- Notice informing the users of the upcoming Activity Invites feature deprecation:
  - `POST` and `PUT` `/v1/activities` endpoints

### Fixed
- Fixed response schemas for GET `/v1/<entity>Fields` requests
- Added missing "description" parameter to "Add a product" and "Update a product" endpoints
- Added the missing "label_ids" field to the contacts endpoints.
- Added "filter_id" to GET /api/v2/deals documentation
- Updated default values for "billing_frequency_cycles", "billing_start_date" fields

## [7.0.0](https://github.com/pipedrive/client-php/compare/6.10.1...7.0.0) (2024-09-11)


### BREAKING CHANGE
- Removed request and response fields `duration` and `duration_unit` for all endpoints of deals and products using them

## [6.10.1](https://github.com/pipedrive/client-php/compare/6.10.0...6.10.1) (2024-06-07)

### Removed
- Cleanup unused company settings

## [6.10.0](https://github.com/pipedrive/client-php/compare/6.9.0...6.10.0) (2024-06-07)

### Added
Added `acv`, `mrr`, `arr`, `acv_currency`, `mrr_currency`, and `arr_currency` to the BaseDeal entity and the following endpoints' response:
- `GET`, `POST` `/v1/deals`
- `GET`, `PUT` `/v1/deals/{id}`
- `GET` `/v1/deals/timeline`
- `PUT` `/v1/deals/{id}/merge`
- `POST` `/v1/deals/{id}/duplicate`

## [6.9.0](https://github.com/pipedrive/client-php/compare/6.8.1...6.9.0) (2024-05-30)

### Fixed
- Fixed documentation: property `value` of Lead is nullable.

## [6.8.1](https://github.com/pipedrive/client-php/compare/6.8.0...6.8.1) (2024-05-29)

### Removed
- Removed mention of address autocompletion by Google in Add Activities endpoint and other entities(organization, person, deal) fields.

## [6.8.0](https://github.com/pipedrive/client-php/compare/6.7.0...6.8.0) (2024-05-22)

### Added
- Added `origin`, `origin_id`, `channel` and `channel_id` parameters representing the Source for Lead and Deal entity.

## [6.7.0](https://github.com/pipedrive/client-php/compare/6.6.0...6.7.0) (2024-05-17)

### Added

- Added documentation for new endpoints `/deals/{id}/changelog`, `/persons/{id}/changelog` and `/organizations/{id}/changelog`.
- Added `is_deleted` parameter for `/v1/users/*` responses.
- Added `billing_frequency`, `billing_frequency_cycles` and `billing_start_date` fields to
  - `GET`, `POST` and `PUT` `/v1/deals/{id}/products` endpoints
  - `GET`, `POST` and `PATCH` `/v2/deals/{id}/products` endpoints
  - `GET` `/v2/deals/products` endpoint
- Added `billing_frequency`, `billing_frequency_cycles` fields to
  - `GET`, `POST` and `PUT` `/v1/products` endpoints
  - `GET` `/v1/products/{id}` endpoint
  - `GET`, `POST` and `PATCH` `/v2/products` endpoints
  - `GET` `/v2/products/{id}` endpoints
- Added RawData trait to models to allow access to all response data objects

## [6.6.0](https://github.com/pipedrive/client-php/compare/6.5.1...6.6.0) (2024-04-02)

### Added
- Documentation for new endpoint `/deals/{id}/participantsChangelog`

## [6.5.1](https://github.com/pipedrive/client-php/compare/6.5.0...6.5.1) (2024-04-02)

### Added
- `won_time`, `lost_time` and `close_time` parameters for the `POST /v1/deals` and `PUT /v1/deals/{id}` endpoints

## [6.5.0](https://github.com/pipedrive/client-php/compare/6.4.0...6.5.0) (2024-04-02)

### Added
- Documentation for `/meetings/userProviderLinks` endpoints

## [6.4.0](https://github.com/pipedrive/client-php/compare/6.3.1...6.4.0) (2024-04-02)

### Added
- `lead_id` as an acceptable body parameter for the `POST /v1/callLogs` endpoint

## [6.3.1](https://github.com/pipedrive/client-php/compare/6.3.0...6.3.1) (2024-04-02)

### Fixed
- Mismatches of YAML responses in related_objects of some deal endpoints

## [6.3.0](https://github.com/pipedrive/client-php/compare/6.2.0...6.3.0) (2023-10-16)

- Add `Projects`, `ProjectTemplates` and `Tasks` public routes.

## [6.2.0](https://github.com/pipedrive/client-php/compare/6.1.3...6.2.0) (2023-10-11)

### Added
- Document `label` parameter for the deal, person, org entities.

## [6.1.3](https://github.com/pipedrive/client-php/compare/6.1.2...6.1.3) (2023-10-06)

### Fixed
- Incorrect type of `options` for the `POST and PUT /dealFields, /personFields and /organizationFields` endpoints

## [6.1.2](https://github.com/pipedrive/client-php/compare/6.1.1...6.1.2) (2023-09-12)

### Fixed
- Fixed incorrect response schema for the `GET /deals/{id}/products` endpoint

## [6.1.1](https://github.com/pipedrive/client-php/compare/6.1.0...6.1.1) (2023-09-12)

### Changed
- Added further details on behavior of `end_date` for `PUT /v1/subscriptions/recurring/{id}/cancel`

## [6.1.0](https://github.com/pipedrive/client-php/compare/6.0.0...6.1.0) (2023-09-05)

### Fixed

- Resolved namespace issues in `$openAPITypes` for `ProductAttachmentDetails`, `AddProductAttachmentDetails`, `BaseMailThread`, and `FieldTypeAsString` (#91) models

## [6.0.0](https://github.com/pipedrive/client-php/compare/5.1.0...6.0.0) (2023-08-30)

### Removed

- Removed request and response fields `sum_no_discount` for `GET /deals/{id}/products`, `POST /deals/{id}/products` and `PUT /deals/{id}/products/{product_attachment_id}`

## [5.1.0](https://github.com/pipedrive/client-php/compare/5.0.0...5.1.0) (2023-08-30)

### Fixed
- Fixed incorrect parameter descriptions for the `PUT /deals/{id}` endpoint

## [5.0.0](https://github.com/pipedrive/client-php/compare/5.0.0-beta.1...5.0.0) (2023-08-16)

Release a stable version of 5.0.0 which is a complete rewrite of the client-php.
With version 5 of the SDK, we have moved to an open-source SDK generator called [OpenAPI Generator](https://openapi-generator.tech/).

## [5.0.0-beta.1](https://github.com/pipedrive/client-php/compare/5.0.0-beta.0...5.0.0-beta.1) (2023-07-24)

### Changed
- Added list of searchable custom field types to persons, organizations, products and deals search endpoints descriptions.
- Changed `product_id` body parameter to be optional for Update Deal Product endpoint
- Schemas for `call-logs` as they only included `base-response` without additional properties in the response schema

## [5.0.0-beta.0](https://github.com/pipedrive/client-php/compare/4.0.10...5.0.0-beta.0) (2023-06-14)

### Changed
- Breaking switch to SDK generated with [openapi-generator](https://openapi-generator.tech/)
