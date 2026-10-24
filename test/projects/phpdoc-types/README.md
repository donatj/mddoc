# Class: Example\ModernTypes

A source file that uses modern PHPDoc types.

```php
<?php
namespace Example;

class ModernTypes {
	/**
	 * @var array{label: string,callback: callable(string|int): bool}
	 */
	public $shape;
}
```

## Magic Method: ModernTypes::find

```php
function find(callable(string|int): bool $filter): array<string,int>
```

Finds matching values.

---

## Magic Method: ModernTypes::multiLineMagicSignature

```php
function multiLineMagicSignature(
	\DateTimeImmutable $createdAt,
	\DateTimeImmutable $updatedAt,
	\DateTimeImmutable $publishedAt,
	\DateTimeImmutable $archivedAt,
): \DateTimeImmutable
```

---

## Magic Method: ModernTypes::multiLineCallableMagicSignature

```php
function multiLineCallableMagicSignature(
	callable(string,int): bool $filter,
	\DateTimeImmutable $createdAt,
	\DateTimeImmutable $updatedAt,
	\DateTimeImmutable $publishedAt,
): \DateTimeImmutable
```

## Method: ModernTypes->process

```php
function process($names, $filter, $formatter)
```

Process values with a callback.

### Parameters

- ***string[]*** `$names` - Names to process.
- ***callable(string|int): bool*** `$filter` - Decides whether a value is included.
- ***callable(string $value,int ...$values): bool*** `$formatter` - Formats a value.

**Throws**: `\RuntimeException` - When processing fails.

### Return Value

- ***array{items: list<string>,count: positive-int}*** - Processed values and their count.

---

## Method: ModernTypes->compoundArray

```php
function compoundArray($compound)
```

### Parameters

- ***(string|int)[]*** `$compound`

---

## Method: ModernTypes->variance

```php
function variance($variance)
```

### Parameters

- ***iterable<covariant string,contravariant int,*>*** `$variance`

---

## Method: ModernTypes->genericAlias

```php
function genericAlias($loggers)
```

### Parameters

- ***\Psr\Log\LoggerInterface<string>*** `$loggers`

---

## Method: ModernTypes->contextualTypes

```php
function contextualTypes($template, $item, $key)
```

### Parameters

- ***T*** `$template`
- ***Item*** `$item`
- ***array-key*** `$key`

---

## Method: ModernTypes->importedAliases

```php
function importedAliases($external, $imported)
```

### Parameters

- ***ExternalItem*** `$external`
- ***ImportedItem*** `$imported`

---

## Method: ModernTypes->compoundIntersection

```php
function compoundIntersection($intersection)
```

### Parameters

- ***\Countable&(\Iterator|\Stringable)*** `$intersection`

---

## Method: ModernTypes->compoundUnion

```php
function compoundUnion($union)
```

### Parameters

- ***(\Countable&\Iterator)*** | ***\Stringable*** `$union`

---

## Method: ModernTypes->nullableCompound

```php
function nullableCompound($nullable)
```

### Parameters

- ***?(\Countable|\Iterator)*** `$nullable`

---

## Method: ModernTypes->dnf

```php
function dnf(
	(\Countable&\Iterator)|\Stringable $value,
): (\Countable&\Iterator)|\Stringable
```

### Return Value

- ***mixed***

---

## Method: ModernTypes->multiLineSignature

```php
function multiLineSignature(
	\DateTimeImmutable $createdAt,
	\DateTimeImmutable $updatedAt,
	\DateTimeImmutable $publishedAt,
	\DateTimeImmutable $archivedAt,
): \DateTimeImmutable
```

A method with a signature long enough to wrap in generated documentation.

---

## Method: ModernTypes->multiLineDefaultSignature

```php
function multiLineDefaultSignature(
	array $labels = ['first', 'second'],
	\DateTimeImmutable $createdAt,
	\DateTimeImmutable $updatedAt,
	\DateTimeImmutable $publishedAt,
): \DateTimeImmutable
```

A long signature with a comma-bearing default value.

---

## Method: ModernTypes->aMethodWithAnIntentionallyLongNameThatStillRequiresWrappingEvenThoughItDoesNotHaveAnyParametersAtAll

```php
function aMethodWithAnIntentionallyLongNameThatStillRequiresWrappingEvenThoughItDoesNotHaveAnyParametersAtAll(
): \DateTimeImmutable
```

A parameterless method whose generated signature still exceeds the line limit.

---

## Method: ModernTypes->variadicSignature

```php
function variadicSignature(string ...$values): void
```

A variadic method.

---

## Method: ModernTypes->documentedVoidMethodWithDescription

```php
function documentedVoidMethodWithDescription(): void
```

A void method whose result is documented.

### Return Value

- ***void*** - Writes output.

---

## Method: ModernTypes->undocumented

```php
function undocumented(string $name = ''): string
```

Undocumented

# Function: \importedException

```php
function importedException()
```

### Return Value

- ***\RuntimeException***



# Function: \groupedLogger

```php
function groupedLogger()
```

### Return Value

- ***\Psr\Log\LoggerInterface***



# Function: \nativeReturn

```php
function nativeReturn(): int
```

# Function: \optionalParameters

```php
function optionalParameters(
	string $required,
	int $count = 1,
	?string $label = \null,
)
```

# Function: \documentedVoidFunction

```php
function documentedVoidFunction(): void
```



A function that does not return a value.

# Function: \documentedVoidFunctionWithDescription

```php
function documentedVoidFunctionWithDescription(): void
```

### Return Value

- ***void*** - Writes output.

A function whose void result is documented.