Content Score Backend
=====================


Setup
-----

- Set frequent (every ~10-ish minutes) cron to call: ```/cron```


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
- Path: ```/api/v1/feed/search/<KEYWORD>```
- Params:
    - ```<KEYWORD>```: string
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
