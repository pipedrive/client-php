# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Added
- Documented new `track_open` and `track_click` fields on the Person object

## [19.2.1](https://github.com/pipedrive/client-php/compare/19.2.0...19.2.1) (2026-11-06)
### Fixed
- Corrected the `is_deleted` field in the request body of `PATCH /api/v2/deals/{id}`
  - `deal-fields:full` - Allows applications to create, read, update and delete deal fields

## [19.2.0](https://github.com/pipedrive/client-php/compare/19.1.0...19.2.0) (2026-11-06)
### Added
- Added optional `channel` and `channel_id` fields to the request bodies of `POST /api/v2/deals`
  - `deal-fields:full` - Allows applications to create, read, update and delete deal fields
