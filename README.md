# Simple value object abstraction

Provides a abstraction process when working with database ORMs such as Eloquent.

Current simple implementation to just copy all the values from the database model over to a value object defined by you.

```
$databaseModel = Eloquent::find(1);

$valueProvider = ValueProvider('MyCustomValueClass');

$valueProvider->provideValue($databaseModel); // Returns new MyCustomValueClass object

```