# tennis_circle
テニスサークルコミュニティに限定した写真共有サービス

## 使用技術
### フロントエンド
HTML(.blade.php), Sass(.scss), JavaScript  
CSSフレームワーク(Bootstrap4, FontAwesome)

### バックエンド
PHP8.0.0<br>
Laravel8.19.0

### インフラ
AWS(EC2 AL2, RDS MySQL8.0.21, Route53, S3, Certificate)

## 機能
* アルバムのCRUD処理
* アルバムの公開非公開
* ユーザーを指定したアルバムの公開
* AWS S3にストレージを連携
* 管理者機能をBASIC認証、ユーザー機能をuser認証で分けて実装

- **[OP.GG](https://op.gg)**
