[![Partigen](https://github.com/cylmat/partigen/actions/workflows/main.yml/badge.svg)](https://github.com/cylmat/partigen/actions/workflows/main.yml)

# Partigen
Partigen is a PHP partition page image generator, used to learn and develop experience with partition reading on paper page format.

## Options

Every options are in the Partigen\Config\Params class.  

* scopes  
Display G scope, F scope or random (G or F) scopes
```
Partigen\ImageCreator::generate([
    'scopes' => 'G'
]);
```
* higher_note and lower_note  
Can generate random notes upper and lower from the scope line.  
For exemple, 5 and -5 will display random notes around the second line (for scope G) or the fourth line (for scope F).  
```
Partigen\ImageCreator::generate([
    'higher_note' => 5,
    'lower_note' => -5
]);
```

* They can be a note name too (like C2)  
```
Partigen\ImageCreator::generate([
    'higher_note' => 'C4',
    'lower_note' => 'F2'
]);
```

- Higher and lower notes are blocked to a max of 4 lines around scope

## Image

* Display() method can display an image
* Download() can download it directly (for e.g. in a browser output)

## Default configuration

* If no client options is passed, a default configuration can be used on a second params
```
Partigen\ImageCreator::generate([], [
    'higher_note' => 0, // default config
]);
```

## License

This program is distributed under the OSL License. For more information see the [./LICENSE.md](./LICENSE.md) file.