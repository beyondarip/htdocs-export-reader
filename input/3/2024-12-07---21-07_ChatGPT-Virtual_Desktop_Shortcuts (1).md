# Virtual Desktop Shortcuts

#### You:
[Unsupported Content]

#### You:
; AutoHotkey v1 script

; Get hwnd of AutoHotkey window, for listener

; Path to the DLL, relative to the script
VDA_PATH := A_ScriptDir . "\VirtualDesktopAccessor.dll"
hVirtualDesktopAccessor := DllCall("LoadLibrary", "Str", VDA_PATH, "Ptr")

GetDesktopCountProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "GetDesktopCount", "Ptr")
GoToDesktopNumberProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "GoToDesktopNumber", "Ptr")
GetCurrentDesktopNumberProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "GetCurrentDesktopNumber", "Ptr")
IsWindowOnCurrentVirtualDesktopProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "IsWindowOnCurrentVirtualDesktop", "Ptr")
IsWindowOnDesktopNumberProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "IsWindowOnDesktopNumber", "Ptr")
MoveWindowToDesktopNumberProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "MoveWindowToDesktopNumber", "Ptr")
IsPinnedWindowProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "IsPinnedWindow", "Ptr")
GetDesktopNameProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "GetDesktopName", "Ptr")
SetDesktopNameProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "SetDesktopName", "Ptr")
CreateDesktopProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "CreateDesktop", "Ptr")
RemoveDesktopProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "RemoveDesktop", "Ptr")

; On change listeners
RegisterPostMessageHookProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "RegisterPostMessageHook", "Ptr")
UnregisterPostMessageHookProc := DllCall("GetProcAddress", "Ptr", hVirtualDesktopAccessor, "AStr", "UnregisterPostMessageHook", "Ptr")

GetDesktopCount() {
    global GetDesktopCountProc
    count := DllCall(GetDesktopCountProc, "Int")
    return count
}

MoveCurrentWindowToDesktop(desktopNumber) {
    global MoveWindowToDesktopNumberProc, GoToDesktopNumberProc
    WinGet, activeHwnd, ID, A
    DllCall(MoveWindowToDesktopNumberProc, "Ptr", activeHwnd, "Int", desktopNumber, "Int")
    DllCall(GoToDesktopNumberProc, "Int", desktopNumber)
}

GoToPrevDesktop() {
    global GetCurrentDesktopNumberProc, GoToDesktopNumberProc
    current := DllCall(GetCurrentDesktopNumberProc, "Int")
    last_desktop := GetDesktopCount() - 1
    ; If current desktop is 0, go to last desktop
    if (current = 0) {
        MoveOrGotoDesktopNumber(last_desktop)
    } else {
        MoveOrGotoDesktopNumber(current - 1)
    }
    return
}

GoToNextDesktop() {
    global GetCurrentDesktopNumberProc
    current := DllCall(GetCurrentDesktopNumberProc, "Int")
    last_desktop := GetDesktopCount() - 1
    ; If current desktop is last, go to first desktop
    if (current = last_desktop) {
        MoveOrGotoDesktopNumber(0)
    } else {
        MoveOrGotoDesktopNumber(current + 1)
    }
    return
}

GoToDesktopNumber(num) {
    global GoToDesktopNumberProc
    DllCall(GoToDesktopNumberProc, "Int", num, "Int")
    return
}
MoveOrGotoDesktopNumber(num) {
    ; If user is holding down Mouse left button, move the current window also
    if (GetKeyState("LButton")) {
        MoveCurrentWindowToDesktop(num)
    } else {
        GoToDesktopNumber(num)
    }
    return
}
GetDesktopName(num) {
    global GetDesktopNameProc
    utf8_buffer := ""
    utf8_buffer_len := VarSetCapacity(utf8_buffer, 1024, 0)
    ran := DllCall(GetDesktopNameProc, "Int", num, "Ptr", &utf8_buffer, "Ptr", utf8_buffer_len, "Int")
    name := StrGet(&utf8_buffer, 1024, "UTF-8")
    return name
}
SetDesktopName(num, name) {
    ; NOTICE! For UTF-8 to work AHK file must be saved with UTF-8 with BOM

    global SetDesktopNameProc
    VarSetCapacity(name_utf8, 1024, 0)
    StrPut(name, &name_utf8, "UTF-8")
    ran := DllCall(SetDesktopNameProc, "Int", num, "Ptr", &name_utf8, "Int")
    return ran
}
CreateDesktop() {
    global CreateDesktopProc
    ran := DllCall(CreateDesktopProc)
    return ran
}
RemoveDesktop(remove_desktop_number, fallback_desktop_number) {
    global RemoveDesktopProc
    ran := DllCall(RemoveDesktopProc, "Int", remove_desktop_number, "Int", fallback_desktop_number, "Int")
    return ran
}

