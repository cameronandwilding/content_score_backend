Content Score Backend
=====================


Setup
-----

- Set frequent (every ~10-ish minutes) cron to call: ```/cron```
- Add to your ```.env``` file: ```PARSER_SERVICE_URL=<PARSER SERVICE PATH>``` 


# API

Add feed
--------

- Type: ```POST```
- Path: ```/api/v1/feed```
- Post params:

```
url=<FULL RSS URL>
```


Get all feeds
-------------

- Type: ```GET```
- Path: ```/api/v1/feed```
- Return type: ```JSON```
- Return structure:

```
{
    feeds: [
        {
            url: <URL>,
        },
        {
            ...
        }
    ]
}
```


Get a filtered list of content
------------------------------

- Type: ```GET```
- Path: ```/api/v1/search/<KEYWORD>/<COUNT = 10>```
- Params:
    - ```<KEYWORD>```: string
    - ```<COUNT>```: integer, number of maximum item (optional)
- Return type: ```JSON```
- Return structure:

```
{
    'result': [
        {
            url: <URL>,
        },
        {
            ...
        }
    ]
}
```
