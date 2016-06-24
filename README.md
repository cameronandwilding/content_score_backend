Content Score Backend
=====================


# API

Add feed
--------

- *Type*: ```POST```
- *Path*: ```/api/v1/feed```
- *Post params*:

```
url=<FULL RSS URL>
```


Get all feeds
-------------

- *Type*: ```GET```
- *Path*: ```/api/v1/feed```
- *Return type*: ```JSON```
- *Return structure*:

```json
{
    feeds: [
        {
            url: <URL>,
        },
        { ... }
    ]
}
```


Get a filtered list of content
------------------------------

- *Type*
