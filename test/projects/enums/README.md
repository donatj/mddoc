# Enum: Example\EnumDependencies\UnbackedState

An enum without a backing type.

```php
<?php
namespace Example\EnumDependencies;

enum UnbackedState {
	/** A label for the enum. */
	public const LABEL = 'unbacked state';
	/** Work has not started. */
	case Pending;
	/** Work has completed. */
	case Complete;
}
```

# Enum: Example\EnumDependencies\BackedState

An enum backed by strings.

```php
<?php
namespace Example\EnumDependencies;

enum BackedState: string {
	/** The item is open. */
	case Open = 'open';
	/** The item is closed. */
	case Closed = 'closed';
}
```

# Enum: Example\EnumDependencies\State

An enum with class-like dependencies.

```php
<?php
namespace Example\EnumDependencies;

enum State {
	case Ready;
}
```

## Method: State->contractValue

```php
function contractValue(): string
```

Returns the value required by the contract.

---

## Method: State->enumValue

```php
function enumValue(): string
```

Returns a value defined directly on the enum.

---

## Method: State->traitValue

```php
function traitValue(): string
```

Returns a value provided by the trait.