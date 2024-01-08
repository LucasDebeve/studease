# Studease

## Description
Studease is a web application realized in Academic Project at the IUT of Reims. It allows students to find an internship.
Students can apply for multiples interships offered by various companies. Companies propose interships
and can review students applications to accept or refuse them for each intership.

## Authors
- [COUDROT Axel](https://iut-info.univ-reims.fr/gitlab/coud0011/)
- [DEBEVE Lucas](https://iut-info.univ-reims.fr/gitlab/debe0033/)
- [EULLAFROY Nathan](https://iut-info.univ-reims.fr/gitlab/eull0004/)
- [JACQUEMAIN Paco](https://iut-info.univ-reims.fr/gitlab/jacq0223/)
- [PINGUARD Justin](https://iut-info.univ-reims.fr/gitlab/ping0010/)

## Installation / Configuration
### Requirements
- [Symfony](https://symfony.com/download) (v6.3)
- [Composer](https://getcomposer.org/download/)

### Installation
1. Clone the repository
```bash
git clone https://iut-info.univ-reims.fr/gitlab/coud0011/studease.git
```
2. Install dependencies
```bash
composer install
```

## Usage
### Start the server
```bash
composer run start
```

### Load the database
```bash
composer run db
```

## Tests

### [PHP CS Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer)
#### Show errors
```bash
composer run test:cs
```

#### Fix errors
```bash
composer run fix:cs
```

### [Codeception](https://github.com/codeception/codeception)
#### Run tests
```bash
composer run test:codeception
```

### Others
#### Run all tests
```bash
composer run test
```