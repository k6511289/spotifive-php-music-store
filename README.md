# SPOTIFIVE 音樂商城

SPOTIFIVE 是 2023 年完成的三人課程專題，以 PHP、MySQL、JavaScript 與 Bootstrap 製作音樂專輯商城。專案涵蓋商品瀏覽、音樂試聽、會員、留言、購物車、結帳及後台管理等基本電商流程。

> 這個 repository 是課程成果的整理版本，用來記錄早期全端開發經驗。它不是正式商用服務，也不代表所有程式碼皆由單一成員完成。

## 我的主要貢獻

我主要負責購物車相關功能，包括：

- 使用 PHP Session 保存不同語言分類的商品
- 加入商品時辨識相同商品並合併數量
- 增加、減少及移除購物車商品
- 從 MySQL 取得商品資料並計算各項小計與總價
- 結帳時產生訂單編號並寫入訂單資料
- 串接管理員訂單列表與 CRUD 操作

其餘會員、留言、商品管理與頁面設計由團隊共同完成。由於是三人專題，目前無法精確還原每一行程式的個別作者，因此只列出可以確認的主要分工。

## 功能

- 中文、英文、日文專輯分類與分頁
- 專輯搜尋及商品詳細頁
- 音樂試聽播放器
- 註冊、登入、登出與密碼管理
- 購物車數量調整、移除、總價計算與結帳
- 首頁及商品留言
- 管理員管理會員、留言、訂單及專輯
- AJAX 帳號檢查與 DataTables 後台列表

## 技術

- PHP 7 / MySQL（MariaDB）
- HTML、CSS、JavaScript
- Bootstrap、jQuery、DataTables
- PHP Session、AJAX

## 專案結構

```text
.
├── index.php                     # 首頁
├── CH_shop.php / EN_shop.php / JP_shop.php
│                                 # 各語言商品列表
├── product.php                   # 商品內容、試聽、留言、加入購物車
├── cart.php                      # 購物車與結帳
├── cart2.php                     # 訂單管理
├── component.php                 # 商品與購物車畫面元件
├── login.php / register.php      # 會員功能
├── account.php / comment.php     # 後台會員與留言管理
├── css/ / js/                    # 前端樣式與行為
└── database/schema.sql           # 去識別化的公開資料庫結構
```

## 在本機執行

這是舊版課程專案，原本在 XAMPP／MariaDB 環境開發。基本流程如下：

1. 安裝 PHP 7.3 以上、MySQL 或 MariaDB，以及支援 `mysqli` 的 Web Server。
2. 參考 `.env.example` 設定 Web Server 的環境變數；現階段程式至少會從 `DB_PASSWORD` 讀取資料庫密碼。
3. 匯入 `database/schema.sql`。
4. 將專案放進 Web Server 的網站根目錄並開啟 `index.php`。

目前舊程式仍將主機、使用者與資料庫名稱寫在 PHP 檔案內；完整集中設定列在下方的重構項目中。因此公開版主要用於閱讀與學習紀錄，尚未提供正式部署保證。

## 公開版本與原始版本的差異

以下內容基於隱私或著作權考量，不會提交至 GitHub：

- 原始 MP3 音樂檔案
- 未確認再散布授權的專輯封面與網站示範圖片
- 含歷史帳號、留言與訂單的 phpMyAdmin SQL 匯出檔
- 測試頁面及開發過程留下的重複檔案

公開版的 `database/schema.sql` 只包含資料表結構和虛構示範資料。

## 已知限制與重構方向

這份程式忠實保留早期學習階段的設計，因此仍有需要改善之處：

- 將剩餘的資料庫主機、使用者與資料庫名稱集中至環境設定
- 使用 prepared statements 防止 SQL injection
- 使用 `password_hash()` 與 `password_verify()` 儲存及驗證密碼
- 對留言與頁面輸出進行 HTML escaping，降低 XSS 風險
- 增加 CSRF token 與完整的後台權限驗證
- 結帳時使用登入會員名稱，而非測試用固定值
- 結帳後只清空購物車，避免 `session_unset()` 同時清除登入狀態
- 統一命名、移除重複頁面並分離資料存取與 HTML
- 補上自動化測試及可重現的開發環境

這些限制同時也是重新檢視舊專案後整理出的學習成果，而不是正式產品已具備的安全保證。

## 履歷摘要範例

> 與 2 位組員使用 PHP、MySQL、JavaScript 及 Bootstrap 完成音樂商城課程專題；主要負責以 Session 建構購物車狀態、商品數量合併與調整、跨分類商品查詢、總價計算，以及結帳訂單寫入流程。

## 素材與授權

程式中曾使用 Bootstrap 主題及第三方前端套件，相關權利屬各原作者。音樂與專輯圖片未包含於公開版本。若要公開展示畫面，應改用自行製作或具有明確再利用授權的素材。