; SetDesktopName(0, "It works! 🐱")

; How to listen to desktop changes
DllCall(RegisterPostMessageHookProc, "Ptr", A_ScriptHwnd, "Int", 0x1400 + 30, "Int")
OnMessage(0x1400 + 30, "OnChangeDesktop")
OnChangeDesktop(wParam, lParam, msg, hwnd) {
    Critical, 100
    OldDesktop := wParam + 1
    NewDesktop := lParam + 1
    Name := GetDesktopName(NewDesktop - 1)

    ; Use Dbgview.exe to checkout the output debug logs
    OutputDebug % "Desktop changed to " Name " from " OldDesktop " to " NewDesktop
}

#+1:: MoveOrGotoDesktopNumber(0)
#+2:: MoveOrGotoDesktopNumber(1)
#+3:: MoveOrGotoDesktopNumber(2)
#+4:: MoveOrGotoDesktopNumber(3)
#+5:: MoveOrGotoDesktopNumber(4)

F13 & 1:: MoveOrGotoDesktopNumber(0)
F13 & 2:: MoveOrGotoDesktopNumber(1)
F13 & 3:: MoveOrGotoDesktopNumber(2)
F13 & 4:: MoveOrGotoDesktopNumber(3)
F13 & 5:: MoveOrGotoDesktopNumber(4)
F14 UP:: GoToPrevDesktop()
F15 UP:: GoToNextDesktop()


what shortcut is that ?, what should i press to use that shorctut

#### ChatGPT:
The script defines several keyboard shortcuts, using both the **Windows + Number** key combination and the **F13/F14/F15** keys.

### Here's a breakdown of the shortcuts:

1. **Windows + Number (1–5):**
   - **Windows + 1** → Move to desktop 0
   - **Windows + 2** → Move to desktop 1
   - **Windows + 3** → Move to desktop 2
   - **Windows + 4** → Move to desktop 3
   - **Windows + 5** → Move to desktop 4

2. **F13 & Number (1–5):**
   - **F13 + 1** → Move to desktop 0
   - **F13 + 2** → Move to desktop 1
   - **F13 + 3** → Move to desktop 2
   - **F13 + 4** → Move to desktop 3
   - **F13 + 5** → Move to desktop 4

3. **F14 & F15:**
   - **F14 (Release)** → Move to the previous desktop
   - **F15 (Release)** → Move to the next desktop

### How to use the shortcuts:

- For the **Windows + Number** shortcuts, just press **Windows key + 1** through **Windows key + 5** to switch to the respective desktop.

- For **F13/F14/F15 combinations**, you'll need to press **F13** or **F14/F15** in combination with the numbers **1–5** (for example, **F13 + 1** to go to desktop 0).
  - You may need special software to enable **F13–F15** keys if your keyboard doesn't have them by default.

The script seems to be geared toward switching and managing virtual desktops via these keyboard shortcuts!


#### You:
i can't use Windows + 2
cause i think there's default windows shortcut for that ?

#### ChatGPT:
Yes, you're right! **Windows + 2** (and other similar key combinations like **Windows + 1**, **Windows + 3**, etc.) are indeed default shortcuts in Windows, typically used to open or switch between the apps pinned to the taskbar.

### Default behavior of **Windows + Number**:

- **Windows + 1** → Open the first pinned app on the taskbar
- **Windows + 2** → Open the second pinned app on the taskbar (and so on)

Since **Windows + 2** is already reserved by the operating system for this purpose, it conflicts with your AutoHotkey script.

### Workaround:

You can modify your AutoHotkey script to use a different key combination that doesn't conflict with the default Windows shortcuts.

#### Options for changing the shortcut:

1. **Use a different modifier** (e.g., **Ctrl**, **Alt**, or **Shift**):
   - You could change **Windows + 2** to something like **Ctrl + Win + 2** or **Alt + Win + 2**.

2. **Change the number key combination**:
   - Instead of **Windows + Number**, you could use **F1–F5**, or **Shift + F1–F5**, or any other unused key combination.

For example, you can modify the script like this:

```ahk
^#1:: MoveOrGotoDesktopNumber(0)  ; Ctrl + Win + 1
^#2:: MoveOrGotoDesktopNumber(1)  ; Ctrl + Win + 2
^#3:: MoveOrGotoDesktopNumber(2)  ; Ctrl + Win + 3
^#4:: MoveOrGotoDesktopNumber(3)  ; Ctrl + Win + 4
^#5:: MoveOrGotoDesktopNumber(4)  ; Ctrl + Win + 5
```

This would allow you to use **Ctrl + Win + 1** through **Ctrl + Win + 5** to switch desktops without conflicting with the default Windows taskbar shortcuts.

Alternatively, you could use another set of key combinations like **F1–F5** or any custom keys that work better for you.
