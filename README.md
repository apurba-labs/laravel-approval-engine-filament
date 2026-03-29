# Laravel Approval Engine - Filament Plugin

[![Latest Version on Packagist](https://img.shields.io)](https://packagist.org)
[![Total Downloads](https://img.shields.io)](https://packagist.org)
[![License](https://img.shields.io)](LICENSE.md)

An enterprise-grade Filament PHP admin interface for the [Laravel Approval Engine](https://github.com/apurba-labs/laravel-approval-engine). Manage complex workflows, dynamic form schemas, and SLA metrics directly from your Filament dashboard.

## Features

- **Workflow Builder**: Manage modules and multi-stage approval sequences.
- **Dynamic Forms**: Configure JSON-based form schemas for different request types (Expenses, Requisitions, etc.).
- **SLA Monitoring**: Visual tracking of assigned, due, and completed timestamps.
- **Rule Management**: Set up conditional logic (operators, values, priorities) for automated routing.
- **Notification Batches**: Overview of pending, sent, and failed notifications.

## Installation

You can install the package via composer:

```bash
composer require apurba-labs/laravel-approval-engine-filament
