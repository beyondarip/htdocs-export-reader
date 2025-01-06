## Prompt:
hi

## Response:
Hello! How can I help you today?

## Prompt:
local utils = require('mp.utils') local msg = require('mp.msg')

\-- Get platform-specific config directory local function get\_config\_dir() local config\_dir if package.config:sub(1,1) == '\\\\' then -- Windows config\_dir = os.getenv('APPDATA') or '' config\_dir = utils.join\_path(config\_dir, 'mpv') else -- Linux/Unix config\_dir = os.getenv('XDG\_CONFIG\_HOME') or utils.join\_path(os.getenv('HOME') or '', '.config') config\_dir = utils.join\_path(config\_dir, 'mpv') end return config\_dir end

\-- Configuration local HISTORY\_FILE = utils.join\_path(get\_config\_dir(), 'history.txt')

\-- Ensure config directory exists local function ensure\_dir\_exists(path) local dir = utils.split\_path(path) if not utils.file\_info(dir) then local args if package.config:sub(1,1) == '\\\\' then args = { 'cmd', '/c', 'mkdir', dir } else args = { 'mkdir', '-p', dir } end local res = utils.subprocess({ args = args, cancellable = false }) if res.status ~= 0 then msg.error('Failed to create directory: ' .. dir) return false end end return true end

\-- Log entry to file local function log\_entry(path, title) if not ensure\_dir\_exists(HISTORY\_FILE) then return end

local file = io.open(HISTORY\_FILE, 'a+') if not file then msg.error('Could not open history file: ' .. HISTORY\_FILE) return end

\-- Format timestamp local timestamp = os.date('%Y-%m-%d %H:%M:%S')

\-- Clean up title title = title or '' if title == path then title = '' else title = string.format(' (%s)', title) end

\-- Write log entry local entry = string.format('\[%s\] %s%s\\n', timestamp, path, title) file:write(entry) file:close()

msg.info('Logged media file: ' .. path) end

\-- Register event handler mp.register\_event('file-loaded', function() local path = mp.get\_property('path', '') local title = mp.get\_property('media-title', '')

if path ~= '' then log\_entry(path, title) -- mp.osd\_message('File logged', 2) end end)

yang ini bisakah tambhkan timpestamp saat selsesai menonton / menutup ? buat yang best practice

## Response:
Here's the modified script that logs both start and end timestamps:

Untitled

Click to open code

Key improvements:

*   Added start/end timestamps
*   Tracks video duration
*   Uses a table to store current file info
*   More consistent logging format
*   Better error handling

The log format is now:

```
[START 2024-12-31 10:30:45] /path/to/video.mp4 (Video Title)
[END 2024-12-31 11:45:30] /path/to/video.mp4 (Video Title) (Duration: 01:14:45)
```

## Prompt:
itu bisa linux dan windows kan ?

## Response:
Ya, script ini bisa berjalan di Linux dan Windows. Script secara otomatis mendeteksi OS dengan:

```lua
if package.config:sub(1,1) == '\\' then
    -- Windows path
else
    -- Linux/Unix path
end
```

Dan menggunakan perintah yang sesuai untuk tiap OS:

*   Windows: `cmd /c mkdir`
*   Linux: `mkdir -p`

