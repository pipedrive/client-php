# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

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
